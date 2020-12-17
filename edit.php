<?php

include_once("database.php");

 
if(isset($_POST['submit']))
{    

    $id = $_POST['id'];
    $firstname = $_POST['name']['firstname'];
    $lastname = $_POST['name']['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $phone0 = $phone[0];
    $phone1 = $phone[1];
    $phone2 = $phone[2];
    $email0 = $email[0];
    $email1 = $email[1];
    $email2 = $email[2];
    $pid = [];
    $eid = [];
    $tmpArray = [];

    echo $id;
      
    $ppIdQuery = mysqli_query($connection, "SELECT id FROM phone WHERE contacts_id = $id");
        
    while($pidres = mysqli_fetch_array($ppIdQuery)) {                   
            $key = $pidres[0]; 
            $pid[] = $key;         
    }

    $epIdQuery = mysqli_query($connection, "SELECT id FROM email WHERE contacts_id = $id");
    
    while($eidres = mysqli_fetch_array($epIdQuery)) {                   
            $key = $eidres[0]; 
            $eid[] = $key;         
    }     
    
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
        
        $sql1 = mysqli_query($connection, "UPDATE contacts SET firstname='$firstname',lastname='$lastname' WHERE id= '$id';");        

            if (!mysqli_query($connection, $sql1)) {
               echo "Error: " . $sql1 . ":" . mysqli_error($connection).'<br/>';           
            }

            $ppIdQuery = mysqli_query($connection, "SELECT id FROM phone WHERE contacts_id = $id");
        
            while($pidres = mysqli_fetch_array($ppIdQuery)) {                   
                    $pkey = $pidres[0]; 
                    $pid[] = $pkey;         
            }
        
            $epIdQuery = mysqli_query($connection, "SELECT id FROM email WHERE contacts_id = $id");
            
            while($eidres = mysqli_fetch_array($epIdQuery)) {                   
                    $ekey = $eidres[0]; 
                    $eid[] = $ekey;         
            }     

        $sqlp = mysqli_query($connection, "UPDATE phone as p
        SET phone ='$phone0' WHERE p.id = '$pid[0]' AND p.contacts_id='$id';");        
        
        $sqlp .= mysqli_query($connection, "UPDATE phone as p
        SET phone ='$phone1' WHERE p.id = '$pid[1]' AND p.contacts_id='$id';");        

        $sqlp .= mysqli_query($connection, "UPDATE phone as p
        SET phone ='$phone2' WHERE p.id = '$pid[2]' AND p.contacts_id='$id';");                                
        
        if (!mysqli_multi_query($connection, $sqlp)) {
            echo "Error: " . $sqlp . ":" . mysqli_error($connection).'<br/>'; 
        }

        $sqle = mysqli_query($connection, "UPDATE email as e
        SET email ='$email0' WHERE e.id = '$eid[0]' AND e.contacts_id='$id';");

        $sqle .= mysqli_query($connection, "UPDATE email as e
        SET email ='$email1' WHERE e.id = '$eid[1]' AND e.contacts_id='$id';");

        $sqle .= mysqli_query($connection, "UPDATE email as e
        SET email ='$email2' WHERE e.id = '$eid[2]' AND e.contacts_id='$id';");

        if (!mysqli_multi_query($connection, $sqle)) {
            echo "Error: " . $sqle . ":" . mysqli_error($connection).'<br/>'; 
        }  
        
            
        header("Location: index.php?edit_id=$id");
    }
    mysqli_close($connection); 

}
?>
<?php

if(isset($_GET['id']) && !empty(trim($_GET["id"]))){
        
 $id =  trim($_GET['id']);

 $result = mysqli_query($connection, "SELECT c.id, c.firstname, c.lastname, GROUP_CONCAT(DISTINCT p.phone ORDER BY p.phone DESC SEPARATOR '<br/>') as phone, GROUP_CONCAT(DISTINCT e.email ORDER BY e.email DESC SEPARATOR '<br/>') as email FROM contacts AS c
    LEFT OUTER JOIN phone AS p ON p.contacts_id = c.id 
    LEFT OUTER JOIN email AS e ON e.contacts_id = c.id                                              
    WHERE c.id=$id GROUP BY c.id ASC");
        
}  
                      
?>

<!DOCTYPE html>
<html>
	<head>
      <meta charset="utf-8"> 
        <style>
            .editform-div {
                display:block;
                text-align:center;
            }

            .label {
                font-size:18px;
            }

            input[type=text] {
                border: 1px solid black;
                border-radius: 4px;
                padding-left:20px; 
                font-size:18px;        
                line-height: 2;
                margin-bottom: 10px;
            }

            input[type=email] {
                border: 1px solid black;
                border-radius: 4px;
                padding-left:20px;
                font-size:18px;
                line-height: 2;
                margin-bottom: 10px;
            }

            input:focus,input:hover { 
                outline: none !important;
                border-color: #719ECE;
                box-shadow: 0 0 10px #719ECE;
            }

            table.center {
                margin-left:auto;
                margin-right:auto;
            }

            .createuser-button:hover {
               background-color: #008CBA;
               color: white;
            }

            .createuser-button {
                transition-duration: 0.4s;
                background: #0d98ba;
                border: 1px solid #0d98bb;
                border-radius: 4px;
                color:white;
                font-size: 16px;
                line-height: 2;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <a href="index.php" class="">Home</a><br/><br/>
	    <div>	                            
	        <div class="editform-div">
            <h1>Edit Contact</h1>
                <form class="form-home" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>				

                    <table class="center">
                    
                        <?php while($res = mysqli_fetch_array($result)) {?>                    
                            <tr>
                                <td class="label" align="right">First Name:</td>
                                <td align="left"><input type="text" name="name[firstname]" size="30" value="<?php echo $res['firstname']; ?>"> </td>
                            </tr>
                            <tr>
                                <td class="label" align="right">Last Name:</td>
                                <td align="left"><input type="text" name="name[lastname]" size="30" value="<?php echo $res['lastname']; ?>"></td>
                            </tr>                
                            <?php $phone = explode('<br/>',$res['phone']);?>                                                  
                                <tr>
                                    <td class="label" align="right">Phone 1:</td>
                                    <td align="left"><input name="phone[0]" type="text" size="30" value="<?php echo $phone[0];?>"></td>
                                </tr>  
                                <tr>
                                    <td class="label" align="right">Phone 2:</td>
                                    <td align="left"><input name="phone[1]" type="text" size="30" value="<?php echo $phone[1];?>"></td>
                                </tr>            
                                <tr>
                                    <td class="label" align="right">Phone 3:</td>
                                    <td align="left"><input name="phone[2]" type="text" size="30" value="<?php echo $phone[2];?>"></td>
                                </tr>   

                                <?php $email = explode('<br/>',$res['email']);?>               
                            
                                <tr>
                                    <td class="label" align="right">Email 1:</td>
                                    <td align="left"><input name="email[0]" type="email" size="30" value="<?php echo $email[0]; ?>"></td>
                                </tr> 
                                <tr>
                                    <td class="label" align="right">Email 2:</td>
                                    <td align="left"><input name="email[1]" type="email" size="30" value="<?php echo $email[1];  ?>"></td>
                                </tr>
                                <tr>
                                    <td class="label" align="right">Email 3:</td>
                                    <td align="left"><input name="email[2]" type="email" size="30" value="<?php echo $email[2];  ?>"></td>
                                </tr> 
                           
                        <?php }?>   
                                          
                        <tr>                        
                            <td align="right"></td>
                            <td align="left"><button class="createuser-button" name="submit" type="submit">Edit Contact</button></td>                   
                        </tr>                           
                    </table>                 
                </form>
	        </div>    
        </div>
	 
	    <script type="text/javascript"></script>
	    
    </body>
</html>

    
   

    
   
