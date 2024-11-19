<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto text-left">
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <!-- Logout Form -->
          <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-inline">
              @csrf
              <button type="submit" class="dropdown-item text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
              </button>
          </form>
      </div>
  </li>
</ul>

  </nav>