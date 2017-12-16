<?php include 'neodatabase.php'; 


//Secure Homepage 
if (!isset($_SESSION['username'])) {
  $_SESSION['warning'] = "You need to login to access this page";
  //redirect user
  header("location: neologin.php");
}


//check if Edit Button is clicked
if (isset($_GET['edit'])) {
    $id = $_GET['edit']; //assign edit value to id

    //Prepare quesry
    $query = "SELECT * FROM games WHERE id=$id";
    //Perform query
    $edit_record = mysqli_query($con,$query);
    //Concert record into an array
    $edit_array = mysqli_fetch_array($edit_record);

    //Assign Values
    $game_title = $edit_array['game_title'];
    $year_released = $edit_array['year_released'];
    $genre = $edit_array['genre'];
    $console = $edit_array['console'];
    $description = $edit_array['description'];

    //Set edit state 
    $edit_state = true;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Game Database</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>


<body>
<div class="container">

  <!-- Alert Message -->
  <?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-success">
      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
  <?php } ?>


  <!-- Alert Message -->
  <?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success">
      <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
      ?>
    </div>
  <?php } ?>


  <!-- Dashboard -->
  <div class="well">
    <?php if (isset($_SESSION['username'])) { ?>
      <p> Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p><a href="neoserver.php?logout=1" class="btn btn-warning">Logout</a></p>
    <?php } ?>
  </div>




  <!-- Form -->
  <div class="well">
    <h2 class="text-center h_title"><p class="p_title">Add Game Information<p></h2>
      <form  method="POST" action="neodatabase.php">
        <div class="form-row">
          <div class="form-group col-md-6">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="game_title">Title of Game</label>
            <input type="text" class="form-control" name="game_title" placeholder="Game" value="<?php echo $game_title; ?>" required>
          </div>
          <div class="form-group col-md-6">
            <label for="year_released">Year of Release</label>
            <input type="date" class="form-control" name="year_released" value="<?php echo $year_released; ?>" required>
          </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="genre">Genre</label>
            <select class="form-control" name="genre" required>
              <option <?php if(!isset($genre)) echo "selected"; ?> selected>Choose...</option>
              <option <?php if($genre=='PTFRM') echo "selected"; ?> value="PTFRM">Platformer</option>
              <option <?php if($genre=='FIGHT') echo "selected"; ?> value="FIGHT">Fighting Game</option>
              <option <?php if($genre=='BTMUP') echo "selected"; ?> value="BTMUP">Beat-em-Up</option>
              <option <?php if($genre=='RPG') echo "selected"; ?> value="RPG">Role Playing Game</option>
              <option <?php if($genre=='PUZZL') echo "selected"; ?> value="PUZZL">Puzzle Game</option>
              <option <?php if($genre=='RACE') echo "selected"; ?> value="RACE">Racing Game</option>
              <option <?php if($genre=='ADV') echo "selected"; ?> value="ADV">Action-Adventure Game</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="console">Type of Console</label>
            <select class="form-control" name="console" required>
              <option <?php if(!isset($console)) echo "selected"; ?> selected>Choose...</option>
              <option <?php if($console=='NES') echo "selected"; ?> value="NES">Nintendo Entertainment System</option>
              <option <?php if($console=='SNES') echo "selected"; ?> value="SNES">Super Nintendo Entertainment System</option>
              <option <?php if($console=='SEGAGNS') echo "selected"; ?> value="SEGAGNS">SEGA Genesis</option>
              <option <?php if($console=='SEGAMSTR') echo "selected"; ?> value="SEGAMSTR">SEGA Master System</option>
              <option <?php if($console=='GB') echo "selected"; ?> value="GB">Nintendo Game Boy</option>
              <option <?php if($console=='SEGACD') echo "selected"; ?> value="SEGACD">SEGA CD</option>
            </select>
          </div>
        </div>
          <div class="form-group col-md-6">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" placeholder="Add summary here..." value="<?php echo $description; ?>" required>
          </div>
        </div>
        <?php if($edit_state){ ?>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
          <a class="btn btn-warning" href="neoindex.php">Cancel</a>
        <?php } else { ?>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <?php } ?>
        
      </form>
  <!--SEARCH FORM PROTOTYPE-->
  </div>
  <div class="well">
    <form action="search.php" method="GET">
    <input id="search" type="text" placeholder="Type here...">
    <input id="submit" type="submit" value="Search">
    </form>
  </div>
  <!-- End of Form -->

  <!-- Display of Data in a Table Format -->
  <div class="well">
    <p><h2>View Game Information</h2></p>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title of Game</th>
          <th scope="col">Year Released</th>
          <th scope="col">Genre</th>
          <th scope="col">Console</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php $i = 0;
      while ($row = mysqli_fetch_array($game_records)) {?>
        <tr>
          <td><?php echo ++$i; ?></td>
          <td><?php echo $row['game_title']; ?></td>
          <td><?php echo $row['year_released']; ?></td>
          <td><?php echo $row['genre']; ?></td>
          <td><?php echo $row['console']; ?></td>
          <td><?php echo $row['description']; ?></td>
          <td><a class="btn btn-warning" href="neoindex.php?edit=<?php echo $row['id']; ?>">Edit</a>
              <a class="btn btn-danger" href="neoindex.php?del=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>
    <!-- End of Display of Data in a Table Format -->
    
</div>
</body>
</html>