<?php include("../header.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    /* Basic table styles */
    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #444;
    }
    
    th, td {
        padding: 8px;
        text-align: left;
        vertical-align: middle;
        border: 1px solid #ddd;
    }
    
    th {
        font-weight: bold;
        background-color: #f2f2f2;
    }
    
    /* Button styles */
    .btn {
        display: inline-block;
        padding: 6px 12px;
        border: 1px solid #333;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }
    
    .btn:hover {
        background-color: #fff;
        color: #333;
    }
    
    /* Responsive styles */
    @media screen and (max-width: 600px) {
        table {
            font-size: 14px;
        }
        
        th, td {
            padding: 6px;
        }
        
        .btn {
            font-size: 12px;
            padding: 4px 8px;
        }
    }
</style>


<title>Admin Page</title>
<link rel="stylesheet" href = "record_customer.css">
</head>

<body>

   <div class="main">
      <div class="wrapper">
         <div class="header">
            
            <nav>
               
               <ul >
                  <li><a href="#"></a></li>
                  <!--<li><a href="register_select.html">REGISTER</a></li>-->
                  <li><a href="list_customer.php">LIST</a></li>
                  <li><a href="search_customer.php" style="color: blueviolet;">SEARCH</a></li>
                  <!--<li><a href="admin_product.php">PRODUCTS</a></li>-->
                   <li><a href="hp_admin.html">HOME</a></li>
                

               </ul>
            </nav>
            <div class="overlay">
            <div class="content">
              
           <?php include("../header.php"); ?>

<h2>Search Result</h2>

<?php
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $q = "SELECT * FROM users WHERE name LIKE '%$name%' ORDER BY id";
    $result = mysqli_query($connect, $q);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Appointment Letter</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Course</th>
                      <th>Committee Name</th>
                      <th>Period</th>
                      <th>Position</th>
                  </tr>
              </thead>
              <tbody>';

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                  <td style="color:white;">' .$row['id']. '</td>
                  <td style="color:white;">' .$row['name']. '</td>
                  <td style="color:white;"><a target="_blank" href="http://localhost/fyp1-22032023/fyp1/' . $row['committee_letter'] . '">' . $row['committee_letter']. '</a></td>

                  <td style="color:white;">' .$row['phone']. '</td>
                  <td style="color:white;">' .$row['email']. '</td>
                  <td style="color:white;">' .$row['field']. '</td>
                  <td style="color:white;">' .$row['committee_name']. '</td>
                  <td style="color:white;">' .$row['committee_period']. '</td>
                  <td style="color:white;">' .$row['position']. '</td>
              </tr>';
        }
        echo '</tbody></table>';
        mysqli_free_result($result);
    } else {
        echo '<p class="error">No records found.</p>';
    }
    mysqli_close($connect);
}
?>



            </div>
         </div>
         </div>
      </div>
   </div>
</body>
</html>
