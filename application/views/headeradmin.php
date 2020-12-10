
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/favicon_1.ico">

    <title>Toko Pakan Ternak Dhiva</title>

    <!-- DataTables --> 
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>


    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/responsive.css" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/modernizr.min.js"></script>

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><span>Menu</span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>


                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/users/profil.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li style="text-align: center;"><b><?php echo $this->session->userdata('nama'); ?>/<b></li>
                                        <li><a href="<?php echo base_url().'logincontroller/logout'?>"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <a href="index.html" class="logo"><span>Toko Pakan Ternak Dhiva</span></a>
                            <!-- Image Logo here -->
                            <!--<a href="index.html" class="logo">-->
                                <!--<i class="icon-c-logo"> <img src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/logo_sm.png" height="42"/> </i>-->
                                <!--<span><img src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/logo_light.png" height="20"/></span>-->
                            <!--</a>-->
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Menu</li>

                            <li class="has_sub">
                                <a href="<?php echo base_url('admin/welcome'); ?>" class="waves-effect"><i class="md-home"></i> <span> Beranda </span></a>
                            </li> 

                            <li class="has_sub">
                                <a href="<?php echo base_url('admin/pelanggancontroller'); ?>" class="waves-effect"><i class="ti-user"></i> <span> Pelanggan </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="<?php echo base_url('admin/transaksicontroller'); ?>"><i class="ti-shopping-cart"></i> <span> Transaksi </span></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">