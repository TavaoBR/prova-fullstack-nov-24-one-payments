<?php 

namespace Src\Request\Post\Pagamento;

use Src\Model\Transacao;
use Config\Datas;

class Processar {
    
    private Transacao $transacao;
    private Datas $datas;

    public function __construct(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json"); // Garante que o conteúdo seja JSON
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $data = json_decode(file_get_contents("php://input"), true);
        $this->transacao = new Transacao;
        $this->datas = new Datas;
        $this->transacao->transacaoId =  uniqid();
        $this->transacao->fk = $data['fk_usuario'] ?? 0;
        $this->transacao->beneficiario = $data['beneficiario'] ?? '';
        $this->transacao->produto = $data['produto_nome'] ?? '';
        $this->transacao->valor = $data['produto_valor'] ?? 0.0;
        $this->transacao->status = "Pedente";
        $this->transacao->metodoPagamento = "Cartão de Credito";
        $this->transacao->dataTransacao = $this->datas->dataAtual();
        $this->transacao->horaTransacao = $this->datas->horaAtual();
    }

    public function request(){
        $this->linkPagamento();
    }

    private function linkPagamento(){
       $create = $this->transacao->inserir();
       
       if($create[0] > 0){
        $link = dominio()."/app/transacao/checkout/{$this->transacao->transacaoId}";
        $this->sendMessageJson(true, "Estamos lhe enviando para pagina de checkout de pagamento, clique no botão", "success", "Processado", $link);
       }else{
        $this->sendMessageJson(false, "Ocorreu um erro ao processar a requisição, por favor entre com contato com desenvolvedor", "error", "Erro");
       }
    }

    private function sendMessageJson(bool $success, string $message = null, string $icon = null, string $title = null, string $link = null){
        echo json_encode([
         'success' => $success,
         'message' => $message,
         "title" => $title,
         "icon" => $icon,
         "link" => $link
        ]);

        exit;
   } 
}