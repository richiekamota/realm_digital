<?php
$localhost = 'localhost';
$user = 'root';
$password = 'admin';
$database = 'contactsApp';
 
$connection = mysqli_connect($localhost, $user, $password, $database); 

if (mysqli_connect_errno()){
   echo "Cannot connect!".mysqli_connect_error();
}

    
   
