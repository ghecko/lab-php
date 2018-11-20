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