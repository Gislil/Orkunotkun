<?php
class Register
{
    public $errorMessages = array();

    public function __construct()
    {
        if (isset($_POST['register'])) {
            $this->register();
        }
    }

    private function register()
    {
        // Validate the user input
        $email = $_POST['email'];
        $passw = $_POST['password'];
        if (isempty($email)){
            $this->errorMessages[] = 'Tölvupóstfang vantar';
        } elseif (strlen($email) > 64) {
            $this->errorMessages[] = 'Tölvupóstfang má ekki vera lengra en 64 stafir';
        } elseif (!preg_match('/.*@.*\..*/', $email)) {
            $this->errorMessages[] = 'Tölvupóstfang virðist ekki vera gilt';
        } elseif (isempty($passw)) {
            $this->errorMessages[] = 'Lykilorð vantar';
        } elseif (strlen($passw) < 8) {
            $this->errorMessages[] = 'Lykilorð er of stutt';
        }

        // create the database connection
        $db;
        try {
            $db = new PDO('mysql:host=localhost;dbname=login;charset=utf8', 'orkuadmin', 'orkupass');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $this->errorMessages[] = 'Connection failed: ' . $e->getMessage();
        }

        // insert the userinfo into the database
        try {
            // TODO: Hash the password for security
            $stm = $db->prepare("INSERT INTO orku_users
                                 (user_email, user_password_hash)
                                 VALUES (:email, :password)");
            $stm->bindParam(':email', $email, PDO::PARAM_STR);
            $stm->bindParam(':password', $passw, PDO::PARAM_STR);
            $stm->execute();
        } catch (PDOException $e) {
            $this->errorMessages[] = 'Registering user failed: ' . $e->getMessage();
        }

    }
}