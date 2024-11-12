<?php 

namespace Src\Database\Model;

use Src\Database\Filters;
use Src\Database\Pagination;
use Src\Database\Connection;
use PDOException;
use PDO;

abstract class Model {

  private string $fields = '*';
  private ?Filters $filters = null;
  private string $pagination = '';
  protected string $table;


// Define os campos a serem selecionados na consulta SQL
  public function setFields($fields)
  {
    $this->fields = $fields;
  }
  
// Define os filtros a serem aplicados na consulta SQL
  public function setFilters(Filters $filters)
  {
    $this->filters = $filters;
  }

// Configura a paginação e ajusta o número total de itens para a consulta SQL
  public function setPagination(Pagination $pagination)
  {
    $pagination->setTotalItems($this->count());
    $this->pagination = $pagination->dump();
  }

// Insere um novo registro na tabela com base nos dados fornecidos
  public function create(array $data)
  {
    try {
      $sql = "insert into {$this->table} (";
      $sql .= implode(',', array_keys($data)) . ") values(";
      $sql .= ':' . implode(',:', array_keys($data)) . ")";

      $connect = Connection::connect();

      $prepare = $connect->prepare($sql);

      $prepare->execute($data);
     
      return [$prepare->rowCount(), $connect->lastInsertId()];

    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }


  // Atualiza um registro existente na tabela com base no campo e valor especificados
  public function update(string $field, string|int $fieldValue, array $data)
  {
    try {
      $sql = "update {$this->table} set ";
      foreach ($data as $key => $value) {
        $sql .= "{$key} = :{$key},";
      }

      $sql = rtrim($sql, ',');

      $sql .= " where {$field} = :{$field}";

      $connection = Connection::connect();

      $data[$field] = $fieldValue;

      $prepare = $connection->prepare($sql);

      $prepare->execute($data);
      
      return $prepare->rowCount();

    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  // Recupera todos os registros da tabela aplicando filtros e paginação, se definidos
  public function fetchAll()
  {
    try {
      $sql = "select {$this->fields} from {$this->table} {$this->filters?->dump()} {$this->pagination}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);
      $prepare->execute($this->filters ? $this->filters->getBind() : []);

      return [$prepare->rowCount(), $prepare->fetchAll(PDO::FETCH_CLASS)] ;
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  // Encontra registros na tabela com base em um campo específico, retornando um ou vários resultados
  public function findBy(string $field = '', string $value = '', bool $singleResult = true)
  {
    try {
      $sql = (empty($this->filters)) ?
        "select {$this->fields} from {$this->table} where {$field} = :{$field}" :
        "select {$this->fields} from {$this->table} {$this->filters?->dump()}";
  
      $connection = Connection::connect();
  
      $prepare = $connection->prepare($sql);
  
      $prepare->execute($this->filters ? $this->filters->getBind() : [$field => $value]);
  
      if ($singleResult) {
        return [$prepare->rowCount(), $prepare->fetchObject()];
      } else {
        return [$prepare->rowCount(), $prepare->fetchAll(PDO::FETCH_OBJ)];
      }
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  // Recupera o primeiro registro da tabela com base na ordenação especificada
  public function first($field = 'id', $order = 'asc')
  {
    try {
      $sql = "select {$this->fields} from {$this->table} order by {$field} {$order} limit 1";

      $connection = Connection::connect();

      $query = $connection->query($sql);

      return $query->fetchObject();
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  // Deleta um registro da tabela com base em um campo específico ou usando filtros
  public function delete(string $field = '', string|int $value = '')
  {
    try {
      $sql = (!empty($this->filters)) ?
        "delete from {$this->table} {$this->filters}" :
        "delete from {$this->table} where {$field} = :{$field}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);

      return $prepare->execute(empty($this->filters) ? [$field => $value] : $this->filters->getBind());
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  // Conta o número de registros na tabela aplicando filtros, se definidos
  public function count()
  {
    try {
      $sql = "select {$this->fields} from {$this->table} {$this->filters->dump()}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);
      $prepare->execute($this->filters ? $this->filters->getBind() : []);

      return $prepare->rowCount();
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }


}