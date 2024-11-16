Vue.component('page-erro', {

    data(){
        return {
            error: {
                codigo: `${erro}`,
                message: `${descricao}`
            }
        } 
    },

    template: `
      <div class="page-404">
        <div class="outer">
          <div class="middle">
            <div class="inner">
              <!--BEGIN CONTENT-->
              <div class="inner-circle">
                <i class="fa fa-cogs"></i>
                <span>{{error.codigo}}</span>
              </div>
              <span class="inner-status">{{error.message}}</span>
              <span class="inner-detail">
                <a href="javascript:history.go(-1);" class="btn btn-custom btn-primary">
                  Clique aqui para sair da página
                </a>
              </span>
            </div>
          </div>
        </div>
      </div>
    `
  });
  
  new Vue({
    el: '#appErro'
  });