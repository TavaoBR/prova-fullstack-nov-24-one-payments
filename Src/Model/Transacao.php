<?php 

namespace Src\Model;

use Src\Database\Model\Model; 

class Transacao extends Model {

    protected string $table = 'transacao';
    public int $id, $fk;
    public float $valor;
    public string $status, $transacaoId, $beneficiario, $produto, $descricao, $metodoPagamento, $dataTransacao, $horaTransacao;

    public function inserir(){
        
        $inserir = $this->create([
           "fk_usuario" => $this->fk,
           "transacao_id" => $this->transacaoId,
           "beneficiario" => $this->beneficiario,
           "produto" => $this->produto,
           "valor" => $this->valor,
           "status" => $this->status,
           "metodo_pagamento" => $this->metodoPagamento,
           "data_transacao" => $this->dataTransacao,
           "hora_transacao" => $this->horaTransacao,
        ]);

        return $inserir;
    }

    public function byFK(){
        return $this->findBy("fk_usuario", $this->fk, false);
    }

    public function byTransacaoId(){
        return $this->findBy("transacao_id", $this->transacaoId);
    }

    public function updateStatus(){
        return $this->update("transacao_id", $this->transacaoId, ["status" => $this->status, "descricao" => $this->descricao]);
    }



 
}