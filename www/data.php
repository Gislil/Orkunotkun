<?php //data.php
require_once 'login.php';

// Get values from form
$Fname		= $_POST['first_name'];
$Lname		= $_POST['last_name'];    
$sex		= $_POST['sex'];
$email		= $_POST['email'];
$password   = $_POST['password'];  

// Insert data into mysql
$sql="INSERT INTO users (first_name, last_name, sex, email, password, registration_date)
VALUES ('$Fname', '$Lname', '$sex', '$email', SHA1('$password'), NOW())";
$result = mysql_query($sql);

// if successfully insert data into database, displays message "Successful".
if($result){
header('COOL');
}
else {
echo "ERROR";
}

// close mysql
mysql_close();
?>