<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin Page</title>
<link rel="stylesheet" href = "edit_customer.css">
<style>
  form {
    background-color: #c4bfab;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  input[type="text"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
</style>
</head>

<body>

   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <ul >
                  <li><a href="#"></a></li>
                  <!--<li><a href="user_register_admin.php">REGISTER</a></li>-->
                  <li><a href="list_customer.php">LIST</a></li>
                  <li><a href="search_customer.php">SEARCH</a></li>
                  <!--<li><a href="admin_product.php">VIEW</a></li>-->
                  <li><a href="hp_admin.html">HOME</a></li>
                

               </ul>
            </nav>
            <div class="overlay">
            <div class="content">
              <br><br><br><br><br><br><br><br><br><br><br>
               <?php include("../header.php");?>

               <h2> Edit a record </h2>

         <?php
         //look for a valid user id, either through GET or POST
         if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            $id = $_GET['id'];
         } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
            $id = $_POST['id'];
         } else {
            echo '<p class = "error"> This page has been accesses in error.</p>';
            exit();
         }

         if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();

            //look for firstname
            if(empty($_POST['FullName_U'])) {
               $error[] = 'You forgot to enter the First Name.';
            } else {
               $n = mysqli_real_escape_string($connect, trim($_POST['FullName_U']));
            }

            

            //look for Insurance Number
            if (empty($_POST['Phone_U'])) {
               $error [] = 'You forgot to enter the Insurance Number.';
            }  else {
               $in = mysqli_real_escape_string($connect,trim($_POST['Phone_U'])) ;
            }


            //look for Diagnose
            if (empty($_POST['Email_U'])) {
               $error [] = 'You forgot to enter the Diagnose.';
            }  else {
               $d = mysqli_real_escape_string($connect,trim($_POST['Email_U'])) ;
            }

            if (empty($_POST['Bidang_U'])) {
               $error [] = 'You forgot to enter the Diagnose.';
            }  else {
               $c = mysqli_real_escape_string($connect,trim($_POST['Bidang_U'])) ;
            }

            if (empty($_POST['Cname'])) {
               $error [] = 'You forgot to enter the Diagnose.';
            }  else {
               $cn = mysqli_real_escape_string($connect,trim($_POST['Cname'])) ;
            }

            if (empty($_POST['Cdate'])) {
               $error [] = 'You forgot to enter the Diagnose.';
            }  else {
               $cd = mysqli_real_escape_string($connect,trim($_POST['Cname'])) ;
            }

            if (empty($_POST['Cposition'])) {
               $error [] = 'You forgot to enter the Diagnose.';
            }  else {
               $cp = mysqli_real_escape_string($connect,trim($_POST['Cposition'])) ;
            }



            //if no problem occured
            if(empty($error)) {

               $q = "SELECT id FROM users WHERE email = '$in' AND id != $id";

               $result = @mysqli_query($connect,$q);

               if(mysqli_num_rows($result) == 0) {
                  $q = "UPDATE users SET name = '$n', phone = '$in', email = '$d', field = '$c', committee_name = '$cn', committee_period = '$cd', position = '$cp' WHERE id = '$id' LIMIT 1";

                  $result = @mysqli_query($connect,$q);

                  if(mysqli_affected_rows($connect) == 1) {

                     echo '<h3> The user has been edited</h3>';
                  } else {
                     echo '<p class ="error"> The user has no be edited due to the system error.We apologize for any inconvenience.</p>';
                     echo '<p>' .mysqli_error($connect). '<br> query : ' .$q. '</p>';     
                  }

               }  else {
                  echo '<p class = "error"> The no ic has already been registered</p>';
               }
            }  else {
               echo '<p class = "error"> The following error (s) occured : <br>';
               foreach ($error as $msg) 
               {
                  echo " -$msg<br> \n";   
               }
               echo '</p><p> Please try again.</p>';
            }
         }

         $q = "SELECT name, phone, email, field, committee_name, committee_period, position FROM users WHERE id = $id";
         $result = @mysqli_query($connect,$q);

         if(mysqli_num_rows($result) == 1) {
            //get patient information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            //create the form
            echo '<form action = "edit_customer.php" method = "post">
            <p><label class = "label" for = "FullName_U" style="color:black"> Full Name : </label>
            <input id = "FullName_U" type = "text" name = "FullName_U" size = "40" maxlength = "255" value = "'.$row[0].'"></p>

            

            <p><label class = "label" for = "Phone_U" style="color:black"> Phone Number : </label>
            <input id = "Phone_U" type = "text" name = "Phone_U" size = "40" maxlength = "255" value = "'.$row[1].'"></p>

            <p><label class = "label" for = "Email_U" style="color:black"> Email : </label>
            <input id = "Email_U" type = "text" name = "Email_U" size = "40" maxlength = "255" value = "'.$row[2].'"></p>

            <p><label class = "label" for = "Bidang_U" style="color:black"> Course : </label>
            <input id = "Bidang_U" type = "text" name = "Bidang_U" size = "40" maxlength = "255" value = "'.$row[3].'"></p>

            <p><label class = "label" for = "Cname" style="color:black"> Committee Name : </label>
            <input id = "Cname" type = "text" name = "Cname" size = "40" maxlength = "255" value = "'.$row[4].'"></p>

            <p><label class = "label" for = "Cdate" style="color:black"> Period : </label>
            <input id = "Cdate" type = "text" name = "Cdate" size = "40" maxlength = "255" value = "'.$row[5].'"></p>

            <p><label class = "label" for = "Cposition" style="color:black"> Position : </label>
            <input id = "Cposition" type = "text" name = "Cposition" size = "40" maxlength = "255" value = "'.$row[6].'"></p>


            <br><p><input id = "submit" type = "submit" name = "submit" value = "Edit"></p>

            <br><input type = "hidden" name = "id" value = "'.$id.'"/>
            
            </form>';


         } else {
            echo '<p class = "error"> This page has been accessed in error.</p>';
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
