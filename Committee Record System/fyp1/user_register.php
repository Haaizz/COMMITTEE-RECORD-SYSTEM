<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="user_register.css">
</head>
<style>

</style>
<body>
  <?php
//LOGIN DOKTOR = USER
//call file to connect server Klinik Ajwa
include("header.php");?>



<?php
//This query inserts a record in the client table
//has form been submitted ?
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	$error = array(); //initialize an error array


	//check for a firstname
	if (empty($_POST['name'])) {
		$error [] = 'You forgot to enter your full name.';
	}
	else{
		$n =mysqli_real_escape_string ($connect,trim($_POST['name']));
	}


	//check for a lastname
	
	/*if (empty($_FILES['file']['name'])) {
		$error [] = 'You forgot to enter your full name.';
	}
	else {
		
			$targetfolder = "user_uploads/";

 		 $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
 		 echo $targetfolder;
	

if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))

 {



 echo "The file ". basename( $_FILES['file']['name']). " is uploaded";

 }

 else {

 echo "Problem uploading file";

 }


		$l = mysqli_real_escape_string ($connect,trim($_FILES['file']['name']));
	
}*/

	//check for a insurance number
	if (empty($_POST['phone'])) {
		$error [] = 'You forgot to enter your phone number.';
	}
	else{


		$i = mysqli_real_escape_string($connect,trim($_POST['phone']));
	}



	//check for a diagnose
	if(empty($_POST['email'])) {
		$error [] = 'You forgot to enter your email.';
	}
	else{
		$d = mysqli_real_escape_string($connect,trim($_POST['email']));
	}

	//check for a bidang
	if(empty($_POST['field'])) {
		$error [] = 'You forgot to enter your course.';
	}
	else{
		$c = mysqli_real_escape_string($connect,trim($_POST['field']));
	}

	//check for a firstname
	if (empty($_POST['password'])) {
		$error [] = 'You forgot to enter your password.';
	}
	else{
		$p =mysqli_real_escape_string ($connect,trim($_POST['password']));
	}

	//register the user in database 
	//make the query:
	$q = "Insert INTO users (id, name, field, phone, email, password)
	VALUES(' ', '$n', '$c', '$i', '$d','$p')";


	$result = @mysqli_query($connect, $q); //run the query
	if($result){ //if it runs
		header("location:user_login.php");
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


<br><br><br>
<div class="form-container">


<form enctype="multipart/form-data" action="user_register.php" method="post">
<h2 align="left"> Register </h2>
<h5> *required field </h5>	

<p><label class="label" for="name"> Full Name : *</label>
<input id="name" type="text" name="name" size="30" maxlength="150"required placeholder="Ali bin Abu"
value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/></p>


<p><label class="label" for="phone"> Phone Number : *</label>
<input id="phone" type="text" name="phone" size="30" maxlength="30" required placeholder="01234567"
value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>"	/>
</p>


<p><label class="label" for="email"> Email : *</label>
<input id="email" type="email" name="email" required placeholder="ali@gmail.com"
value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"	/>
</p>

<p><label class="label" for="field"> Field : *</label>
<input id="field" type="text" name="field" size="30" maxlength="150"required placeholder="IT/IS/Software Engineering/Networking"
value="<?php if(isset($_POST['field'])) echo $_POST['field'];?>"/></p>

<p><label class="label" for="password"> Password : *</label>
<input id="password" type="password" name="password" size="30" maxlength="150"required
value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"/></p>

<!--<p><label class="label" for="Pdf_U"> Surat Lantikan : *</label>
<input required id="file" type="file" name="file"/></p>-->

<br><br><br>

<p><input id="submit" type="submit" name="submit" value="Register"/> &nbsp;&nbsp;
<input id="reset" type="reset" name="reset" value="Clear All" />
</p>
</form>
<p>
</div>
	
</body>
</html>