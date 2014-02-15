<?php
    if (isset($registerObject)) {
        foreach ($registerObject->errorMessages as $error) {
            echo $error;
        }
    }
?>

<form action="register.php" method="post" name="registerform">

    <label for="email">Tölvupóstfang</label>
    <input type="email" name="email" id="email">

    <label for="password">Lykilorð (minnst 8 stafir)</label>
    <input type="password" name="password">

    <input type="submit" name="register">
    
</form>
