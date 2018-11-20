<?php require('includes/config.php'); ?>
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
<body class="hold-transition register-page">
<div class="register-box">
    <?php

    //process login form if submitted
    if(isset($_POST['submit'])){

        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if($email == ''){
            $error[] = 'Please enter the email address.';
        }
        if($username == ''){
            $error[] = 'Please enter the email address.';
        }
        if($password == ''){
            $error[] = 'Please enter the email address.';
        }

        if(!isset($error)) {
            try {
                //check if username or password exist in database
                $stmt_username = $db->prepare('select username from users where UPPER(username) = :username');
                $stmt_email = $db->prepare('select email from users where UPPER(email) = :email');
                $stmt_username->execute(array(
                    ':username' => strtoupper($username)
                ));
                $stmt_email->execute(array(
                        ':email' => strtoupper($email)
                ));
                $res_username = $stmt_username->fetchAll();
                $res_email = $stmt_email->fetchAll();
                if(count($res_username) == 0) {
                    if(count($res_email) == 0) {
                        //insert into database
                        $stmt = $db->prepare('INSERT INTO users (username,password,email) VALUES (:username, :password, :email)');
                        $stmt->execute(array(
                            ':username' => $username,
                            ':password' => $password,
                            ':email' => $email
                        ));

                        //redirect to index page
                        header('Location: index.php');
                        exit;
                    } else {
                        $error[] = 'Email déjà enregistré';
                    }
                } else {
                    $error[] = 'Username non disponible';
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }
        //check for any errors
        if(isset($error)) {
            foreach($error as $err){
                echo '<p class="error">'.$err.'</p>';
            }
        }

    }//end if submit

    if(isset($message)){ echo $message; }
    ?>
    <div class="register-logo">
        <a href="/index.php"><b>Stellar</b>Blog</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Inscription</p>

        <form action="register.php" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="register">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="login.php" class="text-center">J'ai déjà un compte</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

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
