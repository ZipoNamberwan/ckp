<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>CKP Online - BPS Provinsi NTT</title>
  <!-- Favicon -->
  <link rel="icon" href="/assets/img/brand/ckp logo.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Additional Stylesheet -->
  @yield('stylesheet')
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/css/argon.css?v=1.1.0" type="text/css">
  <link rel="stylesheet" href="/assets/style.css">

</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="/">
          <img src="/assets/img/brand/ckp logo 2.png" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          @role('user|supervisor')
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">CKP</h6>
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/ckps') }}">
                <i class="fas fa-file-alt text-orange"></i>
                <span class="nav-link-text">CKP</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/download') }}">
                <i class="fas fa-cloud-download-alt text-red"></i>
                <span class="nav-link-text">Unduh</span>
              </a>
            </li>
          </ul>
          @endrole
          @role('supervisor|admin')
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Monitoring</h6>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/monitoring') }}">
                <i class="fas fa-eye text-purple"></i>
                <span class="nav-link-text">Monitoring</span>
              </a>
            </li>
          </ul>
          @endrole
          @role('supervisor')
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Penilaian</h6>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/ratings') }}">
                <i class="fas fa-star text-cyan"></i>
                <span class="nav-link-text">Isi Penilaian</span>
              </a>
            </li>
          </ul>
          @endrole
          @role('admin')
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Sistem</h6>
          <!-- Navigation -->
          @endrole
          @role('admin')
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/users') }}">
                <i class="fas fa-users"></i>
                <span class="nav-link-text">User</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/departments') }}">
                <i class="fas fa-dice-d6"></i>
                <span class="nav-link-text">Jenjang Jabatan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/organizations') }}">
                <i class="fas fa-building"></i>
                <span class="nav-link-text">Unit Kerja</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/settings') }}">
                <i class="fas fa-tools"></i>
                <span class="nav-link-text">Pengaturan</span>
              </a>
            </li>
          </ul>
          @endrole
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->

    <!-- Page content -->
    <div class="main-content" id="panel">
      <!-- Navigation bar -->
      <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
              <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                  </div>
                  <input class="form-control" placeholder="Search" type="text">
                </div>
              </div>
              <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </form>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
              <li class="nav-item d-xl-none">
                <!-- Sidenav toggler -->
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </div>
              </li>
              <li class="nav-item d-sm-none">
                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                  <i class="ni ni-zoom-split-in"></i>
                </a>
              </li>
              {{-- <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                  <!-- Dropdown header -->
                  <div class="px-3 py-3">
                    <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
                  </div>
                  <!-- List group -->
                  <div class="list-group list-group-flush">
                    <a href="#!" class="list-group-item list-group-item-action">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <!-- Avatar -->
                          <img alt="Image placeholder" src="/assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
          </div>
          <div class="text-right text-muted">
            <small>2 hrs ago</small>
          </div>
        </div>
        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
    </div>
  </div>
  </a>
  <a href="#!" class="list-group-item list-group-item-action">
    <div class="row align-items-center">
      <div class="col-auto">
        <!-- Avatar -->
        <img alt="Image placeholder" src="/assets/img/theme/team-2.jpg" class="avatar rounded-circle">
      </div>
      <div class="col ml--2">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
          </div>
          <div class="text-right text-muted">
            <small>3 hrs ago</small>
          </div>
        </div>
        <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
      </div>
    </div>
  </a>
  <a href="#!" class="list-group-item list-group-item-action">
    <div class="row align-items-center">
      <div class="col-auto">
        <!-- Avatar -->
        <img alt="Image placeholder" src="/assets/img/theme/team-3.jpg" class="avatar rounded-circle">
      </div>
      <div class="col ml--2">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
          </div>
          <div class="text-right text-muted">
            <small>5 hrs ago</small>
          </div>
        </div>
        <p class="text-sm mb-0">Your posts have been liked a lot.</p>
      </div>
    </div>
  </a>
  <a href="#!" class="list-group-item list-group-item-action">
    <div class="row align-items-center">
      <div class="col-auto">
        <!-- Avatar -->
        <!-- <img alt="Image placeholder" src="/assets/img/theme/user icon.png" class="avatar rounded-circle"> -->
      </div>
      <div class="col ml--2">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
          </div>
          <div class="text-right text-muted">
            <small>2 hrs ago</small>
          </div>
        </div>
        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
      </div>
    </div>
  </a>
  <a href="#!" class="list-group-item list-group-item-action">
    <div class="row align-items-center">
      <div class="col-auto">
        <!-- Avatar -->
        <img alt="Image placeholder" src="/assets/img/theme/team-5.jpg" class="avatar rounded-circle">
      </div>
      <div class="col ml--2">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-sm">{{ Auth::user()->name }}</h4>
          </div>
          <div class="text-right text-muted">
            <small>3 hrs ago</small>
          </div>
        </div>
        <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
      </div>
    </div>
  </a>
  </div>
  <!-- View all -->
  <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
  </div>
  </li> --}}
  </ul>
  <ul class="navbar-nav align-items-center ml-auto ml-md-0">
    <li class="nav-item dropdown">
      <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="media align-items-center">
          <span class="avatar avatar-sm rounded-circle">
            <img alt="Image placeholder" src="/assets/img/theme/user icon.png">
          </span>
          <div class="media-body ml-2 d-none d-lg-block">
            <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
          </div>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header noti-title">
          <h6 class="text-overflow m-0">Welcome!</h6>
        </div>
        <a href="#!" class="dropdown-item">
          <i class="ni ni-single-02"></i>
          <span>Profil</span>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="ni ni-user-run"></i>
            <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
      </div>
    </li>
  </ul>
  </div>
  </div>
  </nav>
  @yield('container')
  <!-- Footer -->
  <div class="container-fluid">
    <footer class="footer pt-0">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
          <div class="copyright text-center text-lg-left text-muted">
            &copy; 2021 <a href="https://ntt.bps.go.id" class="font-weight-bold ml-1" target="_blank">BPS Provinsi NTT</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="https://s.bps.go.id/xxxx" class="nav-link" target="_blank">Panduan</a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
  <div class="sk-cube-background" id="loading-background" style="display: none;">
    <div class="sk-cube-grid">
      <div class="sk-cube sk-cube1"></div>
      <div class="sk-cube sk-cube2"></div>
      <div class="sk-cube sk-cube3"></div>
      <div class="sk-cube sk-cube4"></div>
      <div class="sk-cube sk-cube5"></div>
      <div class="sk-cube sk-cube6"></div>
      <div class="sk-cube sk-cube7"></div>
      <div class="sk-cube sk-cube8"></div>
      <div class="sk-cube sk-cube9"></div>
    </div>
  </div>
  </div>



  </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  @yield('optionaljs')
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.1.0"></script>
</body>

</html>