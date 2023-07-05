<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Contact Us</title>
<link rel="stylesheet" href = "hp.css">
<link rel="stylesheet" href="login2.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
.form-container{
   margin: 0px;
   min-height: 100vh;
   padding: 20px;
    padding-bottom:60px;
   display: flex;
    align-items: center;
    justify-content: center;
   background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.6)),url(bg.jfif);
   background-position: center;
   background-size: cover;
   overflow-x: hidden;
   position: relative;
}
</style>
<body>


   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <div class="logo">
                  <a href="hp.html">Hello !</a>
               </div>
               <ul>
                  <li><a href="hp.html">HOME</a></li>
                  <li><a href="aboutus.html">ABOUT</a></li>
                  <li><a href="feedback.php">CONTACT US</a></li>
                  <li><a href="product2.php">PRODUCTS</a></li>
                  <li><a href="cart2.php">CART</a></li>
                  <li><a href="user_login.php">LOGIN</a></li>

               </ul>
            </nav>
            <div class="overlay">
          
              
<body>
<?php
// call file to connect to server
include("header.php");?>


<?php
//This query inserts a record in the client table
//has form been submitted ?
if ($_SERVER['REQUEST_METHOD']== 'POST') {
   $error = array(); //initialize an error array

   //check for a firstname
   if (empty($_POST['username'])) {
      $error [] = 'You forgot to enter your user name.';
   }
   else{
      $n =mysqli_real_escape_string ($connect,trim($_POST['username']));
   }


   //check for a lastname
   if(empty($_POST['email'])) {
      $error [] = 'You forgot to enter your email .';
   }
   else {
      $l = mysqli_real_escape_string ($connect,trim($_POST['email']));
   }


   //check for a insurance number
   if (empty($_POST['subject'])) {
      $error [] = 'You forgot to enter your subject.';
   }
   else{
      $i = mysqli_real_escape_string($connect,trim($_POST['subject']));
   }


   //check for a diagnose
   if(empty($_POST['message'])) {
      $error [] = 'You forgot to enter your message.';
   }
   else{
      $d = mysqli_real_escape_string($connect,trim($_POST['message']));
   }

   //register the user in database 
   //make the query:
   $q = "Insert INTO feedback (username, email, subject, message)
   VALUES('$n', '$l', '$i', '$d')";
   $result = @mysqli_query($connect, $q); //run the query
   if($result){ //if it runs

      header("location:feedback.php");
      echo '<h1> Thank You <h1>';
      exit();
   } else{ //if it did run 
      //message
      echo '<h1> System Error </h1>';

      //debugging message
      echo '<p>' .mysqli_error($connect).'<br><br>Query: '.$q. '</p>';
   } //end of it (result)
   mysqli_close($connect); //close db connection.
   exit();

} //end of the main submit conditional
?>



<div class="form-container">


<form action="feedback.php" method="post">
<h1 align="center"> Contact Us </h1>
<h5 align="center" style="color: blueviolet;"> Do you having any inquiries ? Don't shy to tell us what's your problem here ! </h5><br> 

<p><label class="label" for="username"> User Name : </label>
<input id="username" type="text" name="username" size="30" maxlength="150"
value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>"/></p>


<p><label class="label" for="email"> Email : </label>
<input id="email" type="email" name="email" size="30" maxlength="60"
value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"/></p>


<p><label class="label" for="subject"> Subject : </label>
<input id="subject" type="text" name="subject"
value="<?php if(isset($_POST['subject'])) echo $_POST['subject'];?>" />
</p>

<p><label class="label" for="message"> Message : </label><br><br>
<textarea id="message" type="text" name="message"
value="<?php if(isset($_POST['message'])) echo $_POST['message'];?>" />
</textarea><br><br>

<p><input id="submit" type="submit" name="submit" value="Submit"/>
<input id="reset" type="reset" name="reset" value="Clear All" />
</p>
</form>
<p>
</div>



            


            
         </div>
         </div>
      </div>
   </div>

      

         <b><h5 style="text-align: center; color: lightgoldenrodyellow; font: sans-serif;" >Copyright &copy2022 Stationery House Sdn Bhd. Designed by Haaizz<p>Last Modified : -/11/2022 ; --:-- PM</h5></b>
<audio controls>
      <source src="bgmusic.mp3" type="audio/mpeg">
</audio>
         

      


</body>
</html>
