<?php
    if (isset($login) AND !empty($login->errorMessages)) {
        foreach ($login->errorMessages as $error) {
            echo $error;
        }
    }
?>

<form action="index.php" method="post" name="loginform">
    
    <label for="email">Tölvupóstfang</label>
    <input type="email" name="email" id="email_input">

    <label for="password">Lykilorð</label>
    <input type="password" name="password" id="password_input">

    <input type="submit" name="login">
</form>