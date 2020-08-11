<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>Aalap</title>
    <link rel="icon" href="<?php echo base_url();?>assets/images/Aalap-Final-logo.png" type="image/png" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url();?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.min.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/build/css/style.css" rel="stylesheet">
  </head>

  <body class="login">
  
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form text-center">
          <img src="<?php echo base_url()?>assets/images/Aalap-Final-logo.png" width="100" >
          <section class="login_content">
            <div class="text-center"> 
             <div id="error_text" class="alert" style="color: red;"><?php echo $this->session->flashdata('error_status'); ?></div>
            </div>

            <form action='<?php echo base_url().'AdminController/auth_login'; ?>' method='post' name='process'>

              <h1>Login</h1>
              <div>
                <input type="text" class="form-control" name="email" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="pwd" placeholder="Password" required="" />
              </div>
               
              <div>
                <a href='<?php echo base_url().'AdminController/user'; ?>'><input type="submit"  value="Log in" /></a>
                <a href="">Forgot password?</a>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="" aria-hidden="true"></i>Aalap</h1>
                  <p>©2018 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
       </div>
    </div>
  </body>
</html>