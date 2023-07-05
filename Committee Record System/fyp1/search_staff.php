<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin Page</title>
<link rel="stylesheet" href = "register_select.css">
</head>

<body>

   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <ul >
                  <li><a href="#"></a></li>
                  <li><a href="register_select.html">REGISTER</a></li>
                  <li><a href="list_select.html">LIST</a></li>
                  <li><a href="search_select.html" style="color: blueviolet;">SEARCH</a></li>
                  <li><a href="admin_product.php">PRODUCTS</a></li>
                  <li><a href="hp_admin.html">HOME</a></li>
                

               </ul>
            </nav>
            <div class="overlay">
            <div class="content">
              
               
            <?php include("header.php"); ?>


         <form action="record_staff.php" method="post">

            <h1>Search record staff </h1>
            <p><label class="label" for="ID_S">ID Number :</label>
               <input id="ID_S" type="text" name="ID_S" size="30" maxlength="30"
               value="<?php if (isset($_POST['ID_S'])) echo $_POST['ID_S']; ?>"/></p>

               <p><input id="submit" type="submit" name="submit" value="search"></p>
            </form>
            </div>
         </div>
         </div>
      </div>
   </div>
</body>
</html>
