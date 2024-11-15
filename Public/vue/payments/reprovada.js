Vue.component('rejeitado', {
    data(){
        return {
            info: {
                segundoTexto: "Infelizmente seu pagamento foi rejeitado",
                transacaoId: `Número Transação: ${transacao_id}`,
                descricao: `${descricao}` 
            }
        };
    },
    template: `
      <div class="container mt-5 text-center">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">{{info.transacaoId}}</h4>
          <p>{{info.segundoTexto}}</p>
          <p>{{info.descricao}}</p>
          <hr>
          <a href="${dominio}/app/transacoes" class="btn btn-primary">Voltar à Página Inicial</a>
        </div>
      </div>
    `
  });

  new Vue({
    el: '#rejeitado'
  });