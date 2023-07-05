<!DOCTYPE html>
<html>
<head>
	<!--<script type="script2.js"></script>-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!--- custom css file link ----->
    <link rel="stylesheet" href="login2.css">
<style>
.form-container{
	margin: 0px;
	min-height: 100vh;
	padding: 20px;
    padding-bottom:5px;
	display: flex;
    align-items: center;
    justify-content: center;
	background-image: url(black3.jfif);
	background-position: center;
	background-size: cover;
	overflow-x: hidden;
	position: relative;
}

.form-container h3 {
	font-family: Arial, sans-serif;
	font-size: 30px;
	font-weight: bold;
	color: #fff;
	margin-bottom: 30px;
	text-align: center;
	text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.form-container form {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
	padding: 40px;
	width: 100%;
	max-width: 500px;
}

.form-container label {
	display: block;
	font-size: 18px;
	margin-bottom: 5px;
	color: #333;
}

.form-container input[type="text"],
.form-container input[type="password"] {
	background-color: #f5f5f5;
	border: none;
	border-radius: 5px;
	font-size: 16px;
	padding: 10px;
	margin-bottom: 20px;
	width: 100%;
	color: #333;
}

.form-container input[type="submit"],
.form-container input[type="reset"] {
	background-color: #2f55d4;
	border: none;
	border-radius: 5px;
	color: #fff;
	cursor: pointer;
	font-size: 18px;
	padding: 10px;
	padding-right: 1px;
	margin-top: 20px;
	transition: background-color 0.2s ease-in-out;
}

.form-container input[type="submit"]:hover,
.form-container input[type="reset"]:hover {
	background-color: #1a4bb4;
}

.form-container p {
	margin-bottom: 10px;
	font-size: 16px;
	color: #333;
}

.form-container a {
	color: #2f55d4;
	font-weight: bold;
	text-decoration: none;
	transition: color 0.2s ease-in-out;
}

.form-container a:hover {
	color: #1a4bb4;
}
.form-container img {
  max-width: 20%;
  height: auto;
  margin-bottom: 20px;
  margin-left: 200px;

}
.error {
  color: red;
  font-size: 14px;
  margin-bottom: 10px;
}

</style>
</head>
<body>

<?php
//LOGIN DOKTOR = USER
//call file to connect server Klinik Ajwa
include("header.php");?>

<?php
//This section processes submissions from the login form 
//check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST')	{

	//validate the email
	if(!empty($_POST['Email_U']))	{
		$d = mysqli_real_escape_string($connect,$_POST['Email_U']);
	} else 	{
		$d = FALSE ;
		echo '<p class = "error"> You forgot to enter your email.</p>';
	}

	//validate the password
	if (!empty($_POST['Password_U'])) {
		$p = mysqli_real_escape_string($connect,$_POST['Password_U']);
	} else 	{
		$p = FALSE;
		echo '<p class = "error"> You forgot to enter your password.</p>';
	}

	//if no problem
	if($d && $p) {

		//Retrieve the id, firstname, lastname, for the email and password combination
		$q = "SELECT * FROM users WHERE (email = '$d' AND password = '$p')";

		//run the query and assign it to the variable $result
		$result = mysqli_query ($connect, $q);

		//count the number of rows that match the email/password combination 
		//if one database row (record) matches the input:
		if(@mysqli_num_rows($result) == 1) {
			//start the session, fetch the record and insert the three values in an array
			session_start();
			$_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
			header("location:hp_member.html");
			
			echo '<p> You has logged in !</p>';

			//cancel the rest of the script
			exit();

			mysqli_free_result ($result);
			mysqli_close ($connect);
			//no match was made
		}	else {
			echo '<p class = "error"> The email and password entered do not match our records 
			<br> Perhaps you need to register, just click the Register button</p>';
		}
		//If there was a problem
	} else {
		echo '<p class ="error"> Please try again. </p>';
	}
	mysqli_close($connect);
} //end of submit conditional

?>
<div class="form-container">
  <form id="login-form" action="user_login.php" method="post">
    <h3 align="center"><u>Login</u></h3>
    <img src="people.png">
    <p>
      <label class="label" for="Email_U"> Email :</label>
      <input id="Email_U" type="text" name="Email_U" size="15" maxlength="30"
      value="<?php if(isset($_POST['Email_U'])) echo $_POST['Email_U'];?>">
    </p>
    <p>
      <label class="label" for="Password_U"> Password :</label>
      <input id="Password" type="password" name="Password_U" size="15" maxlength="60"
      value="<?php if(isset($_POST['Password_U'])) echo $_POST['Password_U'];?>">
    </p>
    <p>
      <input id="submit" type="submit" name="submit" value="login">
      <input id="reset" type="reset" name="reset" value="reset">
    </p>
    <p align="center">Don't have an account? <a href="user_register.php">Sign up</a></p>
  </form>

</div>
</div>
</div>


</body>
</html>