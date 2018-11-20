<?php require('includes/config.php');

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
    header('Location: ./');
    exit;
}

?>
<section class="content-header">
    <h1>Blog</h1>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-body">
            <?php
                echo '<div class="box box-primary>">';
                    echo '<div class="box box-primary>">';
                        echo '<div class="box-header with-border">';
                            echo '<h3>'.$row['postTitle'].'</h3>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="box-body no-padding">';
                        echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                        echo $row['postCont'];
                    echo '</div>';
                echo '</div>';
            ?>
	    </div>
    </div>
</section>
</body>
</html>