<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Products</title>
<link rel="stylesheet" href = "product3.css">
</head>
<!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
<body>

   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <div class="logo">
                  <a href="hp.html">UPTM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
               </div>
               <ul>
                  <li><a style="color:red;" href="hp_member.html">HOME</a></li>
                  
                  <li><a style="color:red;" href="product3.php" style="color:yellow;">LECTURER</a></li>

                  <li><a style="color:red;" href="committee.php">COMMITTEE</a></li>

                  <li><a style="color:red;" href="user_profile2.php">PROFILE</a></li>
                 
                  
                 <!-- <li><a href="user_login.php">LOG OUT</a></li>-->

               </ul>
               <form class="search-form" method="get" action="">
   <input class="search-input" type="text" name="search" placeholder="Name or Committee">
   <button class="search-btn" type="submit" name="submit">
      <i class="fas fa-search"></i>
   </button>
</form>
            </nav>
            <div class="overlay">




            
<?php

@include 'header.php';

/*if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($connect, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($connect, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}*/
$select_products = mysqli_query($connect, "SELECT * FROM `users`");

// Handle search functionality
if(isset($_GET['submit']) && !empty($_GET['search'])){
   $search_query = $_GET['search'];
   $select_products = mysqli_query($connect, "SELECT * FROM `users` WHERE name LIKE '%$search_query%' OR committee_name LIKE '%$search_query%'");
} else {
   // Fetch all products if search form is not submitted
   $select_products = mysqli_query($connect, "SELECT * FROM `users`");
}

?>

   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading" style="color: white;">Committee Lecturer</h1>

   <div class="box-container">

   <?php
   
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>

   <form action="product3.php" method="post">
      <div class="box" style="background-color: #555555; border: 1px solid #ccc; box-shadow: 0 2px 4px rgba(0,0,0,0.2); padding: 20px;">

  <?php
    if ($fetch_product['photo'] != NULL){
      ?>
      <img src="<?php echo $fetch_product['photo']; ?>" alt="">
      <?php
    } else {
      ?>
      <img src="placeholder.jfif" alt="">
      <?php
    }
  ?>
  <h3 style="color: greenyellow;"><?php echo $fetch_product['name']; ?></h3>
  <h2 style="color: greenyellow;"><?php echo $fetch_product['email']; ?></h2><br>
  <h2 style="color: greenyellow;"><?php echo $fetch_product['committee_name']; ?></h2>
  <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
  <!--<input type="submit" class="btn" value="add to cart" name="add_to_cart">-->
  
</div>

   </form>

   <?php
      };
   } else {
      // Show message if no products match the search query
      echo '<p>No users found.</p>';
   };
   ?>

</div>



</section>

</div>

<!-- custom js file link  -->
<script src="script.js"></script>



           
         </div>
         </div>
      </div>
   </div>
</body>
</html>
