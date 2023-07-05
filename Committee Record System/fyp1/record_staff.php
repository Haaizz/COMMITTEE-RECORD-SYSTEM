<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin Page</title>
<link rel="stylesheet" href = "register_select.css">
</head>

<body>

   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <ul >
                  <li><a href="#"></a></li>
                  <li><a href="register_select.html">REGISTER</a></li>
                  <li><a href="list_select.html">LIST</a></li>
                  <li><a href="search_select.html" style="color: blueviolet;">SEARCH</a></li>
                  <li><a href="admin_product.php">PRODUCTS</a></li>
                

               </ul>
            </nav>
            <div class="overlay">
            <div class="content">
              
            <?php include("header.php"); ?>

            <h2> Search Result </h2>

            <?php

            $id = $_POST['ID_S'];
            $id = mysqli_real_escape_string($connect,$id);

            $q = "SELECT ID_S, FullName_S, UserName_S, Phone_S, Password_S FROM staff WHERE ID_S = '$id' ORDER BY ID_S";

            $result = @mysqli_query ($connect,$q);

            if($result) {
               echo '<table border = "2">
               <tr><td><b> ID </b></td>
               <td><b> Full Name </b></td>
               <td><b> User Name </b></td>
               <td><b> Phone Number </b></td>
               <td><b> Password </b></td>
               </tr>';

               //fetch and display record
               while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  echo '<tr>
                  <td>' .$row['ID_S']. '</td>
                  <td>' .$row['FullName_S']. '</td>
                  <td>' .$row['UserName_S']. '</td>
                  <td>' .$row['Phone_S']. '</td>
                  <td>' .$row['Password_S']. '</td>
                  </tr>';
               }
               echo '</table>';
               mysqli_free_result($result);
            }  else {
               echo '<p class = "error"> If no record is shown, this is because you had an incorrect or missing entry in search form. <br> Click the back button on the browser and try again.</p>';
               echo '<p>' .mysqli_error($connect). '<br><br>Query : '.$q.'</p>';
            }
            mysqli_close($connect);
            ?>

            </div>
         </div>
         </div>
      </div>
   </div>
</body>
</html>
