<?php 

namespace Src\Controller\App;

use Config\TemplateConfig;
use Src\Model\Produto;
use Src\Model\Transacao;
use Src\Model\Usuario;

class AppController extends TemplateConfig{

    private Transacao $transacao;
    private Produto $produto;
    private Usuario $usuario; 

    public function __construct(){
        $this->transacao = new Transacao;
        $this->produto = new Produto;
        $this->usuario = new Usuario;
    }

    public function index(){
        $this->view("app/index", ["title" => "Index"]);
    }


    public function produtos(){
       $select = $this->produto->All();
       $this->view("app/produto/produtos", ["title" => "Produtos", "dados" => $select[1], "conta" => $select[0]]);
    }

    public function checkout($data){
        session_start();
        $id_transacao = $data['idTransacao'];
        $this->transacao->transacaoId = $id_transacao;
        $select = $this->transacao->byTransacaoId();
        $this->view("app/transacao/payments/checkout", ["title" => "Checkout", "dados" => $select[1], "conta" => $select[0]]);
    }

    public function statusPagamento($data){
        $status = $data['status'];
        $id_transacao = $data['idTransacao'];
        $this->transacao->transacaoId = $id_transacao;
        $select = $this->transacao->byTransacaoId();
        if (!in_array($status, ["Aprovado", "Reprovada"])) {
            redirect(dominio() . "/app");
        }

        if($select[1]->status  !=  $status){
            redirect(dominio() . "/app");
        }

        $this->view("app/transacao/payments/status", ["title" => $status, "dados" => $select[1], "conta" => $select[0]]);
    }


    public function transacoes(){
        session_start();
        $id =  getSession("id");
        $this->transacao->fk = $id;
        $select = $this->transacao->byFK();
        $this->view("app/transacao/transacoes", ["title" => "Transações", "dados" => $select[1]]);
    }
}