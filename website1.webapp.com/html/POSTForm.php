<?php?>
<!DOCTYPE HTML>
<html lang="en-us" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewpoint" content="width=device-width, initial-scale=1.0">
		<title>Mohap Portal(POST)</title>
		<meta name="author" content="Saakshi, Giselle, Rayhan, Christin">
		<meta name="description" content="Login form but with POST method">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrC$">
		<link rel="icon" href="./favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="./css/mohapstyle.css">
	</head>
	<body>
		<section>
			<div class="imgBx">
				<img src="./images/banner.JPG">
			</div>
			<div class ="contentBx">
				<div class="formBx">
					<h2>Login</h2>
					<form action="./action.php" method="POST">
						<div class="inputBx">
							<label for="username">Username:</label>
							<input type="text" name="username" id="username" required>
						</div>
						<div class="inputBx">
							<label for="password">Password:</label>
							<input type="password" name="password" id="password" required>
						</div>
						<div class ="remember">
								<label><input type="checkbox" name=""> Remember me </label>
						</div>
						<div class="inputBx">
							<input type="submit" value="Sign in" name="submit">
						</div>
						<div class="inputBx">
							<input type="button" value="Sign in with UAE Pass" name="">
						</div>
					</form>
				</div>
			</div>
		</section>
	</body>
</html>
