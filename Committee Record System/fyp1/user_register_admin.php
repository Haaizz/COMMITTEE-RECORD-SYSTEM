<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="user_register.css">
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
<?php
// call file to connect to server
include("header.php");?>


<?php
//This query inserts a record in the client table
//has form been submitted ?
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	$error = array(); //initialize an error array

	//check for a firstname
	if (empty($_POST['FullName_U'])) {
		$error [] = 'You forgot to enter your full name.';
	}
	else{
		$n =mysqli_real_escape_string ($connect,trim($_POST['FullName_U']));
	}


	//check for a lastname
	if(empty($_POST['Pdf_U'])) {
		$error [] = 'You forgot to enter your pdf file.';
	}
	else {
		$l = mysqli_real_escape_string ($connect,trim($_POST['Pdf_U']));
	}


	//check for a insurance number
	if (empty($_POST['Phone_U'])) {
		$error [] = 'You forgot to enter your phone number.';
	}
	else{
		$i = mysqli_real_escape_string($connect,trim($_POST['Phone_U']));
	}


	//check for a diagnose
	if(empty($_POST['Email_U'])) {
		$error [] = 'You forgot to enter your email.';
	}
	else{
		$d = mysqli_real_escape_string($connect,trim($_POST['Email_U']));
	}

	//register the user in database 
	//make the query:
	$q = "Insert INTO user (ID_U, FullName_U, Pdf_U, Phone_U, Email_U)
	VALUES(' ', '$n', '$l', '$i', '$d')";
	$result = @mysqli_query($connect, $q); //run the query
	if($result){ //if it runs
		header("location:list_customer.php");
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


<form action="user_register.php" method="post">
<h2 align="left"> Register </h2>
<h5> *required field </h5>	

<p><label class="label" for="FullName_U"> Full Name : *</label>
<input id="FullName_U" type="text" name="FullName_U" size="30" maxlength="150"
value="<?php if(isset($_POST['FullName_U'])) echo $_POST['FullName_U'];?>"/></p>


<p><label class="label" for="Pdf_U"> Surat Lantikan : *</label>
<input id="Pdf_U" type="file" name="Pdf_U"
value="<?php if(isset($_POST['Pdf_U'])) echo $_POST['Pdf_U'];?>"/></p>


<p><label class="label" for="Phone_U"> Phone Number : *</label>
<input id="Phone_U" type="text" name="Phone_U" size="12" maxlength="12"
value="<?php if(isset($_POST['Phone_U'])) echo $_POST['Phone_U'];?>"	/>
</p>

<p><label class="label" for="Email_U"> Email : *</label>
<input id="Email_U" type="email" name="Email_U" 
value="<?php if(isset($_POST['Email_U'])) echo $_POST['Email_U'];?>"	/>
</p><br><br>

<p><input id="submit" type="submit" name="submit" value="Register"/> &nbsp;&nbsp;
<input id="reset" type="reset" name="reset" value="Clear All" />
</p>
</form>
<p>
</div>
	<br>
	<br>
	<br>
</body>
</html>