<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  session_start();

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
  }

  $DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'P@ssw0rd';
	$DATABASE_NAME = 'appointments';

  $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

  if ( mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
  }
  $fullName = $reason = $date = $time = $datetime ="";
  $fullName_err = $reason_err = $datetime_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["fullName"]))) {
      $fullName_err = "Please enter the full name";
    } else {
      $fullName = trim($_POST["fullName"]);
    }
    if(empty(trim($_POST["reason"]))) {
      $reason_err = "Please enter reason";
    } elseif (strlen(trim($_POST["reason"])) > 255) {
      $reason_err = "Stay within 255 characters";
    } else {
      $reason = trim($_POST["reason"]);
    }
    if(empty(trim($_POST["date"])) && empty(trim($_POST["time"]))) {
      $datetime_err = "Please enter date and time";
    } else {
      $sql = "SELECT id FROM appointmentDetails WHERE aptDate = ?";
      if($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $aptDate);
        $aptDate = $_POST["date"] . " " . $_POST["time"];
        if(mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1) {
            $datetime_err = "Already booked time";
          } else {
            $datetime = trim($_POST["date"]) . " " . trim($_POST["time"]);
          }
        } else {
          exit("OOps something went wrong");
        }
        mysqli_stmt_close($stmt);
      }
    }
    if(empty($fullName_err) && empty($reason_err) && empty($datetime_err)){
      $sql = "INSERT INTO appointmentDetails (fullName, reason, aptDate, username) VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $fullName, $reason, $datetime, $_SESSION["username"]);

        if(mysqli_stmt_execute($stmt)){
            header("Location: viewAppointments.php");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
      }
    }
  }
  mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Appointment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="./css/page.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
  <form action=<?php echo $_SERVER['PHP_SELF'];?> method="POST">
    <label for="fullName">Full Name:</label>
    <input type="text" name="fullName" id="fullName" class=<?php echo (!empty($fullName_err)) ? 'is-invalid' : ''; ?> required>
    <span class="invalid-feedback"><?php echo $fullName_err; ?></span>
    <label for="reason">Reason:</label>
    <textarea name="reason" id="reason" rows="6" cols="40" maxlength="255" minlength="10" placeholder="Reason for Appointment" class=<?php echo (!empty($reason_err)) ? 'is-invalid' : ''; ?> required></textarea>
    <span class="invalid-feedback"><?php echo $reason_err; ?></span>
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" min=<?php echo date("y-m-d");?> class=<?php echo (!empty($datetime_err)) ? 'is-invalid' : ''; ?> required>
    <label for="time">Time:</label>
    <input type="time" name="time" id="time" min="9:00" max="18:00" class=<?php echo (!empty($datetime_err)) ? 'is-invalid' : ''; ?> required>
    <small>Office hours are 9am to 6pm</small>
    <span class="invalid-feedback"><?php echo $datetime_err; ?></span>
    <input type="submit" value="Book">
  </form>
</body>
</html>
