<?php

include_once("database.php");
 
if(isset($_POST['submit'])) {    
    $firstname = $_POST['name']['firstname'];
    $lastname = $_POST['name']['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $phone0 = $_POST['phone'][0];
    $phone1 = $_POST['phone'][1];
    $phone2 = $_POST['phone'][2];
    $email0 = $_POST['email'][0];
    $email1 = $_POST['email'][1];
    $email2 = $_POST['email'][2];

            
    if(empty($firstname) || empty($lastname) || ($email0 == NULL) && ($email1 == NULL) && ($email2 == NULL) || ($phone0 == NULL) && ($phone1 == NULL) && ($phone2 == NULL)) {                
         
        if(empty($firstname)) {
            echo "<font color='red'>First name field is empty.</font><br/>";
        }

        if(empty($lastname)) {

            echo "<font color='red'>Last name field is empty.</font><br/>";
        }
        
        if(($phone0 == NULL) && ($phone1 == NULL) && ($phone2 == NULL)) {

            echo "<font color='red'>Phone field is empty. Please fill out at least one phone field</font><br/>";
        }
        
        if(($email0 == NULL) && ($email1 == NULL) && ($email2 == NULL)) {

            echo "<font color='red'>Email field is empty. Please fill at least one email field</font><br/>";
        }        
        
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";

     } else { 
       
        //TODO: Find out about transcations and how could they be used to handle the below code clutter. Find out about the last_insert_id usage
        $sql1 = "INSERT INTO contacts(firstname,lastname) VALUES('$firstname','$lastname');";

        if (mysqli_query($connection,$sql1)) {
            
            $last_id = mysqli_insert_id($connection);

            echo "New record created successfully. Last inserted ID is: " . $last_id. "<br>";

        } else {

            echo "Error: " . $sql1 . "<br>" . mysqli_error($connection);
        }        
        
            $sql2 .= mysqli_query($connection, "INSERT INTO phone(contacts_id,phone) VALUES('$last_id','$phone0')");        
            $sql2 .= mysqli_query($connection, "INSERT INTO phone(contacts_id,phone) VALUES('$last_id','$phone1')");        
            $sql2 .= mysqli_query($connection, "INSERT INTO phone(contacts_id,phone) VALUES('$last_id','$phone2')");        
            $sql2 .= mysqli_query($connection, "INSERT INTO email(contacts_id,email) VALUES('$last_id','$email0')");         
            $sql2 .= mysqli_query($connection, "INSERT INTO email(contacts_id,email) VALUES('$last_id','$email1')");        
            $sql2 .= mysqli_query($connection, "INSERT INTO email(contacts_id,email) VALUES('$last_id','$email2')");
        

        if (mysqli_multi_query($connection, $sql)) {

            echo " Records for all the tables have been created successfully";

        } else {
        
            echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);    
        }
        
        header("Location: index.php?last_id=$last_id");
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
      <meta charset="utf-8">    
        <style>

            .createform-div{
                display:block;
                text-align:center;
            }

            input[type=text] {
                border: 1px solid grey;
                -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
                -moz-box-sizing: border-box;    /* Firefox, other Gecko */
                box-sizing: border-box;         /* Opera/IE 8+ */
                border-radius: 4px;
                padding-left: 20px;
                font-size:16px;
                line-height: 2;
                margin-bottom: 10px;
            }

            .label {
               font-size:18px;
            }

            input[type=email] {
                border: 1px solid grey;
                -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
                -moz-box-sizing: border-box;    /* Firefox, other Gecko */
                box-sizing: border-box;         /* Opera/IE 8+ */
                border-radius: 4px;
                padding-left: 20px;
                font-size:16px;
                padding-left: 20px;
                line-height: 2;
                margin-bottom: 10px;
            }
            
            input:focus, input:hover { 
                outline: none !important;
                border-color: #719ECE;
                box-shadow: 0 0 10px #719ECE;
            }


             .createuser-button:hover {
               background-color: #008CBA;
               color: white;
            }         

            .createuser-button{
                transition-duration: 0.4s;
                background: #0d98ba;
                border: 1px solid #0d98bb;
                border-radius: 4px;
                color:white;
                font-size:16px;
                line-height: 2;
                width: 100%;
            }

            table.center{
                margin-left:auto;
                margin-right:auto;
            }

        </style>
    </head>

    <body>
        <a href="index.php" class="">Home</a><br/><br/>

        <div class="container">
                                
            <div class="createform-div">

                <h1>Contact</h1>

                <form class="form-create" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
                    <input type="hidden" name="create" value="create" />

                    <table class="center">
                        <tr>
                        <td  class="label" align="right">First Name:</td>
                        <td align="left"><input type="text" name="name[firstname]" size="30"> </td>
                        </tr>
                        <tr>
                        <td  class="label" align="right">Last Name:</td>
                        <td align="left"><input type="text" name="name[lastname]" size="30"></td>
                        </tr>
                        <tr>
                        <td  class="label" align="right">Phone 1:</td>
                        <td align="left"><input name="phone[0]" type="text" size="30"></td>
                        </tr>
                        <tr>
                        <td  class="label" align="right">Phone 2:</td>
                        <td align="left"><input name="phone[1]" type="text" size="30"></td>
                        </tr>
                        <tr>
                        <td  class="label" align="right">Phone 3:</td>
                        <td align="left"><input name="phone[2]" type="text" size="30"></td>
                        </tr>
                        <tr>
                        <td  class="label" align="right">Email 1:</td>
                        <td align="left"><input name="email[0]" type="email" size="30"></td>
                        </tr>
                        <tr>
                        <td  class="label" align="right">Email 2:</td>
                        <td align="left"><input name="email[1]" type="email" size="30"> </td>
                        </tr>
                        <tr>                    
                        <td  class="label" align="right">Email 3:</td>
                        <td align="left"><input name="email[2]" type="email" size="30"></td>
                        </tr>
                        <tr>   
                        <td align="right"></td>
                        <td align="left"><button class="createuser-button" name="submit" type="submit">Create Contact</button></td>                   
                        </tr>
                    </table>                                
                </form>
            </div>    
        </div> 
        
        <script type="text/javscript"></script>    
    </body>
</html>

    
   
