  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
  
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt "></i>
        </a>
      </li>


      <!-- Notification Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell "></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Dummy Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new dumy messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 dummy friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new dummyreports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

 <!-- My Account Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('assets/img/avatar-b.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                {{ Auth::guard('admin')->user()->name }}
                  <span class="float-right text-sm text-success"><i class="fas fa-circle"></i></span>
                </h3>
                <p class="text-sm">{{ Auth::guard('admin')->user()->email }}</p>
                <p class="text-sm text-muted">
                {{ Auth::guard('admin')->user()->last_login_at }}
                  <br>
                  {{ Auth::guard('admin')->user()->last_login_ip }}
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item text-primary">
            <i class="far fa-id-card mr-2"></i> My Account           
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>


      

     
     
    </ul>
  </nav>
  <!-- /.navbar -->



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{asset('assets/img/logo.png')}}" alt="School Management System"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
   
        <!-- Sidebar Menu -->
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->


                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link  {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.students.list') }}" class="nav-link {{ (request()->is('admin/students')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                        Students
                        </p>
                    </a>
                </li>

               
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                        Teachers
                        </p>
                    </a>
                </li>



                <li class="nav-item menu-{{ (request()->is('admin/master-data*')) ? 'open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/master-data*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <!-- <i class="fa-regular fa-arrow-progress"></i> -->
                        <p>
                        Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview  ">
                        <li class="nav-item">
                            <a href="{{ route('admin.masterdata.academicFees') }}" class="nav-link  {{ (request()->is('admin/master-data/academic-fees*')) ? 'active' : '' }}">
                                <i class="fas fa-rupee-sign nav-icon"></i>
                                <p>Academic Fees</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ (request()->is('vrs/connection/list')) ? 'active' : '' }}">
                                <i class="fas fa-link nav-icon"></i>
                                <p>Exam setup</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-file-alt nav-icon"></i>
                                <p>Batch</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
               
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                        Settings
                        </p>
                    </a>
                </li>
<!--             
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ (request()->is('staff/list')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Study Material
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                         Question Paper
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-paint-roller"></i>
                        <p>
                        Maintenance
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                        Help Pages
                        </p>
                    </a>
                </li> -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
