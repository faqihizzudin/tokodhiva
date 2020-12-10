
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/images/favicon_1.ico">

        <title>Toko Pakan Ternak Dhiva</title>

        <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
            <div class="wrapper-page">
                <div class=" card-box">
                    <div class="panel-heading"> 
                        <h3 class="text-center"> Selamat Datang di <br><strong class="text-custom">Toko Pakan Ternak Dhiva</strong> </h3>
                    </div> 


                    <div class="panel-body">
                    <form class="form-horizontal" action="<?php echo base_url().'logincontroller/auth'?>" method="post">
                        
                        <div class="form-group ">
                            <div class="col-md-12">
                                <input class="form-control" id="username" name="username" type="text" required="" placeholder="Nama User">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-control" id="password" name="password" type="password" required="" placeholder="Kata Sandi">
                            </div>
                        </div>
                        
                        <div class="form-group text-center m-t-40">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">Masuk</button>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12" style="text-align: center; color: #E74C3C; font: bold;">
                            <?php echo $this->session->flashdata('msg'); ?>
                        </div>    
                    </div>

                </div>
            </div>
        
        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/wow.min.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.scrollTo.min.js"></script>


        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url(); ?>ubold-21/ubold/Admin/dark_leftbar/assets/js/jquery.app.js"></script>
	
	</body>
</html>