<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'unsafe-eval' 'unsafe-inline' 'self'">
    <title>Mohap Driving Lisense</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous" defer></script>
    <script src="./js/translateGoogle.js" defer></script>
    <link rel="stylesheet" href="./css/page.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
  <header class="container">
      <a href="" class="logo"><img src="./images/logo.JPG" height= 70px width= 220px></a>
      <nav>
          <a class="hasText" href="">HOME</a>
          <a class="hasText" href="">ABOUT</a>
          <a class="hasText" href="">SERVICES</a>
          <a class="hasText" href="">CONTACT US</a>
      </nav>
  </header>
  <div class="container">
      <div class="intro">
          <h1 class="intro-title hasText">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, Welcome to MOHAP <br> Driving Lisense services </h1>
          <p class="hasText">
              We work on shaping the future and developing our performance to make customers happy within an integrated set of modern electronic infrastructure that coincides with the aspirations of the leadership, and harmonizes with the UAE Vision 2021. We also work on achieving the full transformation of the smart government. Accordingly, we call on all the Ministry's teams to move ahead with a pace that cares for creativity and innovation both in the present and the future, thus becoming in a level that fulfills the aspirations of the UAE government in the race toward global pioneering and progress.
          </p>
          <p class="hasText">
               Renew Driving License| Create Driving License | Register Vehicle License
          </p>
          <br>
          <button id="translatorTrigger" class="btn hasText"> START SERVICE of TRANSLATION</button>
          <button id="translatorTrigger2" class="hasText"> Translate using website2.webapp.com</button>
          <p>
              <a href="logout.php" class="btn btn-danger ml-3 hasText">Sign Out of Your Account</a>
          </p>
      </div>
  </div>
</body>
</html>
