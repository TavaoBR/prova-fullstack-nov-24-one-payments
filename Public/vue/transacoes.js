Vue.component('transacoes', {
    props: ['dados'],
    template: `
      <div class="container">
        <h2>Transações</h2>
        <div class="row">
          <div 
            v-for="(transacao, index) in dados" 
            :key="index" 
            class="col-lg-4">
            <div class="card card-margin">
              <div class="card-header no-border">
                <h5 class="card-title">Transação: {{ transacao.transacao_id }}</h5>
              </div>
              <div class="card-body pt-0">
                <div class="widget-49">
                  <ol class="widget-49-meeting-points">
                    <li class="widget-49-meeting-item"><span>Status: {{ transacao.status }}</span></li>
                    <li class="widget-49-meeting-item"><span>Data: {{ formatDate(transacao.data_transacao) }}</span></li>
                    <li class="widget-49-meeting-item"><span>Hora: {{ formatTime(transacao.hora_transacao) }}</span></li>
                    <li class="widget-49-meeting-item"><span>Comprador: {{ transacao.beneficiario }}</span></li>
                    <li class="widget-49-meeting-item"><span>Produto: {{ transacao.produto }}</span></li>
                    <li class="widget-49-meeting-item"><span>Valor: R$ {{ transacao.valor }}</span></li>
                    <li class="widget-49-meeting-item"><span>Método de Pagamento: {{ transacao.metodo_pagamento }}</span></li>
                    <li class="widget-49-meeting-item"><span>Descrição: {{ transacao.descricao }}</span></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `,
    methods: {
      formatDate(date) {
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return new Date(date).toLocaleDateString('pt-BR', options);
      },
      formatTime(time) {
        const options = { hour: '2-digit', minute: '2-digit' };
        return new Date(`1970-01-01T${time}Z`).toLocaleTimeString('pt-BR', options).slice(0, 5);
      }
    }
  });
  
  new Vue({
    el: '#appTransacoes',
    data() {
      return {
        dados: transacaoJson || [] // Certifique-se de que `transacaoJson` seja tratado corretamente
      };
    }
  });
  