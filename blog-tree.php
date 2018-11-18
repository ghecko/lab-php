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

    <h1>Blog</h1>
    <hr />

    <?php
    //if post does not exists redirect user.
    if(isset($_GET['id'])){
        try {
            $blog_post = mysql_query("SELECT postID, postTitle, auteur  FROM blog_posts WHERE postID = ".$_GET['id']) or die(mysql_error());
            $blog_post = mysql_fetch_assoc($blog_posts);
            echo "<h1>".$blog_post['postID']."</h1> par <i>".$blog_post['auteur']."</i><br/>";
            echo "<p>".$blog_post['postTitle']."</p>";
        }
        catch (exception $e) {
            echo $e;
        }

    }
    else {
        echo "list of all blog post here";
        $blog_posts = mysql_query("SELECT postID, postTitle, auteur  FROM blog_posts") or die(mysql_error());
        $rows = array();
        while($row = mysql_fetch_array($blog_posts))
            $rows[] = $row;
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