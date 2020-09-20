<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset("/assets/vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/flag-icon-css/css/flag-icon.min.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/css/vendor.bundle.base.css")}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset("/assets/vendors/jquery-bar-rating/css-stars.css" )}}"/>
    <link rel="stylesheet" href="{{asset("/assets/vendors/font-awesome/css/font-awesome.min.css")}}"" />
    
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset("/assets/css/demo_2/style.css")}}" />
    <link rel="stylesheet" href="{{asset("/assets/vendors/datatables/datatables.min.css")}}" />
    <link rel="stylesheet" href="{{asset("/assets/vendors/select2/css/select2.min.css")}}" />
    <link rel="stylesheet" href="{{asset("/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css")}}" />
    <link rel="stylesheet" href="{{asset("/assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css")}}" />
    <link rel="stylesheet" href="{{asset("/assets/css/bootstrap-datetimepicker.css")}}" />
    <link rel="stylesheet" href="{{asset("/assets/css/custom.css")}}" />
   
   
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset("/assets/images/favicon.png")}}" />
    @yield('style')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      <div class="horizontal-menu">
      
        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="index.html">
                  <i class="mdi mdi-compass-outline menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title">UI Elements</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdown</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url("plans")}}">
                  <i class="mdi mdi-clipboard-text menu-icon"></i>
                  <span class="menu-title">Plans</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url("role")}}">
                  <i class="mdi mdi-contacts menu-icon"></i>
                  <span class="menu-title">Role</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/charts/chartjs.html">
                  <i class="mdi mdi-chart-bar menu-icon"></i>
                  <span class="menu-title">Charts</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/tables/basic-table.html">
                  <i class="mdi mdi-table-large menu-icon"></i>
                  <span class="menu-title">Tables</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://www.bootstrapdash.com/demo/plus-free/documentation/documentation.html" class="nav-link" target="_blank">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Docs</span></a>
              </li>
              <li class="nav-item">
                <div class="nav-link d-flex">
                  <button class="btn btn-sm bg-danger text-white"> Trailing </button>
                  <div class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle text-white font-weight-semibold" id="notificationDropdown" href="#" data-toggle="dropdown"> English </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                      <a class="dropdown-item" href="#">
                        <i class="flag-icon flag-icon-bl mr-3"></i> French </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">
                        <i class="flag-icon flag-icon-cn mr-3"></i> Chinese </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">
                        <i class="flag-icon flag-icon-de mr-3"></i> German </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">
                        <i class="flag-icon flag-icon-ru mr-3"></i>Russian </a>
                    </div>
                  </div>
                  <a class="text-white" href="index.html"><i class="mdi mdi-home-circle"></i></a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div id="mainAlert" class="col-12"></div> 
            @yield('content')
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset("/assets/vendors/js/vendor.bundle.base.js")}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset("/assets/vendors/jquery-bar-rating/jquery.barrating.min.js")}}"></script>
    <script src="{{asset("/assets/vendors/chart.js/Chart.min.js")}}"></script>
    <script src="{{asset("/assets/vendors/flot/jquery.flot.js")}}"></script>
    <script src="{{asset("/assets/vendors/flot/jquery.flot.resize.js")}}"></script>
    <script src="{{asset("/assets/vendors/flot/jquery.flot.categories.js")}}"></script>
    <script src="{{asset("/assets/vendors/flot/jquery.flot.fillbetween.js")}}"></script>
    <script src="{{asset("/assets/vendors/flot/jquery.flot.stack.js")}}"></script>
    <script src="{{asset("/assets/vendors/datatables/datatables.min.js")}}"></script>
    <script src="{{asset("/assets/vendors/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("/assets/vendors/moment/moment.js")}}"></script>
    <script src="{{asset("/assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{asset("/assets/js/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/assets/vendors/inputmask/jquery.inputmask.bundle.min.js")}}"></script>
    <script src="{{asset("/assets/js/sweetalert2.all.min.js")}}"></script>
    <script src="{{asset("/assets/js/jquery.blockUI.js")}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset("/assets/js/off-canvas.js")}}"></script>
    <script src="{{asset("/assets/js/hoverable-collapse.js")}}"></script>
    <script src="{{asset("/assets/js/misc.js")}}"></script>
    <script src="{{asset("/assets/js/settings.js")}}"></script>
    <script src="{{asset("/assets/js/todolist.js")}}"></script>
    <script src="{{asset("/assets/js/file-upload.js")}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset("/assets/js/dashboard.js")}}"></script>
    
    <script src="{{asset("/assets/js/select2.js")}}"></script>
    <script src="{{asset("/assets/scripts.js")}}"></script>
    <!-- End custom js for this page -->

    @yield('scripts')
  </body>
</html>