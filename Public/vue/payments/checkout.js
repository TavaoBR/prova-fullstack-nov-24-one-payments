Vue.component('checkout', {
    data() {
      return {
        dados: {
          status: `${Status}`,
          beneficiario: `${comprador}`,
          produto: `${produto}`,
          valor: `${valor}`,
          transacaoId: `${transacao_id}`, 
        },
        dadosUsuario: {
          cartao_credito: ''
        }
      };
    },

    methods:{
 
      mascararCartao(){
         // Remove qualquer caractere não numérico
          this.dadosUsuario.cartao_credito = this.dadosUsuario.cartao_credito.replace(/\D/g, '');
          
          // Limita a 16 caracteres
          if (this.dadosUsuario.cartao_credito.length > 16) {
            this.dadosUsuario.cartao_credito = this.dadosUsuario.cartao_credito.slice(0, 16);
          }
      },

      async checkoutConfirmation(){

        
          Swal.fire({
            icon: 'info',
            title: 'Processando...',
            text: 'Aguarde enquanto processamos seu pagamento.',
            allowOutsideClick: false,
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: () => Swal.showLoading()
        });

        console.log('Dados do cartão:', this.dadosUsuario.cartao_credito);

          const payload = {
            transacao_id: this.dados.transacaoId,
            cartao_credito: this.dadosUsuario.cartao_credito,
            produto: this.dados.produto,
            valor: this.dados.valor
        };

        try {
          const response = await fetch(`${dominio}/transacao/pagamento`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
          });

          
                // Verifica o tipo de conteúdo da resposta
                const contentType = response.headers.get("Content-Type");
                console.log("Content-Type:", contentType); // Log do tipo da resposta
        
                if (!response.ok) {
                    throw new Error(`Erro HTTP: ${response.status} - ${response.statusText}`);
                }
        
                // Ler o conteúdo da resposta antes de tentar fazer o JSON
                const text = await response.text();
                console.log("Resposta bruta:", text); // Log da resposta bruta

              if(contentType && contentType.includes("application/json")){
                const result = JSON.parse(text); // Tentar converter manualmente para JSON

                if (result.success) {
                  Swal.fire({
                    icon: result.icon,
                    title: result.title,
                    text: result.message
                  }).then(()=>{
                    window.location.href = result.link
                  });
                } else {
                  Swal.fire({
                    icon: result.icon || 'error',
                    title: result.title || 'Erro',
                    text: result.message || 'Ocorreu um erro durante o checkout.'
                  });
                }

              } else {
                throw new Error("Resposta não é um JSON válido.");
              } 


             

        }catch(error){
          console.error(error);
          Swal.fire({
            icon: 'error',
            title: 'Erro de conexão',
            text: error.message || 'Não foi possível processar o checkout.'
          });
        }
      }

    },

    template: `
      <div class="container-fluid mt-5">
        <h2>Pagina de checkout do pagamento</h2>
        <div class="row">
          <div class="col-xl-8">
            <div class="card">
              <div class="card-body">
                <ol class="activity-checkout mb-0 px-4 mt-3">
                  <li class="checkout-item">
                    <div class="avatar checkout-icon p-1">
                      <div class="avatar-title rounded-circle bg-primary">
                        <i class="bx bxs-receipt text-white font-size-20"></i>
                      </div>
                    </div>
                    <div class="feed-item-list">
                      <div>
                        <h5 class="font-size-16 mb-1">Informações</h5>
                        <p class="text-muted text-truncate mb-4">Verifique as Informações antes de confirmar</p>
                        <p class="text-muted text-truncate mb-4">Para testar, use esse "7417574150495117" número pro campo Cartão de credito </p>
                        <div class="mb-3">
                          <form @submit.prevent="checkoutConfirmation">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label" for="billing-status">Status da compra</label>
                                  <input type="text" class="form-control" id="billing-status" :value="dados.status" disabled>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label" for="billing-buyer">Comprador</label>
                                  <input type="text" class="form-control" id="billing-buyer" :value="dados.beneficiario" disabled>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label" for="billing-product">Produto</label>
                                  <input type="text" class="form-control" id="billing-product" :value="dados.produto" disabled>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label" for="billing-value">Valor</label>
                                  <input type="text" class="form-control" id="billing-value" :value="dados.valor" disabled>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label" for="billing-card">Cartão de Crédito</label>
                                  <input type="text" class="form-control" id="billing-card" v-model="dadosUsuario.cartao_credito" @input="mascararCartao">
                                </div>
                              </div>
                            </div>
                            <div class="row my-4">
                              <div class="col">
                                <button class="btn btn-success" type="submit">
                                  Confirmar  
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  });

  new Vue({
    el: '#checkout'
  });
