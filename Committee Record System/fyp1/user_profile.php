<?php
// Include the necessary PHP files to connect to the database.
include("header.php");
session_start();


// Retrieve the user data from the database.
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($connect, $query);
$user_data = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Profile</title>
	<link rel="stylesheet" href = "user_profile.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: 'Roboto', sans-serif;
			background-color: #f5f5f5;
		}

		header {
			background-color: grey;
			color: white;
			padding: 20px;
			text-align: center;
		}

		h1 {
			margin-top: 0;
			font-weight: 300;
			font-size: 3em;
		}

		.container {
			background-color: #fff;
			margin: 50px auto;
			max-width: 600px;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 5px;
			display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: flex-start;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			border-radius: 5px;
			overflow: hidden;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		th, td {
			padding: 20px;
			text-align: left;
			border-bottom: 1px solid #eee;
		}

		th {
			background-color: #f5f5f5;
			font-weight: 400;
			color: #666;
			border-right: 1px solid #eee;
		}

		td {
			font-weight: 300;
			color: #333;
		}

		a {
			color: #1e90ff;
			text-decoration: none;
			font-weight: 400;
		}

		a:hover {
			color: #005fcc;
			text-decoration: underline;
		}
		.profile-pic img {
			width: 300px;
			height: auto;
		}
	</style>
</head>
<body>

<div class="main">
      <div class="wrapper">
         <div class="header">
            
                <nav>
               
               <div class="logo">
                  <a href="hp.html">UPTM</a>
               </div>
               <ul>
                  <li><a href="hp_member.html" style="color:red;">HOME</a></li>
                  
                  <li><a href="product3.php?user_id=<?php echo $user_id; ?>" style="color: red;">LECTURERS</a></li>


                  <li><a href="committee.php" style="color: red;">COMMITTEE</a></li>

                   <li><a href="user_profile2.php" style="color: red;">PROFILE</a></li>
                 
                  
                 <!-- <li><a href="user_login.php">LOG OUT</a></li>-->

               </ul>
            </nav>

            <div class="overlay">
            <div class="content">

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="table-container">
	<header>
		<h1>User Profile</h1>
	</header>
	<div class="container">
		<table>
			<tr>
        <th>Profile Picture</th>
        <td><?php echo $user_data['photo']; ?></td>
        <td class="profile-pic"><img src="<?php echo $user_data['photo']; ?>"></td>
        
    </tr>

				


			
    <tr>
        <th>Full Name</th>
        <td><?php echo $user_data['name']; ?></td>
        
    </tr>
    <tr>
        <th>Phone Number</th>
        <td><?php echo $user_data['phone']; ?></td>
        
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo $user_data['email']; ?></td>
        
    </tr>
    <tr>
        <th>Course</th>
        <td><?php echo $user_data['field']; ?></td>
        
    </tr>



		
    
</table>


		<form action="edit_profile.php" method="get">
    <input type="hidden" name="field" value="Phone_U">
    <button class="btn-1"type="submit">Edit Profile</button>
</form>
	</div>

</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

