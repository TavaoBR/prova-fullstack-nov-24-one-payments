<?php 

namespace Src\Controller\Error;

use Config\TemplateConfig; 

class ErrorController extends TemplateConfig{

    public function notFound($data){
        switch($data['errocode']){
            case "400":
                $this->error("400", "Essa Página não está funcionando");
              break;
    
              case "403":
                $this->error("403", "Solicitação Não autorizada");
              break;
    
    
                case "404":
                   $this->error("404", "Pagina Não Encontrada");
                break; 
    
                case "405":
                    $this->error("405", "Metodo Não Encontrado");
                break;  
     
                case "500":
                   $this->error("500", "Opps! Erro Interno de Servidor");
                break; 


        }
    }

    private function error($numero, string $descricaoErro){
       $this->view("error", ["title" => $numero, "error" => $numero, "descricao" => $descricaoErro]);
    }

}