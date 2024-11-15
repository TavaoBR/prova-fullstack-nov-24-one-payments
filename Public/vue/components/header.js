Vue.component('header-component', {
    data() {
      return {
        userProfile: { name: nomeCompleto, role: 'Cliente', img: `${path}usuario/${idUsuario}/${avatarUsuario}` },
        logoImg: {img: `${path}img/logo.png`}
      };
    },
    template: `
      <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
          <a href="#" class="logo d-flex align-items-center">
            <img :src="logoImg.img" alt="">
            <span class="d-none d-lg-block">One Payments</span>
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
  
        <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
              <a class="nav-link nav-icon search-bar-toggle" href="#"><i class="bi bi-search"></i></a>
            </li>
  


            <li class="nav-item dropdown pe-3">
              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img :src="userProfile.img" alt="Profile" class="rounded-circle">
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                  <h6>{{ userProfile.name }}</h6>
                  <span>{{ userProfile.role }}</span>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </header>
    `
  });
  
  new Vue({
    el: '#appheader'
  });