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
                            <li><a href="/index.php">Blog</a></li>
                            <li class="active"><a href="/blog-tree.php">Vue d'ensemble</a></li>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Vue d'ensemble</h1>
                </section>
                <section class="content">
                    <div class="box box-default">
                        <div class="table-responsive" style="overflow: auto">
                            <table class="table table-bordered">
                                <?php
                                //if post does not exists redirect user.
                                $mysqli = new mysqli('localhost', 'stellar', 'w7S-XvwqeYAUAE!oV3fS', 'stellar');
                                if ($mysqli->connect_errno) {
                                    echo "ERREUR: Impossible d'établir une connexion avec la base de données";
                                }
                                if(isset($_GET['id'])){
                                    $sql = "SELECT postID, postTitle, auteur, postDesc  FROM blog_posts WHERE postID = ".$_GET['id'];
                                    if (!$blog_post = $mysqli->query($sql)) {
                                        echo "Sorry, the website is experiencing problems.";
                                        exit;
                                    }
                                    $blog_post = $blog_post->fetch_assoc();
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>ID</th>";
                                    echo "<th>Titre</th>";
                                    echo "<th>Contenu</th>";
                                    echo "<th>Auteur</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    echo "<tr>";
                                    echo "<th>".$blog_post['postID']."</th>";
                                    echo "<th>".$blog_post['postTitle']."</th>";
                                    echo "<th>".strip_tags($blog_post['postDesc'])."</th>";
                                    echo "<th>".$blog_post['auteur']."</th>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                } else {
                                    $sql = "SELECT postID, postTitle, auteur, postCont  FROM blog_posts";
                                    if (!$blog_posts = $mysqli->query($sql)) {
                                        echo "Sorry, the website is experiencing problems.";
                                        exit;
                                    }
                                    $rows = array();
                                    while($row = $blog_posts->fetch_assoc()) {
                                        $rows[] = $row;
                                    }
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>ID</th>";
                                    echo "<th>Titre</th>";
                                    echo "<th>Auteur</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<th>".$row['postID']."</th>";
                                        echo "<th>".$row['postTitle']."</th>";
                                        echo "<th>".$row['auteur']."</th>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    //echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>