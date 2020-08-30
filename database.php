<?php
$localhost = 'localhost';
$user = 'contactsuser';
$password = 'tapiwa';
$database = 'contactsApp';
 
$connection = mysqli_connect($localhost, $user, $password, $database); 

if (mysqli_connect_errno()){
   echo "Cannot connect!".mysqli_connect_error();
}

    
   
