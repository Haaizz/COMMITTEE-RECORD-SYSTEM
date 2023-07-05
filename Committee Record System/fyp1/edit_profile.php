<body style="background-image: url('black3.jfif'); background-repeat: no-repeat; background-size: cover;">
<?php include("header.php");?>

<?php
//start the session
session_start();

//connect to database
require_once('config.php');

//get user ID from session
$user_id = $_SESSION['id'];

//initialize variables
$full_name = '';
$phone = '';
$email = '';
$course ='';
$cname = '';
$cdate = '';
$cposition = '';
$cletter = '';
$photo = '';

//fetch user data
$q = "SELECT * FROM users WHERE id = '$user_id'";

$result = mysqli_query($connect, $q);
if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $full_name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $course = $row['field'];
    $photo = $row['photo'];
}


//if save button is clicked
if (isset($_POST['save'])) {
    //get updated data from form
    $full_name = mysqli_real_escape_string($connect, $_POST['full_name']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $course = mysqli_real_escape_string($connect, $_POST['course']);

    $photo = '';
    if(!empty($_FILES['photo']['name'])) {
        $filename = $_FILES['photo']['name'];
        $photo = 'user_uploads/photos/' . $filename;
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    //update user data
    $q = "UPDATE users SET name = '$full_name', phone = '$phone', email = '$email', field = '$course' , photo = '$photo' WHERE id = '$user_id'";

    $result = mysqli_query($connect, $q);

    //redirect to user profile page
    header("Location: user_profile2.php");

}

//close database connection
mysqli_close($connect);
?>

<div style="background-image: url('dg.jfif'); background-size: cover; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #ccc; max-width: 600px; margin: 0 auto;">


<div style="background-color: #f8f8f8; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #ccc; max-width: 600px; margin: 0 auto;">
    <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 2rem;">Edit Profile</h2>

<form method="post" enctype="multipart/form-data">
    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">


        <label for="full_name" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Full Name:</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($full_name); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>

    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">


        <label for="phone" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>

    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">


        <label for="email" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>

    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">


        <label for="course" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Course:</label>
        <input type="text" name="course" id="course" value="<?php echo htmlspecialchars($course); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>

    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">


        <label for="photo" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Profile Photo:</label>
        <div style="display: flex; align-items: center;">


            <input type="file" name="photo" id="photo" accept="image/*" style="display: none;">
            <label for="photo" style="background-color: #5f9ea0; color: white; padding: 0.5rem 1rem; font-size: 1.2rem; border-radius: 5px; cursor: pointer;">Choose file</label>


            <?php if(!empty($photo)): ?>
                <span style="margin-left: 1rem; font-size: 1.1rem;">Current Profile Photo: <?php echo htmlspecialchars
            ($photo); ?></span><br><br>

            
            <?php endif; ?>

</div>
    
    <div style="text-align: center;">
      <input type="submit" name="save" value="Save" style="background-color: #5f9ea0; color: white; padding: 0.8rem 1.5rem; font-size: 1.2rem; border-radius: 5px; cursor: pointer;">
  </div></div>
</form>
</div>



