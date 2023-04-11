<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title><Locations List></title>
<link rel="stylesheet" href="css/style_3.css">
    <script> 
      function like(id) {
        // Send the like request to the server
        fetch("like.php?id=" + encodeURIComponent(id))
          .then(response => response.text())
          .then(data => {
            // Update the likes count
            document.getElementById("likes" + id).innerHTML = data;
      
          })
          .catch(error => {
            alert("Error: " + error);
          });
      }
      
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
      
              function getLocation() {
                  if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(showPosition);
                  } else {
                      alert("Geolocation is not supported by this browser.");
                  }
              }
      
              function showPosition(position) {
                  var latitude = position.coords.latitude;
                  var longitude = position.coords.longitude;
                  var url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" + latitude + "&lon=" + longitude;
                  fetch(url)
                      .then(response => response.json())
                      .then(data => {
                          var city = data.address.city || data.address.town || data.address.village;
                          // Call the PHP script with the city name as a parameter
                          fetch("knowplace.php?city=" + encodeURIComponent(city))
                              .then(response => response.text())
                              .then(data => {
                                  // Process the response from the PHP script
                                  window.location.href = "knowplace.php?city=" + encodeURIComponent(city);
                              })
                              .catch(error => {
                                  alert("Error: " + error);
                              });
                      })
                      .catch(error => {
                          alert("Error: " + error);
                      });
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
    <div1 style="text-align: center; color:beige;">
    <?php if(isset($_SESSION['username'])) { ?>
      <p style="font-weight: bold; font-size:26px;">Welcome, <?php echo $_SESSION['username']; ?>!
      <form action="index.php" method="post">
           <button type="submit" name="logout" style="padding:10px; cursor:pointer; font-size:20px; margin:5px; background-color: #7a1183; color: white;border: none;border-radius: 5px;">Logout</button>
      </form>
      </p>
      <center>
      <button onclick="getLocation()" style="padding:10px; cursor:pointer; font-size:20px; margin:5px; background-color: #7a1183; color: white;border: none;border-radius: 5px;">Show places near me</button>
    </center>
    </div1>
    <?php } else { ?>
      <a href="index.php">Login</a>
    <?php } ?>
    <div style="position: absolute; top: 200px; right: 70px;">
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
  if (isset($_GET["city"])) {
    $city = $_GET["city"];
} else {
    $city = "";
}
echo "<h2>Locations in $city</h2>";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $query = "SELECT * FROM location WHERE locationname LIKE '%$search%' OR cityname LIKE '%$search%' OR locationtype LIKE '%$search%'";
} else {
    $query = "SELECT * FROM location WHERE cityname = '$city'";
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
                echo "<td><button style=\"color:red\" onclick=\"like(" . $row["id"] . ")\">&#x2764;</button><span id=\"likes" . $row["id"] . "\">" . getLikes($row["id"]) . "</span></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    
    mysqli_close($con);
    ?>
</body>
</html>