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
                        <li class="active"><a href="/index.php?page=blog">Blog</a></li>
                        <li><a href="/blog-tree.php">Vue d'ensemble</a></li>
                </div>
                <!-- /.navbar-collapse -->
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