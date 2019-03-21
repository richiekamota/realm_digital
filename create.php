<?php

include_once("database.php");
 
if(isset($_POST['submit'])) {    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
        
    if(empty($firstname) ||empty($lastname) || empty($phone) || empty($email)) {                
         if(empty($firstname)) {
            echo "<font color='red'>First name field is empty.</font><br/>";
        }

        if(empty($lastname)) {
            echo "<font color='red'>Last name field is empty.</font><br/>";
        }
        
        if(empty($phone)) {
            echo "<font color='red'>Phone field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }        
        
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
       
        $result = mysqli_query($connection, "INSERT INTO contacts(firstname,lastname,phone,email) VALUES('$firstname','$lastname','$phone','$email')");
        
      
        echo "<font color='green'>Data added successfully.";
    }
} 

?>

<!DOCTYPE html>
<html>
	<head>
      <meta charset="utf-8"> 
      <meta name="viewport" content="width=device-width, initial-scale=1">     
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href='https://fonts.google.com/specimen/Montserrat' rel='stylesheet' type='text/css'>
      <link href='https://fonts.google.com/specimen/Roboto' rel='stylesheet' type='text/css'>
    </head>

<body>

             <a href="index.php" class="btn btn-outline-primary">Home</a>
    <br/><br/>

    <div class="container justify-content-center d-flex">
                            
        <div class="justify-content-center align-items-center d-flex">

            <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
                <input type="hidden" name="create" value="create" />				

                <div class="form-group row mt-4">
                    <div class="col-md-12">
                        <input class="form-control" type="text" name="firstname" required="" placeholder="First Name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-md-12">
                        <input class="form-control" type="text" name="lastname" required="" placeholder="Last Name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <input class="form-control" name="phone" type="text" required="" placeholder="Phone Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <input class="form-control" name="email" type="email" required="" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row text-center mt-4">
                    <div class="col-md-12">
                        <button class="btn btn-info" name="submit" type="submit">Create User</button>
                    </div>
                </div>
            </form>
        </div>    
    </div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

    
   
