<?php
	session_start();

	//Initiaize Variables
	$game_title = "";
	$year_released = "";
	$genre ="";
	$console = "";
	$description = "";
	$id = 0;
	$edit_state = false;
	


	//connect to database
	$con = mysqli_connect("localhost","root","","gopio_lis161");


	if (!$con) {
		echo "Connection ERROR!";
	} else {
		echo "Connection CLEAR!";
	}


	//CREATE Record
	if (isset($_POST['submit'])) {
		$game_title = $_POST['game_title'];
		$year_released = $_POST['year_released'];
		$genre = $_POST['genre'];
		$console = $_POST['console'];
		$description = $_POST['description'];
		

		$query = "INSERT INTO games(game_title, year_released, genre, console, description) VALUES ('$game_title', '$year_released', '$genre', '$console', '$description')";

		mysqli_query($con,$query);
		$_SESSION['message'] = "Game Record Saved!";
		header("location: neoindex.php");
	}


	//READ Records
	$game_records = mysqli_query($con,"SELECT * FROM games");


	//UPDATE Record
	if (isset($_POST['update'])) {
		$game_title = $_POST['game_title'];
		$year_released = $_POST['year_released'];
		$genre = $_POST['genre'];
		$console = $_POST['console'];
		$description = $_POST['description'];
		$id = $_POST['id'];
 
 		//Prepare the query
		$query = "UPDATE games SET 
		game_title = '$game_title',
		year_released = '$year_released',
		genre = '$genre',
		console = '$console',
		description = '$description'
		WHERE id=$id";
		//Perform query
		mysqli_query($con,$query);
		//Set Status Message
		$_SESSION['message'] = "Game Record Updated!";
		//Redirect to homepage
		header("location: neoindex.php");
	}

	//DELETE Record
	if (isset($_GET['del'])) {
		$id = $_GET['del'];

		//Prepare query
		$query = "DELETE FROM games WHERE id=$id";
		//Perform query
		mysqli_query($con,$query);
		//Set Status Message
		$_SESSION['message'] = "Game Record Deleted!";
		//Redirect to homepage
		header("location: neoindex.php");
	}


    //REMOVE CODE IF WRONG

	//Search
    if (isset($_POST['search'])) {
      
      $query = "SELECT * FROM games WHERE game_title LIKE '%{$_POST['srch_trms']}%' ";

      
      $results = mysqli_query($con, $query);

      
    }


?>