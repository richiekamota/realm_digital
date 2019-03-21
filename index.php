<?php

include_once("database.php");

if(isset($_GET['query'])){
        
$query =  trim($_GET['query']);

$result = mysqli_query($connection, "SELECT * FROM contacts
            WHERE (`firstname` LIKE '%".$query."%') OR (`lastname` LIKE '%".$query."%') OR (`phone` LIKE '%".$query."%') OR (`email` LIKE '%".$query."%') ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8"> 
      <meta name="viewport" content="width=device-width, initial-scale=1">     
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href='https://fonts.google.com/specimen/Montserrat' rel='stylesheet' type='text/css'>
      <link href='https://fonts.google.com/specimen/Roboto' rel='stylesheet' type='text/css'>
    </head>

  <body>

  <div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-md-12 mx-auto">
            <div style="margin: 50px" class="text-center mb-1"><h3><strong>Contacts</strong></h3></div>

             <p><a href="create.php"><button type="button" class="btn btn-outline-primary">Create User</button></a></p>

             <form class="form-horizontal" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
                <input type="hidden" name="search" value="search" />        

                <div class="form-inline row mt-4">
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="query" required="" placeholder="Search" autocomplete="off">
                        <button class="btn btn-info" name="submit" type="submit">Go</button>
                    </div>
                </div>
            </form>
          <table class="table col-md-12 mt-3" class="table table-striped table-bordered">
            <thead>
            <tr>
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

        if (!empty($result)) {
          while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['firstname']."</td>";
            echo "<td>".$res['lastname']."</td>";
            echo "<td>".$res['phone']."</td>";
            echo "<td>".$res['email']."</td>";       
            echo '<td><a class="btn" href="edit.php?id='.$res['id'].'">Edit</a>';
            echo ' | ';
            echo '<a class="btn" href="delete.php?id='.$res['id'].'">Delete</a>';
            echo "</td>";
            echo "</tr>";       
          }
        }else{
          echo "<tr><td>";
          echo "No search results!";
          echo "</td></tr>";
        }        
        ?>           
          </tbody>
      </table>        
        </div>
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


    
   
