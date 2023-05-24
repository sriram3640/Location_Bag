<?php
  session_start();
  $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Enter location details</title>
  <style>
    /* Global styles */
body {
  background: url("locdetail_background.jpeg") no-repeat center center fixed;
  background-size: cover;
  font-family: "Raleway", sans-serif;
  color: whitesmoke;
}

#main-wrapper {
    max-width: 550px;
    margin: 500px auto 0;
    padding: 20px;
    background-color: transparent; /* Change to transparent */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
form {
    background-color: rgba(0, 0, 0, 0.5); /* Add a background color */
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add a drop shadow */
    padding: 20px;
    max-width: 450px;
    margin: 0 auto;
}

h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  margin-top: 20px;
  display: block;
}

select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
    margin-top: 10px;
    margin-bottom: 20px;
    background-color: #1f1f1f;
    color:white;
}

input[type="text"],
textarea {
  padding: 10px;
  font-size: 16px;
  width: 90%;
  border: none;
  border-radius: 4px;
  background-color: #1f1f1f;
  color: #fff;
  margin-bottom: 20px;
}

input[type="file"] {
  margin-top: 10px;
}

input[type="submit"] {
  background-color: #1abc9c;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 20px;
}

input[type="submit"]:hover {
  background-color: #16a085;
}

/* Image preview styles */
#uploadPreview1,
#uploadPreview2,
#uploadPreview3 {
  width: 150px;
  height: 150px;
  margin-bottom: 20px;
}

/* Location details styles */
#location {
  position: absolute;
  top: 50px;
  right: 50px;
  font-size: 30px;
  color: #fff;
}

/* Media queries for smaller screens */
@media (max-width: 768px) {
  #main-wrapper {
    max-width: 90%;
  }
}
.navbar-container {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			background-color: rgba(0, 0, 0, 0.5);
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
		@keyframes slide-in {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(0);
  }
}
.animated-text {
  animation: slide-in 2s ease-out;
}
.anim {
  animation: slide-in 2s ease-out;
}
#place{
  text-align: center;
  position: absolute;
  top: 420px;
  left:450px;
}

  </style>
  <script>
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
                          fetch("locdetail.php?city=" + encodeURIComponent(city))
                              .then(response => response.text())
                              .then(data => {
                                  // Process the response from the PHP script
                                  window.location.href = "locdetail.php?city=" + encodeURIComponent(city);
                              })
                              .catch(error => {
                                  alert("Error: " + error);
                              });
                      })
                      .catch(error => {
                          alert("Error: " + error);
                      });
              }

    function PreviewImage(number) {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("imglink" + number).files[0]);

      oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview" + number).src = oFREvent.target.result;
      }
    };
  </script>
</head>
<body>
<center>
<div class="navbar-container">
		<img src="loc_4.jpg" alt="image-loading">
		<h1>LOCATION BAG</h1>
		<a href="homepage.php">HOME</a>
    <a href="aboutus.php">ABOUT US</a>
	</div>
  <body>
    <div1 style="text-align: center; color:beige; position:absolute; top:150px; left:470px;">
    <?php if(isset($_SESSION['username'])) { ?>
      <p style="font-weight: bold; color:black; font-size:26px;">Welcome, <?php echo $_SESSION['username']; ?>!
      <form action="index.php" method="post">
           <button type="submit" name="logout" style="padding:10px; cursor:pointer; font-size:20px; margin:5px; background-color: #7a1183; color: white;border: none;border-radius: 5px;">Logout</button>
      </form>
      </p>
      <center>
      <button onclick="getLocation()" style="padding:10px; cursor:pointer; font-size:20px; margin:10px; background-color: #7a1183; color: white;border: none;border-radius: 5px;">get my location</button>
    </center>
    </div1>
    <?php } else { ?>
      <a href="index.php">Login</a>
    <?php } ?>
    <?php
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,"locdetails");
if (isset($_GET["city"])) {
  $city = $_GET["city"];
} else {
  $city = "";
}
echo "<h2 id='place'>you are in $city</h2>";
?>
  <div id="main-wrapper">
    <form class="myform" action="locdetail.php" method="post" enctype="multipart/form-data">
      <center>
        <h2>Enter location details</h2>
      </center>
      <label><b>Enter city name as shown above:</b></label><br>
      <input name="cityname" type="text" class="inputvalues" placeholder="Type city name as shown above" required/><br>
      <label><b>Location name:</b></label><br>
      <input name="locationname" type="text" class="inputvalues" placeholder="Type location name" required/><br>
      <label><b>Describe this location:</b></label><br>
      <textarea name="message" id="text" maxlength="2000">Please describe this location here</textarea><br>
      <label for="options">Select the type:</label>
        <select id="options" name="options">
          <option value="Spiritual">Spiritual</option>
          <option value="Historical">Historical</option>
          <option value="Food">Food</option>
          <option value="Educational">Educational</option>
          <option value="Entertainment">Entertainment</option>
          <option value="Peaceful">Peaceful</option>
          <option value="New places">New places</option>
        </select>
      <label><b>Upload Image 1:</b></label><br>
      <input type="file" id="imglink1" name="imglink1" onchange="PreviewImage(1);" accept="image/*" required/><br>
      <img id="uploadPreview1" style="width: 150px; height: 150px;"/><br>
      <label><b>Upload Image 2:</b></label><br>
      <input type="file" id="imglink2" name="imglink2" onchange="PreviewImage(2);" accept="image/*" required/><br>
      <img id="uploadPreview2" style="width: 150px; height: 150px;"/><br>
      <label><b>Upload Image 3:</b></label><br>
      <input type="file" id="imglink3" name="imglink3" onchange="PreviewImage(3);" accept="image/*" required/><br>
      <img id="uploadPreview3" style="width: 150px; height: 150px;"/><br>
      <input type="submit" id="submit_btn" name="submit_btn" value="Submit"/><br>
</form>
  </div>
</body>
</html>
<?php
if(isset($_POST['submit_btn'])){
  $cityname=$_POST['cityname'];
  $locationname=$_POST['locationname'];
  $username=$_SESSION['username'];
  $message=$_POST['message'];
  $locationtype = $_POST['options'];

  $imglink1 = $_FILES['imglink1']['name'];
  $imglink2 = $_FILES['imglink2']['name'];
  $imglink3 = $_FILES['imglink3']['name'];

  $imglink1_tmp = $_FILES['imglink1']['tmp_name'];
  $imglink2_tmp = $_FILES['imglink2']['tmp_name'];
  $imglink3_tmp = $_FILES['imglink3']['tmp_name'];

  $folder = "uploads/";

  move_uploaded_file($imglink1_tmp,$folder.$imglink1);
  move_uploaded_file($imglink2_tmp,$folder.$imglink2);
  move_uploaded_file($imglink3_tmp,$folder.$imglink3);

  $con=mysqli_connect("localhost","root","");
  mysqli_select_db($con,"locdetails");
  $query = "insert into location values('','$cityname','$locationname','$username','$message','$locationtype','$imglink1','$imglink2','$imglink3','0')";
  if(mysqli_query($con, $query)) {
    echo '<script type="text/javascript">'; 
    echo 'alert("Details inserted successfully!");'; 
    echo 'setTimeout(function(){ window.location.href = "homepage.php"; }, 1000);'; 
    echo '</script>';
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
  }
}
?>
