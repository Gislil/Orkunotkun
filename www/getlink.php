<?php
require_once 'login.php';

$link = $_GET['link'];

$sql = "INSERT INTO getlink (link, registration_date) VALUES ('$link', NOW())";

$result = mysql_query($sql);

// if successfully insert data into database, displays message "Successful".
if($result){
echo "COOL";
}
else {
echo "ERROR";
}

// close mysql
mysql_close();

?>