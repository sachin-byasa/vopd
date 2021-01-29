<?php 
 $menu = \App\Models\MenuMaster::activeGroupMenu();
 $CommonUtils = new \App\Library\CommonUtils();
?>

<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
     <a href="#" class="brand-link">
      <img src="{{ asset('images/ArmmanLogo.jpg') }}" alt="AdminLTE Logo" style="width:98%";>
    
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 204px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible os-viewport-native-scrollbars-overlaid" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <<!-- div class="image">
          <img src="{{asset('assets/dist/img/vopd_sample1.png')}}"  alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menu as $key => $value)
                <li class="nav-item has-treeview  @if($value[0]['menu_id'] == Session::get('active_page_menu_master')) menu-open @endif">
                    <a class="nav-link" style="background-color: #3c8dbc;color: #eef8ff" href="javascript::void(0);" aria-expanded="false">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p> {{$key}} <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                    @foreach($value as $m)
                   
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('active_page_controller') == $m['controllername']) active @endif" 
                        href="{{route($CommonUtils->getSlug($m['controllername']).'.'.$CommonUtils->getSlug($m['methodname']))}}" aria-expanded="false">
                         <i class="far fa-circle nav-icon"></i><p>{{$m['child_name']}}</p>
                        </a>
                    </li>
                    @endforeach
                    </ul>
                @endforeach
                </li>
                </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 16.2957%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>