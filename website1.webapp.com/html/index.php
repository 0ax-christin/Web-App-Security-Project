<?php?>
<!DOCTYPE html>
<html lang="en-us" dir="ltr">
	<head>
		<title>Ministry of Licensing and Servicing</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Security-Policy" content="default-src 'unsafe-inline' 'unsafe-eval' *">
		<meta name="author" content="Christin, Saakshi, Giselle, Rayhan">
		<meta name="description" content="Index page">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="icon" href="./favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="./css/index.css">
		<script defer src="./js/translate.js"></script>
		<!--<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
		<script src="http://website2.webapp.com/jquery-3.6.0.min.js"></script>
		<style>
				.sliderimg{
						height: 500px;
						width: 70%;
						position: absolute;
						left: 50%;
						top: 70%;
						transform: translate( -50%, -50%);
						border-radius: 30px;
						background-size: 100% 100%;
						animation:slider 15s infinite linear;

				}

				@keyframes slider{
						0%{background-image: url("./images/pic11.jpg");}
						35%{background-image: url("./images/alhosn.jpg"); }
						75%{background-image: url("./images/rit police.jpg"); }
				}
		</style>
	</head>
	<body>
		<img style="position: absolute; width:250px; height: 70px; top: 25px; left: 100px; " src="./images/mof_logo.png">
		<img style="position: absolute; width:90px; height: 75px; top: 25px; left: 375px; " src="./images/globalstar.png">
		<div class="menu1">
				<ul class="menu-bar1">
						<li id="translate"><button type="button">Arabic</button></li>
						<li id="settings">Settings</li>
						<li id="covid">Covid 19</li>
				</ul>
		</div>
		<div class="menu2">
				<ul class="menu-bar2">
						<li id="home">Home</li>
						<li id="services">Services</li>
						<li id="digitalPart">Digital Participation</li>
						<li id="openData">Open Data</li>
						<li id="aboutUs">About Us</li>
						<li id="loginGET"><a href="./GETForm.php">Login(GET)</a></li>
						<li id="loginPOST"><a href ="./POSTForm.php">Login(POST)</a></li>
				</ul>
		</div>
	</body>
</html
