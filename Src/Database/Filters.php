<?php 

namespace Src\Database;

class Filters {
  private array $filters = [];
  private array $binds = [];

    // Adiciona uma condição 'where' aos filtros com o operador, valor e lógica especificados
    public function where(string $field, string $operator, mixed $value, string $logic = ''): void
    {
        $formatter = '';
        if (is_array($value)) {
        $formatter = "('" . implode("','", $value) . "')";
        } elseif (is_string($value)) {
        $formatter = "'{$value}'";
        } elseif (is_bool($value)) {
        $formatter = $value ? 1 : 0;
        } else {
        $formatter = $value;
        }

        $value = strip_tags($formatter);

        $fieldBind = str_contains($field, '.') ? str_replace('.', '', $field) : $field;

        $this->filters['where'][] = "{$field} {$operator} :{$fieldBind} {$logic}";
        $this->binds[$fieldBind] = $value;
    }


  // Retorna os valores de ligação (binds) usados nas consultas
  public function getBind(): array
  {
    return $this->binds;
  }

  // Define um limite de registros a serem retornados na consulta
  public function limit(int $limit): void
  {
    $this->filters['limit'] = " limit {$limit}";
  }

  // Define a ordenação dos resultados da consulta
  public function orderBy(string $field, string $order = 'asc'): void
  {
    $this->filters['order'] = " order by {$field} {$order}";
  }

  // Adiciona uma condição de 'join' aos filtros para unir tabelas relacionadas
  public function join(string $foreignTable, string $joinTable1, string $operator, string $joinTable2, string $joinType = 'inner join'): void
  {
    $this->filters['join'][] = "{$joinType} {$foreignTable} on {$joinTable1} {$operator} {$joinTable2}";
  }

  // Gera a string completa dos filtros aplicados para a consulta
  public function dump(): string
  {
    $filter = !empty($this->filters['join']) ? implode(' ', $this->filters['join']) : '';
    $filter .= !empty($this->filters['where']) ? ' where ' . implode(' ', $this->filters['where']) : '';
    $filter .= $this->filters['order'] ?? '';
    $filter .= $this->filters['limit'] ?? '';
    return $filter;
  }
}