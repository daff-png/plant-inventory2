<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Tanaman</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet"/>
    
    <style>
      body {
        background-color: #f8f9fa; 
      }
    </style>
</head>
<body style="background-color: #f8f9fa;">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-0" style="background-color: #2E7D32;">
          <div class="container-fluid">
            <button
              data-mdb-collapse-init
              class="navbar-toggler"
              type="button"
              data-mdb-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <a class="navbar-brand mt-2 mt-lg-0" href="{{ url('/home') }}">
                <i class="fas fa-seedling me-2"></i>
                <strong>Inventaris Tanaman</strong>
              </a>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                  <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Dashboard</a>
                  </li>
                  
                  <li class="nav-item dropdown">
                    <a
                      data-mdb-dropdown-init
                      class="nav-link dropdown-toggle {{ (request()->routeIs('plants.*') || request()->routeIs('plant-categories.*')) ? 'active' : '' }}"
                      href="#"
                      id="navbarDropdownMenuLink"
                      role="button"
                      aria-expanded="false"
                    >
                      Daftar Tanaman
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ route('plants.index') }}">Lihat Tanaman</a></li>
                      <li><a class="dropdown-item" href="{{ route('plant-categories.index') }}">Lihat Kategori</a></li>
                    </ul>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('plant-progresses.*') ? 'active' : '' }}" href="{{ route('plant-progresses.index') }}">Progres Tanaman</a>
                  </li>
                  
                  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                    <li class="nav-item dropdown">
                      <a
                        data-mdb-dropdown-init
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="navbarDropdownStaffLink"
                        role="button"
                        aria-expanded="false"
                      >
                        Manajemen
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownStaffLink">
                        <li><a class="dropdown-item" href="{{ route('plants.create') }}">Tambah Tanaman Baru</a></li>
                        <li><a class="dropdown-item" href="{{ route('plant-progresses.create') }}">Tambah Progres</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('plant-categories.create') }}">Tambah Kategori</a></li>
                        <li><a class="dropdown-item" href="{{ route('plant-tips.index') }}">Manajemen Tips</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('export.plants') }}">Export Data Tanaman</a></li>
                      </ul>
                    </li>
                  @endif
                  
                  @if(Auth::user()->role == 'admin')
                    <li class="nav-item dropdown">
                      <a
                        data-mdb-dropdown-init
                        class="nav-link dropdown-toggle {{ (request()->routeIs('users.*') || request()->routeIs('plants.trash') || request()->routeIs('users.trash')) ? 'active' : '' }}"
                        href="#"
                        id="navbarDropdownAdminLink"
                        role="button"
                        aria-expanded="false"
                      >
                        Admin
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdminLink">
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Manajemen Petugas</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.create') }}">Tambah Petugas Baru</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('plants.trash') }}">Data Tanaman (Trash)</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.trash') }}">Data Petugas (Trash)</a></li>
                      </ul>
                    </li>
                  @endif
                  
                @endauth
              </ul>
              </div>
            <div class="d-flex align-items-center">
              @guest
                  @if (Route::has('login'))
                      <a href="{{ route('login') }}" class="btn btn-link px-3 me-2 text-white">Login</a>
                  @endif
                  @if (Route::has('register'))
                      <a href="{{ route('register') }}" class="btn btn-outline-light" data-mdb-ripple-init>Register</a>
                  @endif
              @else
                <div class="dropdown">
                  <a
                    data-mdb-dropdown-init
                    class="dropdown-toggle d-flex align-items-center hidden-arrow"
                    href="#"
                    id="navbarDropdownMenuAvatar"
                    role="button"
                    aria-expanded="false"
                  >
                    <span class="me-2 d-none d-sm-inline text-white">{{ Auth::user()->name }}</span>
                    
                    <i class="fas fa-user-circle fa-lg text-white"></i>
                    
                  </a>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuAvatar"
                  >
                    <li><a class="dropdown-item" href="#">Role: {{ strtoupper(Auth::user()->role) }}</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                  </ul>
                </div>
              @endguest
            </div>
            </div>
          </nav>
        <main class="py-5"> <div class="container">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            
                @yield('content')
            </div>
        </main>
        </div>
    
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"
    ></script>
</body>
</html>