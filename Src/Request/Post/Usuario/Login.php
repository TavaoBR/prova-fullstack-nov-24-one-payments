<?php 

namespace Src\Request\Post\Usuario;

use Src\Model\Usuario;
use Src\Request\Validate; 

class Login {

    private Usuario $usuario;
    private Validate $validate;

    public function __construct(){
        $data = json_decode(file_get_contents('php://input'), true);
        $this->usuario = new Usuario;
        $this->validate = new Validate;
        $this->usuario->username = $data['username'];
        $this->usuario->senha = $data['senha'];
    }

    public function request(){
       session_start();
       if(!$this->validarDados()){
          $this->logar();
       }
    }

    private function validarDados(){
         $data = [
            "Username" => $this->usuario->username,
            "Senha" => $this->usuario->senha
         ];

         if($this->validate->validate($data)){
            $this->sendMessageJson(false, $this->validate->validate($data), "warning", "Não está esquecendo de algo ?");
            return true;
          }

         return false;
    }

    private function logar(){
        
        $select = $this->usuario->ByUsername();

        if($select[0] < 1){
            $this->sendMessageJson(false, "Dados invalidos", "error", "Login");
        }

        $dados = $select[1];
        $this->usuario->id = $dados->id;
        $this->usuario->tentativas = $dados->tentativas;
        $this->usuario->token = $dados->token;

        switch(true){
           case $this->usuario->tentativas == 10:
              $this->sendMessageJson(false, "Login Bloqueado", "error", "Login");
           break;

           case password_verify($dados->senha, hash("sha256", $this->usuario->senha)):
              $somaTentativas = $this->usuario->tentativas + 1;
              $this->usuario->updateTentativas($somaTentativas);
              $tentativas = 5;
              $tentativasRestantes = $tentativas - $dados->tentativas;
              $this->sendMessageJson(false, "Login Inválido. Restão apenas $tentativasRestantes", "error", "Login");
           break; 

           default:
              $this->usuario->resetarTentativas();
              $this->criarSessao($this->usuario->id, $this->usuario->token);
              $this->sendMessageJson(true);
           break;
        }
    }

    private function criarSessao(int $id, string $token){
       return setSessions(["id" => $id, "token" => $token]);
    }

    private function sendMessageJson(bool $success, string $message = null, string $icon = null, string $title = null,){
         echo json_encode([
          'success' => $success,
          'message' => $message,
          "title" => $title,
          "icon" => $icon
         ]);

         exit;
    } 
}