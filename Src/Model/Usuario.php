<?php 

namespace Src\Model;

use Src\Database\Model\Model; 

class Usuario extends Model{

    protected string $table = "usuario";

    public int $id, $tentativas;

    public string $nome_completo, $username, $senha, $viewSenha, $avatar, $token;

    public function inserir(){

        $insert = $this->create([
           "nome_completo" => $this->nome_completo,
           "username" => $this->username,
           "senha" => $this->senha, 
           "viewSenha" => $this->viewSenha,
           "avatar" => $this->avatar,
           "token" => $this->token,
           "tentativas" => $this->tentativas
        ]);

        return $insert;
    }

    public function updateTentativas($tentativas): void{
        $this->update("id", $this->id, ["tentativas" => $tentativas]);
    }
    
    public function resetarTentativas(): void{
        $this->update("id", $this->id, ["tentativas" => "1"]);
    } 

    public function criarToken(){
        $this->update("id", $this->id, ["token" => $this->token]);
    }

    public function ById(): array{
        return $this->findBy("id", $this->id);
    }

    public function ByToken(): array{
        return $this->findBy("token", $this->token);
    }

    public function ByUsername(): array{
        return $this->findBy("username", $this->username);
    }

    public function All(){
        return $this->fetchAll();
    }

    

}