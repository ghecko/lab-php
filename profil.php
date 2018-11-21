<?php //include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<section class="content-header">
    <h1>Profile</h1>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-body">
            <?php

            //if form has been submitted process it
            if(isset($_POST['submit'])){

                //collect form data
                extract($_POST);

                //very basic validation
                if($username ==''){
                    $error[] = 'Please enter the username.';
                }

                if( strlen($password) > 0){

                    if($password ==''){
                        $error[] = 'Please enter the password.';
                    }

                    if($passwordConfirm ==''){
                        $error[] = 'Please confirm the password.';
                    }

                    if($password != $passwordConfirm){
                        $error[] = 'Passwords do not match.';
                    }

                }


                if($email ==''){
                    $error[] = 'Please enter the email address.';
                }

                if(!isset($error)){

                    try {

                        if(isset($_FILES["profilePicture"])) {
                            $errors= array();
                            $file_name = $_FILES['image']['name'];
                            $file_size = $_FILES['image']['size'];
                            $file_tmp = $_FILES['image']['tmp_name'];
                            $file_type = $_FILES['image']['type'];
                            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                            print($file_ext);
                            print(strtolower(explode('.',$file_name)));

                            /*$expensions= array("jpeg","jpg","png");

                            if(in_array($file_ext,$expensions)=== false){
                                $error[] = "extension not allowed, please choose a JPEG or PNG file.";
                            }

                            if($file_size > 2097152) {
                                $error[] = 'File size must be excately 2 MB';
                            }

                            if(empty($error)==true) {
                                move_uploaded_file($file_tmp,"images/".$file_name);
                                echo "Success";
                            }*/
                        }

                        if(isset($password)){

                            //update into database
                            $stmt = $db->prepare('UPDATE users SET username = :username, password = :password, email = :email WHERE user_id = :user_id') ;
                            $stmt->execute(array(
                                ':username' => $username,
                                ':password' => $password,
                                ':email' => $email,
                                ':user_id' => $user_id
                            ));


                        } else {

                            //update database
                            $stmt = $db->prepare('UPDATE users SET username = :username, email = :email WHERE user_id = :user_id') ;
                            $stmt->execute(array(
                                ':username' => $username,
                                ':email' => $email,
                                ':user_id' => $user_id,
                            ));

                        }


                        //redirect to index page
                        header('Location: index.php?page=profil');
                        exit;

                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }

                }

            }

            ?>


            <?php
            //check for any errors
            if(isset($error)){
                foreach($error as $error){
                    echo $error.'<br />';
                }
            }

            try {

                $stmt = $db->prepare('SELECT user_id, username, email, pictures FROM users WHERE user_id = :user_id') ;
                $stmt->execute(array(':user_id' => $_SESSION['user_id']));
                $row = $stmt->fetch();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            ?>
            <div class="register-box">
                <div class="register-box-body">
                    <p class="login-box-msg">Mon profil</p>

                    <form action="/index.php?page=profil" method="post" enctype = "multipart/form-data">
                        <div class="form-group has-feedback">
                            <img src="<?php echo $row['pictures'];?>" class="user-image" alt="User Image">
                            <span class="btn btn-default btn-file">
                                Changer <input type="file" name="profilePicture">
                            </span>
                        </div>
                        <input type='hidden' name='user_id' value='<?php echo $row['user_id'];?>'>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="username" value="<?php echo $row['username'];?>">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email" value="<?php echo $row['email'];?>">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Mot de passe" name="password" value="">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Confirmation mot de passe" name="passwordConfirm" value="">
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Update User">Update</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.form-box -->
            </div>
        </div>
    </div>
</section>