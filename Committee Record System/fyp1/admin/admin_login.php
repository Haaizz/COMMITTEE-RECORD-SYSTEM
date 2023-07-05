<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!--- custom css file link ----->
    <link rel="stylesheet" href="../login2.css">
<style>
.form-container{
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.6)),url(../bg.jfif);
  background-position: center;
  background-size: cover;
  height: 100vh;
  width: 100%;
  overflow-x: hidden;
}

.form{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: #FFFFFF;
  border-radius: 5px;
  padding: 30px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
  width: 80%;
  max-width: 400px;
}

.form h3 {
  font-size: 2rem;
  margin-bottom: 30px;
  color: #333;
  text-align: center;
}

.form label {
  font-size: 1.2rem;
  margin-bottom: 10px;
  color: #333;
  text-align: left;
}

.form input[type=text], .form input[type=password]{
  border: none;
  background-color: #F5F5F5;
  border-radius: 3px;
  padding: 10px 15px;
  margin-bottom: 20px;
  width: 100%;
}

.form input[type=submit] {
  background-color: #F0AD4E;
  border: none;
  border-radius: 3px;
  color: #FFF;
  font-size: 1.2rem;
  padding: 10px 15px;
  cursor: pointer;
}

.form input[type=reset] {
  background-color: #D9534F;
  border: none;
  border-radius: 3px;
  color: #FFF;
  font-size: 1.2rem;
  padding: 10px 15px;
  cursor: pointer;
}

.form input[type=submit]:hover, .form input[type=reset]:hover {
  opacity: 0.8;
}

.form input[type=submit]:active, .form input[type=reset]:active {
  opacity: 0.6;
}

</style>

</head>
<body>

<?php
//LOGIN ADMIN
//call file to connect server Klinik Ajwa
include("../header.php");?>

<?php
//This section processes submissions from the login form 
//check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST')	{

	//validate the username
	if(!empty($_POST['UserName_A']))	{
		$un = mysqli_real_escape_string($connect,$_POST['UserName_A']);
	} else 	{
		$un = FALSE ;
		echo '<p class = "error" style="color:red;"> You forgot to enter your ID.</p>';
	}

	//validate the password
	if (!empty($_POST['Password_A'])) {
		$p = mysqli_real_escape_string($connect,$_POST['Password_A']);
	} else 	{
		$p = FALSE;
		echo '<p class = "error" style="color:red;"> You forgot to enter your password.</p>';
	}

	//if no problem
	if($un && $p) {

		//Retrieve the id, firstname, lastname, for the username and password combination
		$q = "SELECT * FROM admin_users WHERE (name = '$un' AND password = '$p')";

		//run the query and assign it to the variable $result
		$result = mysqli_query ($connect, $q);

		//count the number of rows that match the username/password combination 
		//if one database row (record) matches the input:
		if(@mysqli_num_rows($result) == 1) {
			//start the session, fetch the record and insert the three values in an array
			session_start();
			$_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
			header("location:hp_admin.html");
			
			echo '<p> You has logged in !</p>';

			//cancel the rest of the script
			exit();

			mysqli_free_result ($result);
			mysqli_close ($connect);
			//no match was made
		}	else {
			echo '<p class = "error" style="color:red;"> The username and password entered do not match our records 
			<br> Perhaps you need to register, just click the Register button</p>';
		}
		//If there was a problem
	} else {
		echo '<p class ="error" style="color:red;"> Please try again. </p>';
	}
	mysqli_close($connect);
} //end of submit conditional

?>
<div class="form-container">
  <form class="form" action="admin_login.php" method="post">
    <h3>Login</h3>
    <img class="logo" src="../icons8-icon-78.png">
    <label for ="UserName_A"> User Name </label>
    <input id="UserName_A" type="text" name="UserName_A" maxlength="30"
           value="<?php if(isset($_POST['UserName_A'])) echo $_POST['UserName_A'];?>">
    <label for = "Password_A"> Password </label>
    <input id="Password" type="password" name="Password_A" maxlength="60"
           value="<?php if(isset($_POST['Password_A'])) echo $_POST['Password_A'];?>">
    <input type="submit" name="submit" value="Login" />
    <input type="reset" name="reset" value="Reset"/>
  </form>
</div>
</div>
</div>
</body>
</html>