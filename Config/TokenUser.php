<?php 

namespace Config;

use Src\Model\Usuario; 

class TokenUser {
    private Usuario $usuario;

    public function __construct(int $id){
       $this->usuario = new Usuario;
       $this->usuario->id = $id;
    }

    private function gerarToken(){
        $uuid = bin2hex(random_bytes(16));
        $token = sprintf("%s-%s-%s-%s-%s", 
        substr($uuid, 0, 8),
        substr($uuid, 8, 4),
        substr($uuid, 12, 4),
        substr($uuid, 16, 4),
        substr($uuid, 20)  
        );

        return $token;
    }

    private function atualizarToken(){
        $this->usuario->token = $this->gerarToken();
        $this->usuario->criarToken();
    }

    private function verificaTokenExiste(){
        $this->usuario->token = $this->gerarToken();
        return $this->usuario->ByToken();
    }

    public function token(){
        if($this->verificaTokenExiste()[0] < 1){
           $this->atualizarToken();
        }
    }
}