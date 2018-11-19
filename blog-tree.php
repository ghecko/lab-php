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
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Titre</th>";
                    echo "<th>Contenu</th>";
                    echo "<th>Auteur</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    $rows = array();
                    while($row = $blog_post->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['postID'] . "</th>";
                        echo "<th>" . $row['postTitle'] . "</th>";
                        echo "<th>" . strip_tags($row['postDesc']) . "</th>";
                        echo "<th>" . $row['auteur'] . "</th>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                } else {
                    $sql = "SELECT postID, postTitle, auteur, postCont  FROM blog_posts";
                    if (!$blog_posts = $mysqli->query($sql)) {
                        echo "Sorry, the website is experiencing problems.";
                        exit;
                    }
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Titre</th>";
                    echo "<th>Auteur</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    $rows = array();
                    while($row = $blog_posts->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<th><a href='/?page=blog-tree&?id=".$row['postID']."'>".$row['postID']."</a></th>";
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