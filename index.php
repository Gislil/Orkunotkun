<?php
require_once 'classes/Login.php';

$login = new Login();
if ($login->isLoggedIn()) {
    echo "Logged in";
    echo '<a href=index.php?logout=1>log out</a>';
} else {
    require "views/loginform.php";
}