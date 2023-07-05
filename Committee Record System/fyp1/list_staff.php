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
                  <li><a href="list_select.html" style="color: blueviolet;">LIST</a></li>
                  <li><a href="search_select.html">SEARCH</a></li>
                  <li><a href="admin_product.php">PRODUCTS</a></li>
                <li><a href="hp_admin.html">HOME</a></li>

               </ul>
            </nav>
            <div class="overlay">
            <div class="content">
               <h2>LIST FOR STAFF</h2>

   <?php include("header.php");?>


   <?php
   //make the query
   $q = "SELECT ID_S, FullName_S, UserName_S, Phone_S, Password_S FROM staff ORDER BY ID_S";

   //run the query
   $result = @mysqli_query($connect,$q);

   //if it run without a problem , display the record.
   if($result)
   {
      //Table Heading
      echo '<table border="2">
      <tr><td><b> Edit </b</td>
      <td><b> Delete </b></td>
      <td><b> ID Staff </b></td>
      <td><b> Full Name </b></td>
      <td><b> User Name </b></td>
      <td><b> Phone Number </b></td>
      <td><b> Password </b></td></tr>';


      //Fetch and print all the records
      while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
         echo '<tr>
         <td><a href = "edit_staff.php?id='.$row['ID_S'].'"> Edit </a></td>
         <td><a href = "delete_staff.php?id='.$row['ID_S'].'"> Delete </a></td>
         <td>' . $row['ID_S']. '</td>
         <td>' . $row['FullName_S']. '</td>
         <td>' . $row['UserName_S']. '</td>
         <td>' . $row['Phone_S']. '</td>
         <td>' . $row['Password_S']. '</td>
         </tr>';
      }
      //close the table
      echo '</table>';

      //free up the resources
      mysqli_free_result($result);

      //if failed to run
   }  else {

      //errror message
      echo '<p class = "error"> The current student could not be retreived. We apologies for any inconvenience.</p>';

      //debugging message
      echo '<p>' .mysqli_error($connect). '<br><br> Query: '.$q.'</p>';
   }  //end of it (result)
   //close the db connection
   mysqli_close($connect);
   ?>

            </div>
         </div>
         </div>
      </div>
   </div>
</body>
</html>
