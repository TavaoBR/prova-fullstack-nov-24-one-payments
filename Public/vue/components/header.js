Vue.component('header-component', {
    data() {
      return {
        notifications: [
          { icon: 'bi-exclamation-circle text-warning', title: 'Lorem Ipsum', message: 'Quae dolorem earum veritatis oditseno', time: '30 min. ago' },
          { icon: 'bi-x-circle text-danger', title: 'Atque rerum nesciunt', message: 'Quae dolorem earum veritatis oditseno', time: '1 hr. ago' },
          { icon: 'bi-check-circle text-success', title: 'Sit rerum fuga', message: 'Quae dolorem earum veritatis oditseno', time: '2 hrs. ago' },
          { icon: 'bi-info-circle text-primary', title: 'Dicta reprehenderit', message: 'Quae dolorem earum veritatis oditseno', time: '4 hrs. ago' },
        ],
        userProfile: { name: 'Kevin Anderson', role: 'Web Designer', img: `${path}img/profile-img.jpg` },
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
  
        <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
        </div>
  
        <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
              <a class="nav-link nav-icon search-bar-toggle" href="#"><i class="bi bi-search"></i></a>
            </li>
  
            <li class="nav-item dropdown">
              <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number">{{ notifications.length }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                  You have {{ notifications.length }} new notifications
                  <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li v-for="(notification, index) in notifications" :key="index">
                  <hr class="dropdown-divider" v-if="index > 0">
                  <div class="notification-item">
                    <i :class="notification.icon"></i>
                    <div>
                      <h4>{{ notification.title }}</h4>
                      <p>{{ notification.message }}</p>
                      <p>{{ notification.time }}</p>
                    </div>
                  </div>
                </li>
              </ul>
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
                <hr class="dropdown-divider">
                <li><a class="dropdown-item d-flex align-items-center" href="users-profile.html"><i class="bi bi-person"></i><span>My Profile</span></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item d-flex align-items-center" href="users-profile.html"><i class="bi bi-gear"></i><span>Account Settings</span></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item d-flex align-items-center" href="pages-faq.html"><i class="bi bi-question-circle"></i><span>Need Help?</span></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-box-arrow-right"></i><span>Sign Out</span></a></li>
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