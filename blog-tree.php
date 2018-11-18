<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Stellar blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/vendor/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/vendor/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/vendor/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/vendor/AdminLTE/dist/css/skins/_all-skins.min.css">

    <!-- jQuery 3 -->
    <script src="/vendor/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/vendor/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="/vendor/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/vendor/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="/vendor/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/vendor/AdminLTE/dist/js/demo.js"></script>
    <!-- page script -->
</head>
<body>

<div id="wrapper">

    <h1>Blog tree</h1>
    <hr />

    <div class="box-body">
        <table class="table table-striped table-bordered">
    <?php
    //if post does not exists redirect user.
    $mysqli = new mysqli('localhost', 'stellar', 'w7S-XvwqeYAUAE!oV3fS', 'stellar');
    if ($mysqli->connect_errno) {
        echo "ERREUR: Impossible d'établir une connexion avec la base de données";
    }
    if(isset($_GET['id'])){
        $sql = "SELECT postID, postTitle, auteur  FROM blog_posts WHERE postID = ".$_GET['id'];
        if (!$blog_post = $mysqli->query($sql)) {
            echo "Sorry, the website is experiencing problems.";
            exit;
        }
        $blog_post = $blog_post->fetch_assoc();
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Auteur</th>";
        echo "<th>Titre</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tr>";
        echo "<h1>".$blog_post['postID']."</h1> par <i>".$blog_post['auteur']."</i><br/>";
        echo "<p>".$blog_post['postTitle']."</p>";
        echo "</tr>";
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
        echo "<th>Auteur</th>";
        echo "<th>Titre</th>";
        echo "</tr>";
        echo "</thead>";
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<th>".$row['postID']."</th>";
            echo "<th>".$row['auteur']."</th>";
            echo "<th>".$row['postTitle']."</th>";
            echo "</tr>";
        }
        //echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
    }
    echo "</table>";
    echo "</div>";
    ?>

    </div>

</body>
</html>