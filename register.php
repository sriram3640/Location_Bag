<?php
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
	body {
	  background: url("https://cdn.pixabay.com/photo/2016/03/18/15/02/ufo-1265186__480.jpg") no-repeat center center fixed;
	  background-size: cover;
	  color: #fff;
	}
	#main-wrapper {
	  max-width: 750px;
	  margin: 0 auto;
	  padding: 20px;
	  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
	  border-radius: 10px; /* Add rounded corners */
	  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
	}
	#heading {
	  max-width: 800px;
	  margin: 0 auto;
	  background-color: rgba(0,0,0,0.5); /* Add a semi-transparent black background */
	  border-radius: 10px; /* Add rounded corners */
	  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Add a drop shadow */
	}
	.inputvalues{
	width:730px;
	margin:5px auto;
	padding:5px;
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
<body bgcolor="#191919">
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
<h5 align="right" style="color:white">
		<a href="index.php" style="text-decoration:none; color:white"> HOME </a> &nbsp; | &nbsp; 
		<a href="register.php" style="text-decoration:none; color:white"> REGISTRATION </a> &nbsp; | &nbsp; 
		<a href="index.php" style="text-decoration:none; color:white"> LOGIN </a> &nbsp;
	</h5>
	<div id="main-wrapper">
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
</body>
</html>