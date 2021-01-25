<nav class="main-header navbar navbar-expand navbar-secondary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item bg-secondary color-palette">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block bg-secondary color-palette">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
   <!--  <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
 -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="dropdown user user-menu bg-secondary color-palette">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset('assets/dist/img/avtar6.png')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('assets/dist/img/avtar6.png')}}" class="img-circle" alt="User Image">

                <p>
                {{Auth::user()->name}}
                  
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{Request::root()}}/admin/profile" class="btn btn-primary btn-flat"><i class="fas fa-user mr-2"></i>Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{Request::root()}}/logout" class="btn btn-danger btn-flat"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class=" fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
          </ul>
  </nav>