<?php 

namespace Src\Routers; 

use CoffeeCode\Router\Router;

class Routers {

    /* 
    Declaração das propriedades privadas para uso apenas dentro da classe:
    $router é uma instância de Router, e $dominio armazena o domínio base da aplicação.
    */
    private Router $router;
    private $dominio;

    // Construtor da classe que inicializa o domínio e cria uma instância do roteador
    public function __construct(){
        $this->dominio = dominio(); // Obtém o domínio da aplicação
        $this->router = new Router($this->dominio); // Cria o roteador com o domínio
    }

    /*
    Métodos públicos para definir as ações HTTP (GET, POST, PUT, DELETE) na aplicação.
    Esses métodos serão acessados no arquivo index.php para processar as requisições
    em um ambiente de servidor (como hospedagem, XAMPP, Apache, ou servidor PHP local).
    */

    // Define as rotas para requisições GET
    public function get(){
        
        $rota = $this->router; // Atribui o roteador à variável $rota
        $rota->group(null)->namespace("Src\Controller");
        $rota->get("/", "IndexController:index");
        $rota->get("/login", "IndexController:login");
        $rota->get("/registro", "IndexController:registro");

        $rota->dispatch();
    }

    // Define as rotas para requisições POST
    public function post(){
        $rota = $this->router;

        $rota->group("/user")->namespace("Src\Request\Post\Usuario");
        $rota->post("/login", "Login:request");
        $rota->post("/registro", "Registro:request");

        $rota->dispatch();
    }

    // Define as rotas para requisições PUT
    public function put(){
        $rota = $this->router;

        $rota->dispatch();
    }

    // Define as rotas para requisições DELETE
    public function delete(){
        $rota = $this->router;

        $rota->dispatch();
    }
}
