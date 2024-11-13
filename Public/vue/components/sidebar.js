Vue.component('sidebar-component', {
    data() {
      return {
        sidebarItems: [
          { icon: 'bi bi-person', title: 'Perfil', link: 'users-profile.html' },
          { icon: 'bx bxs-credit-card', title: 'Cartão de Crédito', link: 'pages-faq.html' },
          { icon: 'bx bxl-product-hunt', title: 'Produtos', link: 'pages-contact.html' },
          { icon: 'bx bx-money-withdraw', title: 'Transações', link: 'pages-contact.html' },
          { icon: 'bx bx-exit', title: 'Sair', link: 'pages-contact.html' }
        ]
      };
    },
    template: `
      <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
          <li v-for="(item, index) in sidebarItems" :key="index" class="nav-item">
            <a class="nav-link collapsed" :href="item.link">
              <i :class="item.icon"></i><span>{{ item.title }}</span>
            </a>
          </li>
        </ul>
      </aside>
    `
  });
  
  new Vue({
    el: '#appSidebar'
  });