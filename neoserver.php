<?php

	session_start();
	//Initialize variables
	$username = "";
	$email = "";
	$password_1 = "";
	$password_2 = "";
	$password = "";
	$errors = array();

	//Connect to database
	$con = mysqli_connect("localhost", "root", "", "gopio_lis161");

	//Check if there are errors in connection
	if (!$con){
		echo "Database connection error!";
	}

	//If register button is clicked
	if(isset($_POST['reg_user'])) {
		$username = mysql_real_escape_string($_POST['username']);
		$email = mysql_real_escape_string($_POST['email']);
		$password_1 = mysql_real_escape_string($_POST['password_1']);
		$password_2 = mysql_real_escape_string($_POST['password_2']);

		//Check if all fields have values
		if (empty($username)) {
			array_push($errors, "Username should not be blank");
		}
		if (empty($email)) {
			array_push($errors, "Email should not be blank");
		}
		if (empty($password_1)) {
			array_push($errors, "Password should not be blank");
		}
		if ($password_2 != $password_1) {
			array_push($errors, "Please retype password");
		}

		//If there is no errors in the input fields
		if (count($errors)==0 ){
			$password = md5($password_1); //encrypt password
			//Prepare query statement
			$query = "INSERT INTO users(username, email, password) 
			VALUES ('$username', '$email', '$password')";
			//Perform query
			mysqli_query($con,$query);
			//Set session variables
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You have successfully registered";
			//Redirect the user
			header("location: neoindex.php");
		}
	}


	//If login button is clicked
	if (isset($_POST['login_user'])){
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		//Perform basic input verification
		if (empty($username)) {
			array_push($errors, "Username should not be blank");
		}
		if (empty($password)) {
			array_push($errors, "Password should not be blank");
		}
		//If there are no errors in the input field
		if (count($errors)==0 ){
			$password = md5($password); // Encrypt the password
			//Prepare query statement
			$query = "SELECT * FROM users WHERE username = '$username'
			AND password = '$password' "; 
			//Perform query
			$result = mysqli_query($con,$query);
			//Check if there is a record returned by selecct statement
			if (mysqli_num_rows($result)==1) {
				//Set session variables
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You have successfully logged in";
				//Redirect the user
				header("location: neoindex.php");
			} else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	//If log-out link is clicked
	if (isset($_GET['logout'])) {
		session_destroy(); //Destroy session
		unset($_SESSION['username']); //Unset session variable
		//Redirect the user
		header("location: neologin.php");
	}

?>