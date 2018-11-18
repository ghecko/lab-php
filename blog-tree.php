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
<body class="skin-blue layout-boxed">

<div id="content-wrapper">

    <h1>Blog tree</h1>
    <hr />

    <div class="col-md-6 text-center">
        <div class="table-responsive" style="overflow: auto">
            <table class="table table-bordered">
            <?php
            //if post does not exists redirect user.
            $mysqli = new mysqli('localhost', 'stellar', 'w7S-XvwqeYAUAE!oV3fS', 'stellar');
            if ($mysqli->connect_errno) {
                echo "ERREUR: Impossible d'établir une connexion avec la base de données";
            }
            if(isset($_GET['id'])){
                $sql = "SELECT postID, postTitle, auteur, postCont  FROM blog_posts WHERE postID = ".$_GET['id'];
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
                echo "<th>Contenu</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                echo "<tr>";
                echo "<th>".$blog_post['postID']."</th>";
                echo "<th>".$blog_post['postTitle']."</th>";
                echo "<th>".$blog_post['auteur']."</th>";
                echo "<th>".htmlspecialchars($blog_post['postCont'])."</th>";
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
                echo "<th>Auteur</th>";
                echo "<th>Titre</th>";
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
</div>

</body>
</html>