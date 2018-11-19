<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blog</h1>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-body">
            <?php
            try {

                $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
                while($row = $stmt->fetch()){

                    echo '<div class="panel box box-primary">';
                    echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
                    echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                    echo '<p>'.$row['postDesc'].'</p>';
                    echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
                    echo '</div>';

                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>
</section>