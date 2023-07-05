<!DOCTYPE html>
<html>
<head>
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
</head>
<body>

<?php
//LOGIN DOKTOR = ADMIN
//call file to connect server Klinik Ajwa
include("header.php");?>

<?php
//This section processes submissions from the login form 
//check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST')	{

	//validate the username
	if(!empty($_POST['ID']))	{
		$un = mysqli_real_escape_string($connect,$_POST['ID']);
	} else 	{
		$un = FALSE ;
		echo '<p class = "error"> You forgot to enter your ID.</p>';
	}

	//validate the password
	if (!empty($_POST['Password'])) {
		$p = mysqli_real_escape_string($connect,$_POST['Password']);
	} else 	{
		$p = FALSE;
		echo '<p class = "error"> You forgot to enter your password.</p>';
	}

	//if no problem
	if($un && $p) {

		//Retrieve the id, firstname, lastname, for the username and password combination
		$q = "SELECT ID, FirstName, LastName, Specialization, Password FROM Doktor WHERE (ID = '$un' AND Password = '$p')";

		//run the query and assign it to the variable $result
		$result = mysqli_query ($connect, $q);

		//count the number of rows that match the username/password combination 
		//if one database row (record) matches the input:
		if(@mysqli_num_rows($result) == 1) {
			//start the session, fetch the record and insert the three values in an array
			session_start();
			$_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
			header("location:hp.html");
			
			echo '<p> You has logged in !</p>';

			//cancel the rest of the script
			exit();

			mysqli_free_result ($result);
			mysqli_close ($connect);
			//no match was made
		}	else {
			echo '<p class = "error"> The username and password entered do not match our records 
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


<form action="login2.php" method="post">
<h3 align="center" >Login<br><br>
<img class="logo1" src="bg.jfif"></h3>


	<p><label class = "label" for ="ID"> ID ;</label>
	<input id = "ID" type = "text" name = "ID" size = "4" maxlength="6"
	value ="<?php if(isset($_POST['ID'])) echo $_POST['ID'];?>"></p>

	<p><label class="label" for = "Password"> Password :</label>
	<input id="Password" type="password" name="Password" size="15" maxlength="60"
	value="<?php if(isset($_POST['Password'])) echo $_POST['Password'];?>">
</p>
<p>&nbsp;</p>
<p align="left"><input id ="submit" type="submit" name="submit" value="login" />
	&nbsp;
<p align="left"><input id="reset" type="reset" name="reset" value="reset"/></p>


<p align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dont have an acccount ?
	<a href="register.php"> Sign up</a>
	</form>


</p>
</div>
</div>
</div>
</body>
</html>