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
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu-->
                <div class="navbar-custom-menu">
                    <?php
                        if($user->is_logged_in()) {
                            echo '<ul class="nav navbar-nav">';
                                echo '<li class="dropdown user-block-sm user-menu">';
                                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                                        echo "<img src='".$_SESSION['picture']."' class='user-image' alt='User Image'>";
                                        echo '<?php echo "<span class=\'hidden-xs\'>".$_SESSION[\'username\']."</span>"; ?>';
                                    echo '</a>';
                                    echo '<ul class="dropdown-menu">';
                                        echo '<li class="user-footer">';
                                            echo '<div class="btn-group" style="vertical-align: middle;">';
                                                echo '<a href="#" class="btn btn-info">Profile</a>';
                                                echo '<a href="/logout.php" class="btn btn-danger">Sign out</a>';
                                            echo '</div>';
                                        echo '</li>';
                                    echo '</ul>';
                                echo '</li>';
                            echo '</ul>';
                        } else {
                            echo '<ul class="nav navbar-nav">';
                                echo '<li class="dropdown user-block-sm user-menu">';
                                    echo '<a href="/login.php" class="btn btn-app">';
                                        echo '<i class="fas fa-sign-in-alt"></i> Login';
                                    echo '</a>';
                                echo '</li>';
                                echo '<li class="dropdown user-block-sm user-menu">';
                                    echo '<a href="/register.php" class="btn btn-app">';
                                        echo '<i class="fas fa-user-plus"></i> Login';
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
            <?php
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                if(isset($_GET['page'])) {
                    include($_GET['page'] . ".php");
                } else {
                    header('Location: index.php?page=blog');
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>