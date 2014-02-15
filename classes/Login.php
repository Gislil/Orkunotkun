<?php
class Login
{
    public $errorMessages = array();

    public function __construct()
    {
        session_start();

        if (isset($_GET['logout'])) {
            $this->logOutUser();
        } elseif (isset($_POST['login'])) {
            $this->logInUser();
        }
    }

    private function logInUser()
    {
        // Check that email and password was submitted
        $email = $_POST['email'];
        $passw = $_POST['password'];

        if (empty($email)) {
            $this->errorMessages[] = 'Tölvupóstfang vantar.';
        } elseif (empty($passw)) {
            $this->errorMessages[] = 'Lykilorð vantar.';
        } else {

            // create the database connection
            $db;
            try {
                $db = new PDO('mysql:host=localhost;dbname=login;charset=utf8', 'orkuadmin', 'orkupass');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                $this->errorMessages[] = 'Connection failed: ' . $e->getMessage();
            }

            $stm = $db->prepare("SELECT user_email, user_password_hash
                                 FROM login.orku_users
                                 WHERE user_email = :email");
            $stm->bindParam(':email', $email, PDO::PARAM_STR);
            $stm->execute();

            // check if the user is registered
            if ($stm->rowCount() == 1) {
                $resultRow = $stm->fetch();
                // check if the password is correct
                // TODO: hash password and check against hashed password
                if ($passw == $resultRow['user_password_hash']) {
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_logged_in'] = 1;
                } else {
                    $this->errorMessages[] = 'Lykilorð ekki rétt, reyndu aftur.';
                }
            } else {
                $this->errorMessages[] = 'Póstfangið ' . $email . 'fannst ekki á skrá';   
            }
        }
    }

    private function logOutUser()
    {
        session_unset();
        session_destroy();
        echo "user logged out\n";
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_logged_in']) AND $_SESSION['user_logged_in'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}