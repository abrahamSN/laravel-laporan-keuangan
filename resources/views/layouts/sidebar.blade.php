  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminLTE/dist/img/default.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::user()->roles[0]->display_name}}</a>
        </div>
      </div>
      <hr style="margin-top:5px; margin-bottom:5px;">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard" style="color:#0073b7;"></i> <span>Dashboard</span></a></li>
               
        @if(Auth::user()->can(['jasa-view']))
        <li><a href="{{ url('/jasa') }}"><i class="fa fa-archive" style="color:#0073b7;"></i> <span>Jasa</span></a></li>
        @endif

        @if(Auth::user()->can(['pengeluaran-view']))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calculator" style="color:#0073b7;"></i> <span>Pengeluaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/pengeluaran') }}"><i class="fa fa-circle-o"></i>Data Pengeluaran</a></li>
            <li><a href="{{ url('/pengeluaran/report') }}"><i class="fa fa-circle-o"></i>Report Pengeluaran</a></li>
          </ul>
        </li>
        @endif

        @if(Auth::user()->can(['pemasukan-view']))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calculator" style="color:#0073b7;"></i> <span>Pemasukan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/pemasukan') }}"><i class="fa fa-circle-o"></i>Data Pemasukan</a></li>
            <li><a href="{{ url('/pemasukan/report') }}"><i class="fa fa-circle-o"></i>Report Pemasukan</a></li>
          </ul>
        </li>
        @endif

        @if(Auth::user()->hasRole('admin'))
        <li class="header">Pengaturan Akses User</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears" style="color:#0073b7;"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/permission') }}"><i class="fa fa-circle-o"></i> Permission</a></li>
            <li><a href="{{ url('/role') }}"><i class="fa fa-circle-o"></i> Role</a></li>
            <li><a href="{{ url('/user') }}"><i class="fa fa-circle-o"></i> User</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>