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
#main-wrapper {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
  border-radius: 10px; /* Add rounded corners */
  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
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
top:50px;
right:20px;
font-size:30px;"></div>

<center>
<div id="heading">
	<h1 style="font-size:56px; text-align:center; color:white">&nbsp;LOCATION BAG</h1>
</div>	
	</center>

	<h5 align="right" style="color:white; font-size:20px;">
		<a href="index.php" style="text-decoration:none; color:white"> HOME </a> &nbsp; | &nbsp; 
		<a href="register.php" style="text-decoration:none; color:white"> REGISTRATION </a> &nbsp; | &nbsp; 
		<a href="index.php" style="text-decoration:none; color:white"> LOGIN </a> &nbsp;
	</h5>
	<div id="main-wrapper">
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
	<div style="text-align:center">
    <h1 style="color:white; font-size:70px;">Choose one</h1>
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
  bottom:-220px;
  right:100px;
  left:100px;
  border-width: 0px;">
      Location Bag
    </marquee>
</body>
</html>