Vue.component('checkout-not-found', {
    template: `
      <div class="container mt-5 text-center">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Código de Transação Não Encontrado</h4>
          <p>O código de transação informado não foi localizado. Por favor, verifique o código e tente novamente.</p>
          <hr>
          <a href="${dominio}/app/transacoes" class="btn btn-primary">Voltar à Página Inicial</a>
        </div>
      </div>
    `
  });

  new Vue({
    el: '#checkout-not-found'
  });