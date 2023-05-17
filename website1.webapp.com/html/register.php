<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'P@ssw0rd';
	$DATABASE_NAME = 'appointments';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

	if ( mysqli_connect_errno() ) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty(trim($_POST["username"]))) {
			$username_err = "Please enter the username";
		} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
			$username_err = "Username can only contain letters, numbers, and underscores.";
		} else {
			$sql = "SELECT id FROM userCreds WHERE username = ?";

			if($stmt = mysqli_prepare($con, $sql)) {
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				$param_username = trim($_POST["username"]);
				if(mysqli_stmt_execute($stmt)) {
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt) == 1) {
						$username_err = "This username is already taken.";
					} else {
						$username = trim($_POST["username"]);
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
				mysqli_stmt_close($stmt);
			}
		}
		if(empty(trim($_POST["password"]))) {
			$password_err = "Please enter a password.";
		} elseif(strlen(trim($_POST["password"])) < 6) {
			$password_err = "Password must have atleast 6 characters.";
		} else {
			$password = trim($_POST["password"]);
		}

		if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

		if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO userCreds (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: POSTForm.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	}

	mysqli_close($con);
?>
<html lang="en-us" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<meta name="author" content="Saakshi, Rayhan, Giselle, Christin">
		<meta name="description" content="Register page for making an account on the website">
		<link rel="icon" href="./favicon.ico" type="image/x-icon">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="./css/index.css">
	</head>
	<body>
		<h1>Register</h1>
		<!--htmlspecialchars prevents XSS turning html characters into harmless code-->
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
			<section>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" placeholder="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required>
					<span class="invalid-feedback"><?php echo $username_err; ?></span>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" placeholder="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
					<span class="invalid-feedback"><?php echo $password_err; ?></span>
				</div>
				<div class="form-group">
					<label>Confirm Password:</label>
					<input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required>
					<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Register">
				</div>
				<p><a href="index.php">Back home</a>.</p>
			</section>
		</form>
	</body>
</html>
