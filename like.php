<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  die('You are not logged in.');
}

// Get the location ID from the query string
$id = $_GET['id'];

// Connect to the database
$con = mysqli_connect('localhost', 'root', '');
mysqli_select_db($con, 'locdetails');

// Check if the user has already liked this location
$query = "SELECT * FROM likes WHERE location_id = $id AND username = '".$_SESSION['username']."'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
  // User has already liked this location
  $query = "SELECT likes FROM location WHERE id = $id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  // Return the updated likes count as a response
  echo $row['likes'];
  echo'<br>';
  echo 'You have already liked this location.';
} else {
  // Add a new like for this location by the current user
  $query = "INSERT INTO likes (id,location_id, username) VALUES ('',$id, '".$_SESSION['username']."')";
  mysqli_query($con, $query);

  // Increment the likes count for the location
  $query = "UPDATE location SET likes = likes + 1 WHERE id = $id";
  mysqli_query($con, $query);

  // Get the updated likes count
  $query = "SELECT likes FROM location WHERE id = $id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  // Return the updated likes count as a response
  echo $row['likes'];
}

mysqli_close($con);
?>
