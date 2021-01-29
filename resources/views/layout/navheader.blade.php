 <nav class="main-header navbar navbar-expand navbar-lightblue navbar-dark">
  
    <ul class="navbar-nav">
      <li class="nav-item bg-lightblue color-palette">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block bg-lightblue color-palette">
        <a href="#" class="nav-link">@yield('header', 'Report')</a>
      </li>
    </ul>
     <ul class="navbar-nav ml-auto">
       <div class="pull-right">
                  <a href="{{route('logout')}}" class=" btn bg-lightblue color-palette"> <i class=" fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
     </ul>
  </nav>