<?php
//include config
require_once('includes/config.php');

//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Stellar blog</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="vendor/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vendor/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="vendor/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vendor/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="vendor/AdminLTE/dist/css/skins/_all-skins.min.css">

    <!-- jQuery 3 -->
    <script src="vendor/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="vendor/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="vendor/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="vendor/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="vendor/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="vendor/AdminLTE/dist/js/demo.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <?php

    //process login form if submitted
    if(isset($_POST['submit'])){

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if($user->login($username,$password)){

            //logged in return to index page
            header('Location: index.php');
            exit;


        } else {
            $message = '<p class="error">Wrong username or password</p>';
        }

    }//end if submit

    if(isset($message)){ echo $message; }
    ?>
    <div class="login-logo">
        <a href="/index.php"><b>Stellar</b>Blog</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="login.php" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Login">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="register.php" class="text-center">Inscription</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
