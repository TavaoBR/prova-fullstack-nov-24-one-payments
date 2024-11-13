<?php 

namespace Src\Request\Post\Usuario;

use Config\TokenUser;
use Src\Model\Usuario;
use Src\Request\Validate;

class Registro {

    private Usuario $usuario;
    private Validate $validate;
    public $avatar;
    public function __construct(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json"); // Garante que o conteúdo seja JSON
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->usuario = new Usuario;
        $this->validate = new Validate;
        $this->usuario->nome_completo = $_POST['nome_completo'] ?? null; 
        $this->usuario->username = $_POST['username'] ?? null;
        $this->usuario->senha = $_POST['senha'] ?? null;
        $this->avatar = $_FILES['avatar'] ?? null;
    }

    public function request(){
        if(!$this->validarDados() && !$this->verificarUsuarioExiste()){
           $this->create();
        }
    }

    private function validarDados(){
        $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;
        $data = [
          "Nome completo" => $this->usuario->nome_completo,
          "Username" => $this->usuario->username,
          "Senha" => $this->usuario->senha,
          "Avatar" => $avatarValue
        ];

        if($this->validate->validate($data)){
            $this->sendMessageJson(false, $this->validate->validate($data), "warning", "Não está esquecendo de algo ?");
            return true;
          }

         return false;
    } 

    private function verificarUsuarioExiste(){
        $select = $this->usuario->ByUsername();
        if($select[0] > 0){
            $this->sendMessageJson(false, "Username já em uso", "error", "Registro");
            return true;
        }

        return false;
    }

    private function create(){
       $senhaHash = hash("sha256",$this->usuario->senha);
       $this->usuario->viewSenha = $this->usuario->senha;
       $this->usuario->senha = $senhaHash;
       $this->usuario->tentativas = 1;
       $this->usuario->avatar = $this->avatar['name']; 

       $create = $this->usuario->inserir();

       if($create[0] > 0){
          $id = $create[1];
          $this->createFolderFiler($id);
          $token = new TokenUser($id);
          $token->token();
          $this->sendMessageJson(true);
       }else{
         $this->sendMessageJson(false, "Ocorreu um erro ao inserir os dados, entre em contato com responsavel", "error", "Registro");
       }
    }

    private function createFolderFiler(int $id){
        $file = $this->avatar['tmp_name'];
        $foto = $this->avatar['name'];
        $_UP['pasta'] = "Public/assets/usuario/$id/";
        mkdir($_UP['pasta'], 0777);
        move_uploaded_file($file, $_UP['pasta'].$foto);
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