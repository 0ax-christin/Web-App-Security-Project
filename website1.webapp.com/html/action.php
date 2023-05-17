<?php
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
		header("location: welcome.php");
		exit();
	}

	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'P@ssw0rd';
	$DATABASE_NAME = 'appointments';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

	if ( mysqli_connect_errno() ) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	$GETcount = count($_GET);
	$POSTcount = count($_POST);
	$values=0;
	$username = $password = "";
	$err_mess = $login_err = "";

	if ($GETcount != 0) {
		if(isset($_GET["username"], $_GET["password"])) {
			$username = $_GET["username"];
			$password = $_GET["password"];
			$values=1;
		} else {
			exit("Please fill both username and password fields");
			$values=0;
		}
	} elseif($POSTcount != 0) {
		if(isset($_POST["username"], $_POST["password"])) {
			$username = $_POST["username"];
			$password = $_POST["password"];
			$values=1;
		} else {
			exit("Please fill both username and password fields");
			$values=0;
		}
	} else {
		exit("Neither GET nor POST have parameters passed! Are you in the wrong place stranger?");
		$values=0;
	}
	if($values == 1) {
		$sql = "SELECT id,username,password FROM userCreds WHERE username = ?";
		
        	if($stmt = mysqli_prepare($con, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
								//unsecure this from prepared statements to ensure passwordless login
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_store_result($stmt);
                        if(mysqli_stmt_num_rows($stmt) == 1) {
                                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                                if(mysqli_stmt_fetch($stmt)) {
                                        if(password_verify($password, $hashed_password)) {
                                                session_start();
                                                $_SESSION["loggedin"] = true;
                                                $_SESSION["id"] = $id;
                                                $_SESSION["username"] = $username;
                                                header("location: welcome.php");
                                        } else {
                                                $login_err = "Invalid username and password";
                                        }
                                }
                        } else {
                                $login_err = "Invalid username or password.";
                        }
                } else {
                        echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
					}
		mysqli_close($con);
	}
?>
