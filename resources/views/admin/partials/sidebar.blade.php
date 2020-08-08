<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/admin_img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset(env('IMG_ADMIN_PATH').Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('admin/dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/settings') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Settings</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li> -->
            </ul>
          </li>
            <li class="nav-item">
                <a href="{{ url('admin/sections') }}" class="nav-link">
                  <i class="fa fa-th-large nav-icon"></i>
                  <p>Sections</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/brands') }}" class="nav-link">
                  <i class="nav-icon fas fa-tree"></i>
                  <p>Brands</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/categories') }}" class="nav-link">
                  <i class="fa fa-th nav-icon"></i>
                  <p>Categories</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/products') }}" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>Products</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/orders') }}" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>Orders</p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>