<header class="main-header">
    <!-- Logo -->
    <a href="adminLTE/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>L</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Laporan </b>Keuangan</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('adminLTE/dist/img/default.jpg')}}" class="user-image" alt="User Image" style="margin-right: 6px;">
                <span class="hidden-xs">
                    <i class="dropdown-caret"></i>
                </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('adminLTE/dist/img/default.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }} - {{Auth::user()->roles[0]->display_name}}
                  <small>Software House Lampung</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();" 
                  class="btn btn-default btn-flat">Sign out</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>