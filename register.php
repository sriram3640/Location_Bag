<?php
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		@keyframes slide-in {
  from {
    transform: translateX(-100%);
		color:greenyellow;
  }
  to {
    transform: translateX(0);
		color:gold;
  }
}
.animated-text {
  animation: slide-in 2s ease-out;
}
	body {
	  background: url("register_background_1.jpg") no-repeat center center fixed;
	  background-size: cover;
	  color: #fff;
	}
	#main-wrapper {
    max-width: 500px;
    margin: 200px auto 0;
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
		color:floralwhite;
}
	#heading {
	  max-width: 800px;
	  margin: 0 auto;
	  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
	  border-radius: 10px; /* Add rounded corners */
	  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
	  position: sticky;
	  top: 0;
	  z-index: 1;
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
		}
		
		.navbar-container img {
			width: 100px;
			padding: 10px;
		}
		
		.navbar-container h1 {
			font-size: 56px;
			text-align: center;
			color: #FFD700;
			flex-grow: 1;
			
		}
		
		.navbar-container a {
			text-decoration: none;
			color: white;
			margin-right: 20px;
			font-size: 18px;
			font-weight: bold;
			
		}
		a:hover {
			color: greenyellow;
		}
		.inputvalues {
		width: 430px;
		margin: 5px auto;
		padding: 5px;
		caret-color: red;
		background-color:gainsboro;
		border-radius: 5px;
		border: none;
		outline: none;
		font-size: 16px;
	}
	</style>
	<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imglink").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>
</head>
<body>
<div class="navbar-container">
		<img src="loc_4.jpg" alt="image-loading">
		<h1>LOCATION BAG</h1>
		<a href="register.php">REGISTRATION</a>
		<a href="index.php">LOGIN</a>
	</div>
	<div class="animated-text" id="main-wrapper">
	<form class="myform" action="register.php" method="post" enctype="multipart/form-data" >
		<center>
			<h2>User Registration</h2>
			<img id="uploadPreview" src="imgs/avatar.png" class="avatar"/><br>
			<input type="file" id="imglink" name="imglink" accept=".jpg,.jpeg,.png" onchange="PreviewImage();"/>
		</center>
		
			<label><b>Full Name:</b></label><br>
			<input name="fullname" type="text" class="inputvalues" placeholder="Type your Full Name" required/><br>
			<label><b>Username:</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
			<label><b>Email:</b></label><br>
			<input name="email" type="email" class="inputvalues" placeholder="Type your email" required/><br>
			<label><b>Password:</b></label><br>
			<input name="password" type="password" class="inputvalues" placeholder="Your password" required/><br>
			<label><b>Confirm Password:</b></label><br>
			<input name="cpassword" type="password" class="inputvalues" placeholder="Confirm password" required/><br>
			<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
			<a href="index.php"><input type="button" id="back_btn" value="Back To Login"/></a>
		</form>
		
		<?php
			if(isset($_POST['submit_btn']))
			{
				
				$fullname = $_POST['fullname'];
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$cpassword = $_POST['cpassword'];
				$pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
				
				$img_name = $_FILES['imglink']['name'];
				$img_size =$_FILES['imglink']['size'];
			    $img_tmp =$_FILES['imglink']['tmp_name'];
				
				$directory = 'uploads/';
				$target_file = $directory.$img_name;
				
				if($password==$cpassword)
				{
					
					$query= "select * from userinformation WHERE username='$username'";
					$query_run = mysqli_query($con,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						// there is already a user with the same username
						echo '<script type="text/javascript"> alert("User already exists.. try another username") </script>';
					}
					else if(file_exists($target_file))
					{
						echo '<script type="text/javascript"> alert("Image file already exists.. Try another image file") </script>';
					}
					else if($img_size>2097152)
					{
						echo '<script type="text/javascript"> alert("Image file size larger than 2 MB.. Try another image file") </script>';
					}
					else if(!preg_match($pattern, $email)){
						echo '<script type="text/javascript"> alert("give valid email") </script>';
					}
					else
					{
						move_uploaded_file($img_tmp,$target_file); 	
						$query= "insert into userinformation values('','$username','$password','$fullname', '$email', '$target_file')";
						$query_run = mysqli_query($con,$query);
						
						if($query_run) {
							echo '<script type="text/javascript"> alert("User Registered.. You will be redirected to the login page shortly.") </script>';
							header('refresh:2;url=index.php'); // Redirect after 5 seconds
							exit(); // Stop executing the script
						}
						else
						{
							echo '<script type="text/javascript"> alert("Error!") </script>';
						}
					}	
				}
				else
				{
					echo '<script type="text/javascript"> alert("Password and confirm password does not match!")</script>';	
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
  bottom:-400px;
  right:100px;
  left:100px;
  border-width: 0px;
	">
      Location Bag
    </marquee>
</body>
</html>