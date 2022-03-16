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
    <title>Dr Daljit Singh Eye Hospital Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset('public/css/style.css') ?>" rel="stylesheet">
     <link href="<?= asset('public/css/colors/blue.css') ?>" id="theme" rel="stylesheet">
      <script src="<?= asset('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
<style type="text/css">
    .has_error{
        color: red;
        display: none;
    }
</style>
 <script type="text/javascript">
function  start_loader(){
    $('.preloader').show();
  }
 function stop_loader(){
    $('.preloader').hide();
  }
</script>
</head>

<body>
    
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

 
          
  @yield('content')                                        
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
    <script src="<?= asset('public/assets/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= asset('public/js/custom.min.js') ?>"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= asset('public/assets/plugins/styleswitcher/jQuery.style.switcher.js') ?>"></script>
</body>


 </html>