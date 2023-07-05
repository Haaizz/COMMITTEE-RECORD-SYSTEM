<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin Page</title>
<link rel="stylesheet" href = "search_customer.css">
</head>

<body>

   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <ul >
                  <li><a href="#"></a></li>
                  <!--<li><a href="user_register.php">REGISTER</a></li>-->
                  <li><a href="list_customer.php">LIST</a></li>
                  <li><a href="search_customer.php">SEARCH</a></li>
                  <!--<li><a href="admin_product.php">VIEW</a></li>-->s
                  <li><a href="hp_admin.html">HOME</a></li>
                

               </ul>
            </nav>
            <div class="overlay">
            <div class="content">
              
               
            <?php include("../header.php"); ?>

<form action="record_customer.php" method="post">
    <h1>Search Record Lecturer </h1>
    <p>
        <label class="label" for="name">Name:</label>
        <input id="name" type="text" name="name" size="30" 
            value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" />
    </p>
    <p>
        <input id="submit" type="submit" name="submit" value="Search" />
    </p>
</form>

            </div>
         </div>
         </div>
      </div>
   </div>
</body>
</html>
