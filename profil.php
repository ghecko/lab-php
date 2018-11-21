<?php //include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
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
<body class="hold-transition skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="/index.php" class="navbar-brand"><b>Stellar</b>Blog</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/index.php?page=blog">Blog</a></li>
                        <li><a href="/index.php?page=blog-tree">Vue d'ensemble</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu-->
                <div class="navbar-custom-menu">
                    <?php
                    if($user->is_logged_in()) {
                        echo '<ul class="nav navbar-nav">';
                            if($user->is_admin()) {
                                echo '<li class="dropdown user-block-sm user-menu">';
                                    echo '<a href="/admin/index.php">';
                                        echo '<i class="fa fa-gears"></i> Admin';
                                    echo '</a>';
                                echo '</li>';
                            }
                            echo '<li class="dropdown user-block-sm user-menu">';
                                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                                    echo "<img src='".$_SESSION['picture']."' class='user-image' alt='User Image'>";
                                    echo "<span class='hidden-xs'>".$_SESSION['username']."</span>";
                                echo '</a>';
                                echo '<ul class="dropdown-menu">';
                                    echo '<li class="user-footer">';
                                        echo '<div class="btn-group" style="vertical-align: middle;">';
                                            echo '<a href="/profil.php" class="btn btn-info">Profile</a>';
                                            echo '<a href="/logout.php" class="btn btn-danger">Sign out</a>';
                                        echo '</div>';
                                    echo '</li>';
                                echo '</ul>';
                            echo '</li>';
                        echo '</ul>';
                    } else {
                        echo '<ul class="nav navbar-nav">';
                            echo '<li class="dropdown user-block-sm user-menu">';
                                echo '<a href="/login.php">';
                                    echo '<i class="fa fa-sign-in"></i> Login';
                                echo '</a>';
                            echo '</li>';
                            echo '<li class="dropdown user-block-sm user-menu">';
                                echo '<a href="/register.php">';
                                    echo '<i class="fa fa-user-plus"></i> Register';
                                echo '</a>';
                            echo '</li>';
                        echo '</ul>';
                    }
                    ?>
                </div>
                <!--/.navbar-custom-menu-->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1>Profile</h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <?php
                        //Check if status exist from previous post
                        if(isset($_SESSION['result_status'])) {
                            if($_SESSION['result_status'] == 'error') {
                                echo '<div class="alert alert-danger alert-dismissible">';
                                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                                    echo '<h4><i class="icon fa fa-ban"></i> Echec !</h4>';
                                    echo $_SESSION['result_msg'];
                                echo '</div>';
                            } else {
                                echo '<div class="alert alert-success alert-dismissible">';
                                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                                    echo '<h4><i class="icon fa fa-check"></i> Succès !</h4>';
                                    echo $_SESSION['result_msg'];
                                echo '</div>';
                            }
                            unset($_SESSION['result_status']);
                            unset($_SESSION['result_msg']);
                        }

                        //if form has been submitted process it
                        if(isset($_POST['submit'])){

                            //collect form data
                            extract($_POST);

                            //very basic validation
                            if($username ==''){
                                $error[] = 'Please enter the username.';
                            }

                            if( strlen($password) > 0){

                                if($password ==''){
                                    $error[] = 'Please enter the password.';
                                }

                                if($passwordConfirm ==''){
                                    $error[] = 'Please confirm the password.';
                                }

                                if($password != $passwordConfirm){
                                    $error[] = 'Passwords do not match.';
                                }

                            }


                            if($email ==''){
                                $error[] = 'Please enter the email address.';
                            }

                            if(!isset($error)){
                                try {
                                    //TODO : a optimiser (result code send)
                                    if(isset($_FILES['image']['name'])) {
                                        $_SESSION['result_status'] = 'error';
                                        $_SESSION['result_msg'] = 'pictures = '.$file_tmp;
                                        $file_name = $_FILES['image']['name'];
                                        $file_size = $_FILES['image']['size'];
                                        $file_tmp = $_FILES['image']['tmp_name'];
                                        $file_type = $_FILES['image']['type'];
                                        //move_uploaded_file($file_tmp, "images/$file_name");
                                        //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

                                        /*$expensions= array("jpeg","jpg","png");

                                        if(in_array($file_ext,$expensions)=== false){
                                            $error[] = "extension not allowed, please choose a JPEG or PNG file.";
                                        }

                                        if($file_size > 2097152) {
                                            $error[] = 'File size must be excately 2 MB';
                                        }

                                        if(empty($error)==true) {
                                            move_uploaded_file($file_tmp,"images/".$file_name);
                                            echo "Success";
                                            //$_SESSION['pictures'] =
                                        }*/
                                    }

                                    /*if(isset($password)){

                                        //update into database
                                        $stmt = $db->prepare('UPDATE users SET username = :username, password = :password, email = :email WHERE user_id = :user_id') ;
                                        $stmt->execute(array(
                                            ':username' => $username,
                                            ':password' => $password,
                                            ':email' => $email,
                                            ':user_id' => $user_id
                                        ));
                                        $_SESSION['username'] = $username;
                                        $_SESSION['result_msg'] = 'Donnée Mise à jour avec Succès';
                                        $_SESSION['result_status'] = 'success';


                                    } else {

                                        //update database
                                        $stmt = $db->prepare('UPDATE users SET username = :username, email = :email WHERE user_id = :user_id') ;
                                        $stmt->execute(array(
                                            ':username' => $username,
                                            ':email' => $email,
                                            ':user_id' => $user_id,
                                        ));
                                        $_SESSION['username'] = $username;
                                        $_SESSION['result_msg'] = 'Donnée Mise à jour avec Succès';
                                        $_SESSION['result_status'] = 'success';
                                    }*/


                                    //redirect to index page
                                    header('Location: profil.php');
                                    exit;

                                } catch(PDOException $e) {
                                    echo $e->getMessage();
                                }

                            }

                        }

                        ?>


                        <?php
                        //check for any errors
                        if(isset($error)){
                            foreach($error as $error){
                                echo '<div class="alert alert-danger alert-dismissible">';
                                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                                    echo '<h4><i class="icon fa fa-ban"></i> Echec !</h4>';
                                    echo $error;
                                echo '</div>';
                            }
                        }

                        try {

                            $stmt = $db->prepare('SELECT user_id, username, email, pictures FROM users WHERE user_id = :user_id') ;
                            $stmt->execute(array(':user_id' => $_SESSION['user_id']));
                            $row = $stmt->fetch();

                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }

                        ?>
                        <div class="register-box">
                            <div class="register-box-body">
                                <p class="login-box-msg">Mon profil</p>

                                <form action="/profil.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group has-feedback">
                                        <img src="<?php echo $row['pictures'];?>" class="user-image" alt="User Image">
                                        <span class="btn btn-default btn-file">
                                            Changer <input type="file" name="image">
                                        </span>
                                    </div>
                                    <input type='hidden' name='user_id' value='<?php echo $row['user_id'];?>'>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" placeholder="username" name="username" value="<?php echo $row['username'];?>">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $row['email'];?>">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Mot de passe" name="password" value="">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Confirmation mot de passe" name="passwordConfirm" value="">
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Update User">Update</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.form-box -->
                        </div>
                    </div>
                </div>
            </section>