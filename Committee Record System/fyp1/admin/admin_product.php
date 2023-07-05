<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
   body{
      background-attachment: fixed;
      background-repeat: no-repeat;
      height: 100%;
      width: 100%;
   }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

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
                  <li><a href="user_register_admin.php">REGISTER</a></li>
                  <li><a href="list_customer.php">LIST</a></li>
                  <li><a href="search_customer.php">SEARCH</a></li>
                  <li><a href="admin_product.php">VIEW</a></li>
                  <li><a href="hp_admin.html">HOME</a></li>
                

               </ul>
            </nav>
            <div class="overlay">
            
              
            <?php

include("header.php");?>
<?php

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($connect, "INSERT INTO `products`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'New lecturer succesfully added';
   }else{
      $message[] = 'Could not add the lecturer';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($connect, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin_product.php');
      $message[] = 'Lecturer has been deleted';
   }else{
      header('location:admin_product.php');
      $message[] = 'Lecturer could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($connect, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'Updated succesfully';
      header('location:admin_product.php');
   }else{
      $message[] = 'Could not be updated';
      header('location:admin_product.php');
   }

}

?>

   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>


<?php

include("header.php");?>
<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new lecturer</h3>
   <input type="text" name="p_name" placeholder="Enter full name" class="box" required>
   <input type="text" name="p_price" placeholder="Enter the committee" class="box" required>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="Submit" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>Image</th>
         <th>Name</th>
         <th>Committee</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($connect ,"SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>

            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td style="color: lightseagreen;"><?php echo $row['name']; ?></td>
            <td style="color: lightseagreen;"><?php echo $row['price']; ?></td>
            <td>
               <a href="admin_product.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are your sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a>
               <a href="admin_product.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>Nothing added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($connect, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="text" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="button" value="cancel" onclick="goBack()" class="option-btn">
   </form>
   <script>
  function goBack() {
    window.history.back();
  }
</script>


   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>








<!-- custom js file link  -->
<script src="js/script.js"></script>


            
         </div>
         </div>
      </div>
   </div>
</body>
</html>
