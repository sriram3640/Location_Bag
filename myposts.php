<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>MY POSTS</title>
<link rel="stylesheet" href="css/style_3.css">
<style>
    body {
  background: url("myposts_background.jpg") no-repeat center center fixed;
  background-size: cover;
  font-family: Arial, sans-serif;
  color:black;
}
#message-popup textarea {
  display: inline-block;
  width: 70%;
  height: 70%;
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  margin-top: 120px;
  resize: none;
  border: none;
  box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.5);
}
.navbar-container {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			background-color: rgba(0, 0, 0, 0.3);
			z-index: 1;
			padding: 0px;
			display: flex;
			align-items: center;
			animation: slide-in 2s ease-out;
		}
		
		.navbar-container img {
			width: 100px;
			padding: 10px;
		}
		
		.navbar-container h1 {
			font-size: 56px;
			text-align: center;
			color: white;
			flex-grow: 1;
			
		}
		
		.navbar-container a {
			text-decoration: none;
			color: white;
			margin-right: 20px;
			font-size: 18px;
			font-weight: bold;
		}
    .content {
  width: 90%;
  margin: 0 auto;
  margin-top: 120px; /* adjust this value based on your needs */
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  text-align: center;
  color: black;
  font-size: 20px;
}
</style>
    <script> 
            // Show the image popup
      function showImagePopup(imgSrc) {
          var imagePopup = document.getElementById("image-popup");
          var imagePopupImg = imagePopup.getElementsByTagName("img")[0];
          imagePopupImg.src = imgSrc;
          imagePopup.classList.remove("hidden");
      }
      
      // Hide the image popup
      function hideImagePopup() {
          var imagePopup = document.getElementById("image-popup");
          imagePopup.classList.add("hidden");
      }
              function showMessagePopup(message) {
          var messagePopup = document.getElementById("message-popup");
          var messagePopupTextarea = messagePopup.getElementsByTagName("textarea")[0];
          messagePopupTextarea.value = message;
          messagePopup.classList.remove("hidden");
      }
      
      // Hide the message popup
      function hideMessagePopup() {
          var messagePopup = document.getElementById("message-popup");
          messagePopup.classList.add("hidden");
      }       
    </script>
</head>
<body>
<div class="navbar-container">
		<img src="loc_4.jpg" alt="image-loading">
		<h1>LOCATION BAG</h1>
		<a href="homepage.php">HOME</a>
	</div>
  <div class="content">
    <div1 style="text-align: center; color:beige;">
    <?php if(isset($_SESSION['username'])) { ?>
      <p style="font-weight: bold; font-size:26px;">These are your previous posts, <?php echo $_SESSION['username']; ?>!
      </p>
    </div1>
    <?php } else { ?>
      <a href="index.php">Login</a>
    <?php } ?>
    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px;">
    <form method="get" action="">
        <input style="width:200px; padding:10px;"type="text" name="search" placeholder="Search locations by name or city">
        <button type="submit" name="submit" style="padding:10px; cursor:pointer; font-size:20px;  background-color: #7a1183; color: white;border: none;border-radius: 5px;">Search</button>
    </form>
</div>
    <!-- Add the image popup to the HTML -->
<div id="image-popup" class="hidden" onclick="hideImagePopup()">
    <img onclick="event.stopPropagation();" />
</div>
<div id="message-popup" class="hidden" onclick="hideMessagePopup()">
    <textarea onclick="event.stopPropagation();"></textarea>
</div>

    <?php
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,"locdetails");

    $username=$_SESSION['username'];
    function getLikes($id) {
      global $con;
      $query = "SELECT likes FROM location WHERE id = $id";
      $result = mysqli_query($con, $query);
      $totalLikes = 0;
      if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              $totalLikes += $row['likes'];
          }
      }
      return $totalLikes;
  }
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $query = "SELECT * FROM location WHERE locationname LIKE '%$search%' OR cityname LIKE '%$search%' OR locationtype LIKE '%$search%' AND username LIKE '$username'";
} else {
    $query = "SELECT * FROM location WHERE username = '$username'";
}
        $result = mysqli_query($con, $query);
    
        if (mysqli_num_rows($result) > 0) {
            echo '<table border="1" style="width:90%; margin: 0 auto; text-align:center;">';
            echo '<tr><th>Location Name</th><th>City Name</th><th>Image 1</th><th>Image 2</th><th>Image 3</th><th>Type</th><th>Details</th><th>Likes</th></tr>';
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["locationname"] . "</td>";
                echo "<td>" . $row["cityname"] . "</td>";
                echo "<td><img src='uploads/" . $row["imglink1"] . "' width='150' height='150' onclick=\"showImagePopup('uploads/" . $row["imglink1"] . "')\"></td>";
                echo "<td><img src='uploads/" . $row["imglink2"] . "' width='150' height='150' onclick=\"showImagePopup('uploads/" . $row["imglink2"] . "')\"></td>";
                echo "<td><img src='uploads/" . $row["imglink3"] . "' width='150' height='150' onclick=\"showImagePopup('uploads/" . $row["imglink3"] . "')\"></td>";
                echo "<td>" . $row["locationtype"] . "</td>";
                echo "<td><button style=' padding:8px; cursor:pointer; border:none; border-radius:5%; font-size:13px; background-color: #7a1183; color: white;' onclick=\"showMessagePopup('" . $row["message"] . "')\">View details</button></td>";
                echo "<td><span id=\"likes" . $row["id"] . "\">" . getLikes($row["id"]) . "</span></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    
    mysqli_close($con);
    ?>
  </div>
</body>
</html>