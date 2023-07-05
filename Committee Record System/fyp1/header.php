
	<?php
	//extract($_POST);

	//connect to server
	$connect = mysqli_connect("localhost","root","","fyp_lcr");

	if(!$connect){
		die('ERROR:'.mysqli_connect_error());
	}

	?>
