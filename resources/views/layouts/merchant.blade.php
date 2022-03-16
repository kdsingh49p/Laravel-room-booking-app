<?php 
use Illuminate\Support\Facades\Route;

 ?>
 <!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head> 
    <meta charset="utf-8" />
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset ('admin-assets/css/icons/icomoon/styles.css')}}">
    <link rel="stylesheet" href="{{asset ('admin-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset ('admin-assets/css/core.css')}}">
    <link rel="stylesheet" href="{{asset ('admin-assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset ('admin-assets/css/colors.css')}}">
    <link rel="stylesheet" href="{{asset ('admin-assets/js/core/libraries/jquery-ui.css')}}">
<script type="text/javascript" src="{{asset ('admin-assets/js/core/libraries/jquery_min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/js/datatables/datatables.min.css') }}"/>
 
<script type="text/javascript" src="{{ asset('admin-assets/js/datatables/datatables.min.js')}}"></script>
 <script src="{{asset ('admin-assets/js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset ('admin-assets/js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script src="{{asset ('admin-assets/js/sweetalert.js')}}"></script>


 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/3b6q4e9yvbey5w8zt5fd2x8t4bybkcchbnajz6f1dqjssxyt/tinymce/5/tinymce.min.js"></script>
  <script>
   
    tinymce.init(
    {
        selector:'.textarea',
        visual_table_class: 'my-custom-class',
   font_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',
    menubar: 'file edit insert view format table tools help',
    // height : "200px"
}

    );</script>

<style type="text/css">
.error{
    color:red;
}
</style>
    <style>
        .custom_color{
            color:black !important;
            padding-left: 35px;
        }

</style>
<style type="text/css">
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before{
    margin: 8px;
    /*width: 20px;*/

}
.edit_action_icon, .delete_action_icon{
    font-size:18px;
    margin-left:5px;
    
}
 
.astrik{
    color:red;
    font-size: 13px;
}


#loader_c {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}

@-webkit-keyframes spin {
    from {-webkit-transform:rotate(0deg);}
    to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
    from {transform:rotate(0deg);}
    to {transform:rotate(360deg);}
}

#loader_c::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
</style>

</head>
<body>

<div id="loader_c"></div>

         <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="">
                            
                            Merchant Panel
                        </a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">

    
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

                <li class="dropdown">

                                </li>
                    
            </ul>

            <p class="navbar-text"><span class="label bg-success">Online</span></p>


        </div>
    </div>

    <!-- /main navbar -->

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">
            <!-- Call left side nav bar code start -->
                       <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">
                            <div class="media">
                                <a href="#" class="media-left"><img src="assets/images/demo/users/face11.jpg" class="img-circle img-sm" alt=""></a>
                                <div class="media-body">
                                    <span class="media-heading text-semibold"><?= Auth::guard('merchant')->user()->name ?></span>
                                    <div class="text-size-mini text-muted">
                                        <i class="icon-pin text-size-small"></i> &nbsp; Merchant </div>
                                </div>

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li>
                                            <a href="#"><i class="icon-cog3"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /user menu -->

                    <?php $route = Route::current()->uri;
                      ?>
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                                   <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                   <li  class="<?= ($route=='admin/site/index') ? "active" : "" ?>"><a href=""><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                <li>
                                    <a href="#"><i class="icon-pencil3"></i> <span>Masters</span></a>
                                    <ul>
            
                                        
 
                                        <li><a id="button1" href="{{url('/merchant/deals/create')}}">Deals Master</a></li>

  
                                        
                                           
                                        </li>
                                        
                                        
                                        
                                    </ul>
                                 </li>
                                 <li><a id="button1" href="{{url('/merchant/deals/redeemdeal')}}">Redeem Deal</a></li>
                                 <li><a id="button1" href="#">Reports</a>
                                            <ul>
                                                <li class="<?= ($route=='merchant/reports') ? "active" : "" ?>"><a href="{{url('/merchant/reports')}}">Deals List</a></li>
                                                <li class="<?= ($route=='merchant/salereport') ? "active" : "" ?>"><a href="{{url('/merchant/salereport')}}">Deal Sale</a></li>
                                                <li class="<?= ($route=='merchant/transaction-history') ? "active" : "" ?>"><a href="{{url('/merchant/transaction-history')}}">Transaction History</a></li>
                                            </ul>
                                        </li>
                                    <li> 
                                            <a href="{{ url('/logout') }}" class="dropdown-toggle first_menu" style="text-transform:uppercase;">LOGOUT </a>
                                        </li>
                              
                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
    <!-- /main sidebar -->
                        <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style='text-transform:uppercase;'>
                             
                      
                        </ul>

                        
                    </div>
                </div>
                <!-- /page header -->
                

                <!-- Content area -->
                <div class="content" >
                    <div id="content-custom">
                                            
                        
                        
    
                        <div class="row">
                        <div class="col-lg-12">
                        <!-- Latest posts -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                <h2 class="panel-title" style="font-weight:bold;"><?= $this->title  ?></h2>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- <div class="overlay_c">
                                                <img src="{{url('admin-assets/images/preloader.gif')}}" style="width:30px;" class="loader_c">
                                            </div> -->
                                         
                                    @include('common')
                                                @yield('content')                                        
                                        </div>

                                        
                                    </div>
                                </div>
    </div>
                            <!-- /latest posts -->

                        </div>
</div>

 
<div class="footer text-muted">
                                <p class="pull-right">DEALS</p>
                            </div>
  </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
<script type="text/javascript" src="{{asset ('admin-assets/js/plugins/loaders/pace.min.js')}}"></script>

<script type="text/javascript" src="{{asset ('admin-assets/js/core/libraries/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset ('admin-assets/js/core/libraries/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset ('admin-assets/js/core/app.js')}}"></script>

</body>
</html>
