<!DOCTYPE html>
<html lang="en">

 
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('public/assets/images/favicon.png') ?>">
    <title>Daljit Eye Hospital, Amritsar</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= asset('public/assets/plugins/morrisjs/morris.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset('public/css/style.css') ?>" rel="stylesheet">
     <link href="<?= asset('public/css/colors/blue.css') ?>" id="theme" rel="stylesheet">
         <link href="<?= asset('public/assets/plugins/toast-master/css/jquery.toast.css') ?>" rel="stylesheet">
             <link href="<?= asset('public/assets/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>" rel="stylesheet" type="text/css" />


         <script src="<?= asset('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
         <script src="<?= asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
          <script src="<?= asset('public/assets/plugins/sweetalert/sweetalert.min.js') ?>"></script>

    <script src="<?= asset('public/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
        <script src="<?= asset('public/assets/plugins/toast-master/js/jquery.toast.js') ?>"></script>
    <link href="<?= asset('public/assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
    <script src="<?= asset('public/assets/plugins/select2/dist/js/select2.full.min.js') ?>" type="text/javascript"></script>

 <script type="text/javascript">
    function toFixedIfNecessary( value, dp ){
      return +parseFloat(value).toFixed( dp );
    }
function  start_loader(){
    $('.preloader').show();
  }
 function stop_loader(){
    $('.preloader').hide();
  }
</script>
     <style type="text/css">
         .has_error{
            color:red;
            display: none;
         }
     </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand d-none d-sm-block
" href="{{url('/welcome')}}">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img style="    width: 198px;" src="<?= asset('public/assets/images/logo.jpg') ?>" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
<!--                             <img src="<?= asset('public/assets/images/logo-light-icon.png') ?>" alt="homepage" class="light-logo" />
 -->                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
<!--                          <img src="<?= asset('public/assets/images/logo-text.png') ?>" alt="homepage" class="dark-logo" /> -->
                         <!-- Light Logo text -->    
                         <img src="http://hotelavitajinn.com/images/logo/logo.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                    
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="{{ url('site/logout') }}" >
                                LOGOUT  <i class="fa fa-lock"></i> </a>
                            <!-- <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                        
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div> -->
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?= asset('public/assets/images/users/profile.png') ?>" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                     <div class="profile-text">
                        <h5>Admin</h5>
                        <!-- <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                        <a href="pages-login.html" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> -->
                        <div class="dropdown-menu animated flipInY">
                             <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                             <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                             <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                             <div class="dropdown-divider"></div>
                             <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                             <div class="dropdown-divider"></div>
                             <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                         </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">MASTERS</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Mode of Payment <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/mode-of-payment/create') }}">Add Mode of Payment </a></li>
                                <li><a href="{{ url('/mode-of-payment/index') }}">Mode of Payments List</a></li>
                             </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Room <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/room/create') }}">Add Room </a></li>
                                <li><a href="{{ url('/room/index') }}">Rooms List</a></li>
                             </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Companies <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/company/create') }}">Add company </a></li>
                                <li><a href="{{ url('/company/index') }}">Companies List</a></li>
                             </ul>
                        </li>
                       
                       
                          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Users <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/user-register/create') }}">Add User </a></li>
                                <li><a href="{{ url('/user-register/index') }}">Users List</a></li>
                             </ul>
                        </li>
                       
                        <li class="nav-small-cap">ENTRY</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Patient Admission</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/patient/create') }}">Add Patient & Admission</a></li>
                                <li><a href="{{ url('/patient/index') }}">Patient List</a></li>
                                <li><a href="{{ url('/booking/index') }}">Booking List</a></li>
                               
                            </ul>
                        </li>

                        <li class="nav-small-cap">Reports</li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Reports</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/booking/reports') }}">Discharge Report</a></li>
                                <li><a href="{{ url('/booking/room_report') }}">Daily Collection</a></li>
                             </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
                   <div class="page-wrapper">

            @yield('content')

             <footer class="footer">
                © 2019 Patient Management by Daljit Hosptial
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    
    <!-- Bootstrap tether Core JavaScript -->
     <script src="<?= asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= asset('public/js/jquery.slimscroll.js') ?>"></script>
    <!--Wave Effects -->
    <script src="<?= asset('public/js/waves.js') ?>"></script>
    <!--Menu sidebar -->
    <script src="<?= asset('public/js/sidebarmenu.js') ?>"></script>
    <!--stickey kit -->
    <script src="<?= asset('public/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= asset('public/js/custom.min.js') ?>"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="<?= asset('public/assets/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
    <!--morris JavaScript -->
    <script src="<?= asset('public/assets/plugins/raphael/raphael-min.js') ?>"></script>
    <script src="<?= asset('public/assets/plugins/morrisjs/morris.min.js') ?>"></script>
    <!-- Chart JS -->
    <script src="<?= asset('public/js/dashboard1.js') ?>"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
     <script type="text/javascript">

        function validateNumber(evt) {



             var theEvent = evt || window.event;

           // Handle paste



           if (theEvent.type === 'paste') {



               key = event.clipboardData.getData('text/plain');



           } else {



           // Handle key press



               var key = theEvent.keyCode || theEvent.which;



               key = String.fromCharCode(key);



           }



           var regex = /[0-9]|\./;



           if( !regex.test(key) ) {



             theEvent.returnValue = false;



             if(theEvent.preventDefault) theEvent.preventDefault();



           }



          }
          $(document).ready(function(){
                    $(".select2_c").select2();
                       

          })
    </script>
</body>


 </html>