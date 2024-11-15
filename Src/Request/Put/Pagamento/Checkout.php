<?php 

namespace Src\Request\Put\Pagamento;

use Src\Model\Transacao;
use Config\Datas;

class Checkout {

    private Transacao $transacao;
    private Datas $datas;
    private ?string $cartao_credito;
    private ?string $produto;
    private ?string $valor;

    public function __construct(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json"); // Garante que o conteúdo seja JSON
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $data = json_decode(file_get_contents("php://input"), true);
        $this->transacao = new Transacao;
        $this->datas = new Datas;
        $this->cartao_credito = $data['cartao_credito'] ?? null;
        $this->transacao->transacaoId = $data['transacao_id'] ?? '';
        $this->produto = $data['produto'] ?? null;
        $this->valor = $data['valor'] ?? null;
        
    }

    public function request(){
         if(!$this->verificarCartao() && !$this->verifiqueSaldoValor()){
             $this->transacao();
         }

        }

    private function transacao() {
          $simular = rand(0,1);
          $status = $simular === 1 ? "Aprovado" : "Reprovada";
          $data = date("d/m/Y", strtotime($this->datas->dataAtual()));
          $hora = date("H:i" , strtotime($this->datas->horaAtual()));
          
            $this->transacao->status = $status; 
            $this->transacao->descricao = "Compra {$this->produto} no valor de R$ {$this->valor}. $status na data de $data às $hora";

            $update = $this->transacao->updateStatus();

            if($update > 0){
                $link = dominio()."/app/transacao/pagamento/status/{$this->transacao->transacaoId}/$status";
                $this->sendMessageJson(true, "Compra {$status}", "success", "{$status}", $link);
            }else{
                $this->sendMessageJson(false, "Ocorreu um erro ao processar a requisição, por favor entre com contato com desenvolvedor", "error", "Erro");
            }
    }

    private function verificarCartao(){
        

        if($this->cartao_credito == "" ){
             $this->sendMessageJson(false, "Preencha o campo Cartão de Credito", "warning", "Preencher");
            return true;
        }

        $cartao = "7417574150495117";

        if($cartao != $this->cartao_credito){
            $this->sendMessageJson(false, "Cartão de Credito Invalido", "error", "Error");
          return true;
        }

        return false;
    }

    private function verifiqueSaldoValor(){

        $saldo = "100.00";

        if($saldo < $this->valor){
           
            $this->transacao->status = "Reprovada";
            $this->transacao->descricao = "Compra {$this->produto} no valor de R$ {$this->valor}. Reprovada por falta de saldo";
            $update = $this->transacao->updateStatus();
            if($update > 0){
                $link = dominio()."/app/transacao/pagamento/status/{$this->transacao->transacaoId}/{$this->transacao->status}";
                $this->sendMessageJson(true, "Compra reprovada por falta de saldo", "error", "Reprovado", $link);
            }else{
                $this->sendMessageJson(false, "Ocorreu um erro ao processar a requisição, por favor entre com contato com desenvolvedor", "error", "Erro");
            }


            return true;
        }

        return false;
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