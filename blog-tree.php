<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

<div id="wrapper">

    <h1>Blog tree</h1>
    <hr />

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
        echo "<h1>".$blog_post['postID']."</h1> par <i>".$blog_post['auteur']."</i><br/>";
        echo "<p>".$blog_post['postTitle']."</p>";
    }
    else {
        $sql = "SELECT postID, postTitle, auteur  FROM blog_posts";
        if (!$blog_posts = $mysqli->query($sql)) {
            echo "Sorry, the website is experiencing problems.";
            exit;
        }
        $rows = $blog_posts->fetch_array($blog_posts);
        foreach($rows as $row){
            echo "<h1>".$row['postID']."</h1> par <i>".$row['auteur']."</i><br/>";
            echo "<p>".$row['postTitle']."</p>";
        }
        //echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
    }

    ?>

</div>


</body>
</html>