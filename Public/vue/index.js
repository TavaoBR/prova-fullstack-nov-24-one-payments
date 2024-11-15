Vue.component('home-section', {
  data() {
    return {
      title: "Pagina Inicial",
      jobs: [
        { type: "Financeiro", title: "Transações",  link:  `${dominio}/app/transacoes`},
        { type: "Produto", title: "Produtos",  link:  `${dominio}/app/produtos`},
      ],
    };
  },
  template: `
    <section class="container mt-5 pt-4">
      <div class="row align-items-end ">
        <div class="col-md-8">
          <div class="section-title text-center text-md-start">
            <h4 class="title mb-4">{{ title }}</h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div v-for="(job, index) in jobs" :key="index" class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
          <div class="card border-0 bg-light rounded shadow">
            <div class="card-body p-4">
              <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">{{ job.type }}</span>
              <h5>{{ job.title }}</h5>
              <div class="mt-3">
                <a :href="job.link" class="btn btn-primary">Entrar</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  `
});

new Vue({
  el: '#appHome'
});