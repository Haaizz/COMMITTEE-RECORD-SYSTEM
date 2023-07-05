<body style="background-image: url('black3.jfif'); background-repeat: no-repeat; background-size: cover;">

<?php 
include("header.php");

session_start();

require_once('config.php');

$user_id = $_SESSION['id'];

$q = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($connect, $q);

if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $cname = $row['committee_name'];
    $cdate = $row['committee_period'];
    $cletter = $row['committee_letter'];
    $position = $row['position'];
}

if (isset($_POST['save'])) {
    $cname = mysqli_real_escape_string($connect, $_POST['cname']);
    $cdate = mysqli_real_escape_string($connect, $_POST['cdate']);
    
    $cletter = '';
    if(!empty($_FILES['cletter']['name'])) {
        $filename = $_FILES['cletter']['name'];
        $cletter = 'user_uploads/' . $filename;
        move_uploaded_file($_FILES['cletter']['tmp_name'], $cletter);
    }

    $position = mysqli_real_escape_string($connect, $_POST['position']);

    $q = "UPDATE users SET committee_name = '$cname', committee_period = '$cdate', committee_letter = '$cletter', position = '$position' WHERE id = '$user_id'";
    mysqli_query($connect, $q);

    header("Location: committee.php");
    exit();
}

mysqli_close($connect);
?>
<br><br>
<div style="background-image: url('dg.jfif'); background-size: cover; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #ccc; max-width: 600px; margin: 0 auto;">
  

<div style="background-color: #f8f8f8; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #ccc; max-width: 600px; margin: 0 auto;">
  <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 2rem;">Edit Committee</h2>

  <form method="post" enctype="multipart/form-data">
    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">
      <label for="cname" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Committee Name:</label>
      <input type="text" name="cname" id="cname" value="<?php echo htmlspecialchars($cname); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>

    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">
      <label for="position" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Position:</label>
      <input type="text" name="position" id="position" value="<?php echo htmlspecialchars($position); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>

    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">
      <label for="cdate" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Appointment Date:</label>
      <input type="date" name="cdate" id="cdate" value="<?php echo htmlspecialchars($cdate); ?>" style="padding: 0.5rem; font-size: 1.2rem; border: 2px solid #ddd; border-radius: 5px;">
    </div>
    <div style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">
      <label for="cletter" style="font-size: 1.2rem; margin-bottom: 0.5rem;">Appointment Letter:</label>
      <div style="display: flex; align-items: center;">
        <input type="file" name="cletter" id="cletter" style="display: none;">
        <label for="cletter" style="background-color: #5f9ea0; color: white; padding: 0.5rem 1rem; font-size: 1.2rem; border-radius: 5px; cursor: pointer;">Choose file</label>
        <?php if(!empty($cletter)): ?>
          <span style="margin-left: 1rem; font-size: 1.1rem;">Current appointment letter: <?php echo htmlspecialchars($cletter); ?></span>
        <?php endif; ?>
      </div>
    </div>


    <div style="text-align: center;">
      <input type="submit" name="save" value="Save" style="background-color: #5f9ea0; color: white; padding: 0.8rem 1.5rem; font-size: 1.2rem; border-radius: 5px; cursor: pointer;">
  </div></form></div>
</div>



