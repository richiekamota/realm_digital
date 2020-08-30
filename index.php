<?php

include_once("database.php");

$edit_id = $_GET['edit_id'] ?? '';
$id = $_GET['last_id'] ?? '';
$query = trim($_GET['query']) ?? '';

if(!empty($query)){ 

  $mainQuery = mysqli_query($connection, "SELECT c.id, c.firstname, c.lastname, GROUP_CONCAT(DISTINCT p.phone ORDER BY p.phone DESC SEPARATOR '<br/>') as phone, GROUP_CONCAT(DISTINCT e.email ORDER BY e.email DESC SEPARATOR '<br/>') as email FROM contacts AS c
    LEFT OUTER JOIN phone AS p ON p.contacts_id = c.id 
    LEFT OUTER JOIN email AS e ON e.contacts_id = c.id                                              
    WHERE (`firstname` LIKE '%$query%') OR (`lastname` LIKE '%$query%') OR (`phone` LIKE '%$query%') OR (`email` LIKE '%$query%') GROUP BY c.id DESC");
  
  $result = $mainQuery;

} else if(!empty($id)){

  $insertsql = mysqli_query($connection, "SELECT c.id, c.firstname, c.lastname, GROUP_CONCAT(DISTINCT p.phone ORDER BY p.phone DESC SEPARATOR '<br/>') as phone, GROUP_CONCAT(DISTINCT e.email ORDER BY e.email DESC SEPARATOR '<br/>') as email FROM contacts AS c
  LEFT OUTER JOIN phone AS p ON p.contacts_id = c.id 
  LEFT OUTER JOIN email AS e ON e.contacts_id = c.id                                              
  WHERE c.id=$id");  
  $result = $insertsql;

} else if(!empty($edit_id)){

  $editsql = mysqli_query($connection, "SELECT c.id, c.firstname, c.lastname, GROUP_CONCAT(DISTINCT p.phone ORDER BY p.phone DESC SEPARATOR '<br/>') as phone, GROUP_CONCAT(DISTINCT e.email ORDER BY e.email DESC SEPARATOR '<br/>') as email FROM contacts AS c
  LEFT OUTER JOIN phone AS p ON p.contacts_id = c.id 
  LEFT OUTER JOIN email AS e ON e.contacts_id = c.id                                              
  WHERE c.id=$edit_id");  
  $result = $editsql;

} else {
  $query = '';
  $id = '';
}  

  $new = [];  

  while($res = mysqli_fetch_array($result))
  {
    $key = $res['id'];    
   
    $new[$key] = $res;
  }         
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <style>
        .indexform-div{
          display:block;
          text-align:center;
          margin-bottom: 20px;
        }

        table.centre {
          margin: auto;
          border: 1px solid black;
          width:70%;
          font-family: arial, sans-serif;
          border-collapse: collapse;
        }

        table, th, td {
          border: 1px solid #dddddd;
          text-align: center;
          padding: 8px;
        }

        tr:nth-child(even) {
         background-color: #f2f2f2;
        }

        .search-button {
          background: #0d98ba;
          border-radius: 3px;
          border: 1px solid #0d98bb;
          color:white;
          font-size: 16px;
          line-height: 2;          
          width: 70px;
        }

        .search-button:hover {
          background-color: #008CBA;
          color: white;
        }                

        .createuser-button {
          transition-duration: 0.4s;
          background: #0d98ba;
          border-radius: 3px;
          border: 1px solid #0d98bb;
          color:white;
          font-size: 16px;
          line-height: 2;
          margin-bottom: 20px;
        }

        .createuser-button:hover {
          background-color: #008CBA;
          color: white;
        }   

        .search{
          line-height:2;
        }

        input[type=text] {
          border: 1px solid grey;
          -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
          -moz-box-sizing: border-box;    /* Firefox, other Gecko */
          box-sizing: border-box;         /* Opera/IE 8+ */
          border-radius: 4px;  
          padding-left:20px; 
          font-size: 16px;        
          line-height: 2;
          margin-bottom: 10px;
        }

        input:focus, input:focus { 
         outline: none !important;
         border-color: #719ECE;
         box-shadow: 0 0 10px #719ECE;
        }
      </style>
    </head>

  <body>

  <div class="container">
    
    <div class="indexform-div">

      <div style="margin: 50px" class=""><h1><strong>Contacts</strong></h1></div>

      <p><a href="create.php"><button type="button" class="createuser-button">Create Contact</button></a></p>

      <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
        <input type="hidden" name="search" value="search" />        

        <div class="">
          <div>
            <input class="search" type="text" name="query" placeholder="Search" autocomplete="off" size="30" >
            <button class="search-button" name="submit" type="submit">Go</button>
          </div>
        </div>
      </form>  
    </div> 
    <div class="table-div">   
      <table class="centre">
        <thead>
          <tr>
          <th>
                ID
            </th>
            <th>
                First Name
            </th>
            <th>
                Last Name
            </th>
            <th>
                Phone
            </th>
            <th>
                Email
            </th>
            <th>
              Edit
            </th>
          </tr>
        </thead>
        <tbody>
          <?php

            if(!empty($result)) {
              echo "<tr>";
              foreach($new as $key => $record){
                            
                echo "<td>".$key."</td>";
                echo "<td>".$record['firstname']."</td>";
                echo "<td>".$record['lastname']."</td>"; 
                echo "<td>".$record['phone']."</td>";           
                echo "<td>".$record['email']. "</td>";
                echo '<td><a class="btn" href="edit.php?id='.$key.'">Edit</a>';
                echo ' | ';
                echo '<a class="btn" href="delete.php?id='.$key.'">Delete</a>';
                echo "</td>";
                echo "</tr>";             
              }
            }else{
              echo "<tr><td colspan='6'>";
              echo "No search results!";
              echo "</td></tr>";
            }              
          ?>           
        </tbody>
      </table>
    </div>          
  </div>    
    <script type="text/javascript"></script> 
  </body>
</html>


    
   
