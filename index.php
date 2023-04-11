<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
	body {
  background: url("https://cdn.pixabay.com/photo/2018/06/16/16/17/road-3478977__480.jpg") no-repeat center center fixed;
  background-size: cover;
  color: 
	#fff;
}
#main-wrapper {
  max-width: 550px;
  margin: 0 auto;
  padding: 20px;
  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
  border-radius: 10px; /* Add rounded corners */
  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
}
#heading {
  max-width: 550px;
  margin: 0 auto;
  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
  border-radius: 10px; /* Add rounded corners */
  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
}
h5{
	font-size: 18px;
}
#register_btn{
	margin:5px auto;
	background-color:#bd0000;
	padding:5px;
	color:white;
	width:540px;
	text-align:center;
	font-size:18px;
	font-weight:bold;
}

#forgot_btn{
	margin:5px auto;
	background-color:#2956B2;
	padding:5px;
	color:white;
	width:540px;
	text-align:center;
	font-size:18px;
	font-weight:bold;
}

#login_btn{
	margin:5px auto;
	background-color:#7DBD00;
	padding:5px;
	color:white;
	width:540px;
	text-align:center;
	font-size:18px;
	font-weight:bold;
}

.inputvalues{
	width:530px;
	margin:5px auto;
	padding:5px;
}
</style>
</head>
<body>
<center>
	<div style=" display: flex;
  flex-wrap: none;
  justify-content: none;
	width:800px; ">
<img style="width:100px; padding:10px;"src="loc_4.jpg" alt="image-loading">
<div id="heading">
	<h1 style="font-size:56px; text-align:center; color:white">&nbsp;LOCATION BAG</h1>
</div>
<img style="width:100px; padding:10px;"src="loc_4.jpg" alt="image-loading">
	</div>	
	</center>
	<h5 align="right" style="color:white;">
		<a href="index.php" style="text-decoration:none; color:white"> HOME </a> &nbsp; | &nbsp; 
		<a href="register.php" style="text-decoration:none; color:white"> REGISTRATION </a> &nbsp; | &nbsp; 
		<a href="index.php" style="text-decoration:none; color:white"> LOGIN </a> &nbsp;
	</h5>
	<div id="main-wrapper">
		<center>
			<h2>User Login</h2>
			<img src="imgs/avatar.png" class="avatar"/>
		</center>
	
		<form class="myform" action="index.php" method="post">
			<label><b>Username:</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
			<label><b>Password:</b></label><br>
			<input name="password" type="password" class="inputvalues" placeholder="Type your password" required/><br>
			<input name="login" type="submit" id="login_btn" value="Login"/><br>
			<a href="register.php"><input type="button" id="register_btn" value="Register"/></a><br>
		  <a href="forgot.php"><input type="button" id="forgot_btn" value="Forgot Password"/></a>
		</form>
		<?php
		if(isset($_POST['login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query="select * from userinformation WHERE username='$username' AND password='$password'";
			
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				$row = mysqli_fetch_assoc($query_run);
				// valid
				$_SESSION['username']= $row['username'];
				$_SESSION['imglink']= $row['imglink'];
				header('location:homepage.php');
			}
			else
			{
				// invalid
				echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
			}
			
		}
		
		
		?>
		
	</div>
	<marquee id="project_name" direction="right" behavior="alternate"
	style="
	position: absolute;
  color: white;
  font-family: Georgia, sans-serif;
  font-size: 50px;
  letter-spacing: -2px;
	padding:20px;
  bottom:-280px;
  right:100px;
  left:100px;
  border-width: 0px;
	">
      Location Bag
    </marquee>
</body>
</html>