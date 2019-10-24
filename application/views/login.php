<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url();?>assets/imgs/favicon.ico">  
  <title>Simpadu | V2</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_login.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>

    <div class="container">
        <div class="card card-container">

            <img id="profile-img" class="profile-img-card" src="<?php echo base_url()?>assets/imgs/logo_poliban.png" />
            <p id="profile-name" class="profile-name-card">SIMPADU POLIBAN</p>
            <p class="profile-error-card"><?php print_r($pesan);?></p>            
			<?php
			    echo validation_errors(); 
			    echo form_open('login',array('class' => 'form-signin')); 
			?>            	
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" 		name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
                <input type="password" 	name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/admin_lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
</body>
</html>
