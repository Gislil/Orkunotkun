<?php
require_once 'sql/db_login_info.php';
require_once 'classes/Register.php';
$register = new Register();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orkunotkun</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="content">
        <header>
            <h1 class='title'>Orkunotkun</h1>
        </header>
        <?php
            // if the user is not logged in we show the log in form
            require 'views/registerform.php';
        ?>
    </div>
</body>
</html>