<?php

include('class.password.php');

class User extends Password{

    private $db;

	function __construct($db){
		parent::__construct();

		$this->_db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

	public function is_admin()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            try {
                $username = $_SESSION['username'];
                $stmt = $this->_db->prepare('SELECT admin FROM users WHERE username = :username');
                $stmt->execute(array('username' => $username));
				$admin = $stmt->fetch();
                if ($admin[0] === '1') {
                	return true;
				} else {
                	return false;
				}

            } catch (PDOException $e) {
                echo '<p class="error">' . $e->getMessage() . '</p>';
            }
        }
    }

	private function get_user_infos($username){

		try {

			$stmt = $this->_db->prepare('SELECT user_id, username, password, pictures FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}


	public function login($username,$password){

		$user = $this->get_user_infos($username);

		if($this->password_verify($password,$user['password']) == 1){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['user_id'] = $user['user_id'];
		    $_SESSION['username'] = $user['username'];
		    $_SESSION['picture'] = $user['pictures'];
		    return true;
		}
	}


	public function logout(){
		session_destroy();
	}

}


?>
