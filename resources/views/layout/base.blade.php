<!DOCTYPE html>
<html lang="en">

<head>
  @include('layout.header')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"> </script>
  <script src="js/app.js"></script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="template/ruang-admin/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">NEXURA</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>MENU</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Nesura</h6>
            <a class="collapse-item" href="/">Nuevo Empleado</a>
            <a class="collapse-item" href="/viewTableEmpleado"  >Listado de Empleado</a>
          </div>
        </div>
      </li>
     
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="navbar-search">
                        <div class="input-group">
                        <input type="text" id="form_search" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                            aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                    </div>
                </li>
                
                </ul>
            </nav>
        <!-- Topbar -->

        @yield('content')
      </div>
      <!-- Footer -->
        @include('layout.footer')
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
 

  <!--<script src="template/ruang-admin/vendor/jquery/jquery.min.js"></script>-->
  
  
 <script src="template/ruang-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="template/ruang-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="template/ruang-admin/js/ruang-admin.min.js"></script>
 <!-- <script src="template/ruang-admin/vendor/chart.js/Chart.min.js"></script>--
  <script src="template/ruang-admin/js/demo/chart-area-demo.js"></script> 


  
</body>

</html>