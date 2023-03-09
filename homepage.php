<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" href="css/style.css">
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
right:50px;
font-size:30px;"></div>

	<h1 style="font-size:56px; color:#f7b32d">&nbsp;LOCATION BAG<img src="logo.png" alt="Logo" style="width:100px; height:115px" align="left"></h1>
	<hr style="border-width:3px; border-color:#f7b32d">

	<h5 align="right" style="color:#f7b32d">
		<a href="index.php" style="text-decoration:none; color:#f7b32d"> HOME </a> &nbsp; | &nbsp; 
		<a href="register.php" style="text-decoration:none; color:#f7b32d"> REGISTRATION </a> &nbsp; | &nbsp; 
		<a href="index.php" style="text-decoration:none; color:#f7b32d"> LOGIN </a> &nbsp;
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
	margin-bottom:20px;" onclick="window.location.href = 'aorb.html';">I'm here to know this place</button>
    <button style="	margin-top:10px;
	background-color:#FF5B00;
	padding:5px;
	color:white;
	width:30%;
	text-align:center;
	font-size:18px;
	font-weight:bold;
	margin-bottom:20px;" onclick="window.location.href = 'aorb.html';">I'm here to describe this place</button>
  </div>
	<marquee id="project_name" direction="right" behavior="alternate" style="
	position: absolute;
  color: white;
  font-family: Georgia, sans-serif;
  font-size: 50px;
  letter-spacing: -2px;
  bottom:-380px;
  right:100px;
  left:100px;
  border-width: 0px;">
      Location Bag
    </marquee>
</body>
</html>