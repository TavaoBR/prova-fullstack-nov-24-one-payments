Vue.component('produto-section', {
    props: ['dados'],
    data() {
       return {
        dadosUsuario: {
          usuario_id: `${idUsuario}`,
          usuario_nome: `${nomeCompleto}`
        }
       }
    },
    methods:{

        async processarProduto(produtoId){
          
            Swal.fire({
                icon: 'info',
                title: 'Processando...',
                text: 'Aguarde enquanto processamos seu pagamento.',
                allowOutsideClick: false,
                showConfirmButton: false,
                timerProgressBar: true,
                didOpen: () => Swal.showLoading()
            });

            const produto = this.dados.find(p => p.id === produtoId);
                
                if(!produto){
                  throw new Error('Produto não encontrado');  
                }

                console.log("Produto: " + produto.nome + "Valor: " + produto.valor);
                console.log("id: " + this.dadosUsuario.usuario_id);

                const Infoproduto = {
                    produto_nome: produto.nome,
                    produto_valor: produto.valor,
                    fk_usuario: this.dadosUsuario.usuario_id,
                    beneficiario: this.dadosUsuario.usuario_nome 
                }

                console.log("Infoproduto:", Infoproduto);

            try{

             const response = await fetch(`${dominio}/transacao/processar`, {
               method: 'POST',
               headers: {
                'Content-Type': 'application/json'
               },
               body: JSON.stringify(Infoproduto)
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

                if(result.success){
                    Swal.fire({
                        icon: result.icon,
                        title: result.title,
                        text: result.message
                      }).then(()=>{
                        window.location.href = result.link
                      });
                }else{
                    Swal.fire({
                        icon: result.icon || 'error',
                        title: result.title || 'Erro',
                        text: result.message || 'Ocorreu um erro durante o checkout.'
                      });
                }

             }else{
                throw new Error("Resposta não é um JSON válido.");
             }
                

            }catch (error) {
                console.error(error);
                Swal.fire({
                  icon: 'error',
                  title: 'Erro',
                  text: error.message || 'Não foi possível processar a solicitação.'
                 });
            }

        }

    },
    template: `
      <div class="container">
         <h2>Produtos</h2>
        <div class="row mt-n5">
          <div 
            v-for="(produto, index) in dados" 
            :key="index" 
            class="col-md-6 col-lg-4 mt-5 wow fadeInUp" 
            data-wow-delay=".2s" 
            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
            
            <div class="blog-grid">
              <div class="blog-grid-img position-relative">
                <img :alt="produto.nome" :src="produto.imagem" />
              </div>
              <div class="blog-grid-text p-4">
                <h3 class="h5 mb-3">
                  <a>{{ produto.nome }}</a>
                </h3>
                <p class="display-30">R$ {{ produto.valor }}</p>
                <div class="meta meta-style2">
                  <ul>
                    <button 
                      class="btn btn-primary" 
                      :disabled="loading"
                      @click="processarProduto(produto.id)">
                      Gerar Pagamento
                    </button>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    `
  });

  new Vue({
    el: '#appProdutos',
    data() {
      return {
        dados: dadosProduto
      };
    }
  });

