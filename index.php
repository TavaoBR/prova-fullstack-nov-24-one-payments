<?php 

// Importação das classes necessárias
use Src\Routers\Routers;
use Dotenv\Dotenv;

// Carrega todas as dependências especificadas pelo Composer
require_once("vendor/autoload.php");

// Define o caminho atual do diretório do arquivo
$path = dirname(__FILE__);

// Inicializa a biblioteca Dotenv para carregar variáveis de ambiente de forma segura
$dotenv = Dotenv::createUnsafeImmutable($path);
$dotenv->load();

error_reporting(1);

// Classe principal para gerenciar as rotas e o método HTTP
class Index{

    // Declaração das propriedades para armazenar o roteador e o método HTTP
    private $router;
    private $method;

    // Construtor da classe que inicializa o roteador e obtém o método HTTP atual
    public function __construct(){
        try{
            $this->router = new Routers; // Cria uma instância do roteador
            $this->method = $_SERVER["REQUEST_METHOD"]; // Define o método HTTP atual
        }catch(Exception $e){
            // Em caso de erro, registra a mensagem no log e exibe uma mensagem de erro ao usuário
            error_log($e->getMessage(), 0);
            exit('Desculpe, ocorreu  um erro interno');
        }
    }

    // Método privado para definir a ação baseada no método HTTP recebido
    private function method($method){
        if($this->router){ // Verifica se o roteador foi instanciado
           switch($method){
             case 'GET':
                $this->router->get(); // Chama o método GET do roteador
             break;
             
             case 'POST':
                $this->router->post(); // Chama o método POST do roteador
             break;
             
             case 'PUT':
                $this->router->put(); // Chama o método PUT do roteador
             break;
             
             case 'DELETE':
                $this->router->delete(); // Chama o método DELETE do roteador
             break;            
           }
        }
    }

    // Método público para renderizar a resposta com base no método HTTP
    public function render(){
        return $this->method($this->method); // Chama o método com o método HTTP atual
    }

}

// Cria uma instância da classe Index e chama o método render para processar a solicitação
$index = new Index;
$index->render();