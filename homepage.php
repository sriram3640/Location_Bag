<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" href="css/style_2.css">
	<style>
		#heading {
  max-width: 500px;
  margin: 0 auto;
  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
  border-radius: 10px; /* Add rounded corners */
  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
	padding:10px;
}
body {
  background: url("homepage_background.jpeg") no-repeat center center fixed;
  background-size: cover;
  color: #fff;
}
#main-wrapper {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
  border-radius: 10px; /* Add rounded corners */
  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
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
		.maxi{
			margin-top:200px;
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
					document.getElementById("location").innerHTML = "City: " + city;
				})
				.catch(error => {
					alert("Error: " + error);
				});
		}
	</script>
</head>
<body onload="getLocation()" bgcolor="#191919">
<div id="location" style=
"color:white;
position:absolute;
top:180px;
right:20px;
font-size:30px;"></div>

<center>
<div class="navbar-container">
		<img src="loc_4.jpg" alt="image-loading">
		<h1>LOCATION BAG</h1>
		<a href="index.php">LOG OUT</a>
		<a href="myposts.php">MY POSTS</a>
		<a href="aboutus.php">ABOUT US</a>
	</div>
	<div class="maxi">
	<div class="animated-text" id="main-wrapper">
		<center>
			<h2>Profile Page</h2>
			<h3>Welcome
				<?php echo $_SESSION['username'] ?>
			</h3>
			<?php echo '<img class="avatar" src="'.$_SESSION["imglink"].'">';?>
		</center>
	
		<form class="myform" action="homepage.php" method="post">
			<input name="logout" type="submit" id="logout_btn" value="Log Out"/><br>
			
		</form>
		
		<?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				header('location:index.php');
			}
		?>
	</div>
	<div class="anim" style="text-align:center">
    <h1 style="color:white; transform:rotate(0deg); font-size:70px;">Choose one</h1>
    <button style="	margin-top:10px;
	background-color:#FF5B00;
	padding:5px;
	color:white;
	width:30%;
	text-align:center;
	font-size:18px;
	font-weight:bold;
	margin-bottom:20px;" onclick="window.location.href = 'knowplace.php';">I'm here to know this place</button>
    <button style="	margin-top:10px;
	background-color:#FF5B00;
	padding:5px;
	color:white;
	width:30%;
	text-align:center;
	font-size:18px;
	font-weight:bold;
	margin-bottom:20px;" onclick="window.location.href = 'locdetail.php';">I'm here to describe this place</button>
  </div>
	<marquee id="project_name" direction="right" behavior="alternate" style="
	position: absolute;
  color: white;
  font-family: Georgia, sans-serif;
  font-size: 50px;
  letter-spacing: -2px;
	padding:20px;
  bottom:-250px;
  right:100px;
  left:100px;
  border-width: 0px;">
      Location Bag
    </marquee>
		</div>
</body>
</html>