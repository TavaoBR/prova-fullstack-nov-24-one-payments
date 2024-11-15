<?php 

namespace Src\Model;

use Src\Database\Model\Model; 

class Produto extends Model{

    public string $table = 'produto', $nome, $imagem;
    public int $id;
    public float $valor;

    public function inserir(){
        
        $create = $this->create([
           "nome" => $this->nome,
           "valor" => $this->valor,
           "imagem" => $this->imagem
        ]);

        return $create;
    }

    public function byId(){
       return $this->findBy("id", $this->id);
    }

    public function All(){
        return $this->fetchAll();
    }

}