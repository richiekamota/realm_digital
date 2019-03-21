<?php
 
include("database.php");
 
$id = $_GET['id'];
 
$result = mysqli_query($connection, "DELETE FROM contacts WHERE id=$id");
 
header("Location:index.php");
    
   
