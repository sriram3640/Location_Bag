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
  background: url("index_background_1.jpg") no-repeat center center fixed;
  background-size: cover;
  color: 
	#fff;
}
#main-wrapper {
    max-width: 400px;
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
    max-width: 350px;
    margin: 0 auto;
}
h5{
	font-size: 18px;
}
.btn {
		margin: 5px auto;
		padding: 5px;
		color: #fff;
		width: 340px;
		text-align: center;
		font-size: 18px;
		font-weight: bold;
		border-radius: 5px;
		cursor: pointer;
		transition: background-color 0.3s ease-in-out;
	}

	#register_btn {
		background-color: #ff7f50; 
	}

	#forgot_btn {
		background-color: #2956B2;
	}

	#login_btn {
		background-color: #7DBD00;
	}


	.inputvalues {
		width: 330px;
		margin: 5px auto;
		padding: 5px;
		caret-color: red;
		border-radius: 5px;
		border: none;
		outline: none;
		font-size: 16px;
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
		@keyframes slide-in {
  from {
    transform: translateY(-100%);
		color:greenyellow;
  }
  to {
    transform: translateY(0);
		color:gold;
  }
}
@keyframes slide-in-out {
  from {
    transform: translateY(100%);
  }
  to {
    transform: translateY(0);
  }
}
@keyframes slide-in-out-m {
  from {
    transform: translateY(800%);
  }
  to {
    transform: translateY(0);
  }
}
.animated-text {
  animation: slide-in-out 2s ease-out;
}
.navbar-container {
  animation: slide-in 2s ease-out;
}
#toggle-btn {
  margin: 25px auto;
		padding: 5px;
		color: #fff;
		width: 340px;
		text-align: center;
		font-size: 18px;
		font-weight: bold;
		border-radius: 5px;
		cursor: pointer;
		background-color: red;
		border: 10px;
		animation: slide-in-out-m 2s ease-in-out;
}
#extra-content {
  padding: 20px;
	max-width: 90%;
  margin: 0 auto;
  background-color: rgba(0,0,0,0.5); 
  border-radius: 10px; 
  box-shadow: 0 0 10px rgba(0,0,0,0.5);
	text-align: left;
}


</style>
</head>
<body>
<center>
<div class="navbar-container">
		<img src="loc_4.jpg" alt="image-loading">
		<h1 class="animated-text">LOCATION BAG</h1>
		<a href="register.php">REGISTRATION</a>
		<a href="index.php">LOGIN</a>
	</div>
	<div class="animated-text" id="main-wrapper">
    <h2 style="color:black;">User Login</h2>
    <form class="myform" action="index.php" method="post">
        <label><b>Username:</b></label><br>
        <input name="username" type="text" class="inputvalues" placeholder="Type your username or email" required/><br>
        <label><b>Password:</b></label><br>
        <input name="password" type="password" class="inputvalues" placeholder="Type your password" required/><br>
        <input name="login" type="submit" class="btn" id="login_btn" value="Login"/><br>
        <a href="register.php"><input type="button" class="btn" id="register_btn" value="Register"/></a><br>
    </form>
		<?php
		if(isset($_POST['login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query = "SELECT * FROM userinformation WHERE (username='$username' OR email='$username') AND password='$password'";
			
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
	<button id="toggle-btn">Know about this website</button>
	<div id="extra-content" style="display:none;">
    <p>
        When you are in a famous place and want to describe about that place or when you are in a new place and feeling bore without any fun, our website provides details about famous locations in your city. 
        Our website LOCATION BAG works in the following way:
    </p>
    <ol>
        <li>After Login, You will decide to choose whether you want to describe that place or want to visit the places in that city.</li>
        <li>After deciding and selecting an option like you want to describe, you will be opened with a page, click on get my location button to see the current located city and enter it same in the first option i.e. city name.
            But if you want to enter about some other place which you are not there at present, you can enter that city name too!.</li>
        <li>After deciding and selecting an option like you want to know the nearby best places in the home page, you will be redirected to a new page which shows the button show places near me, click on that button to see the nearby location in that city.
            If you want to plan the journey before entering there you can find the required locational details by searching the city name with correct spelling in the search bar.
            If after getting all the locations in the city if you want to select the genre of the location you can select that option too by searching in the search bar.</li>
        <li>You can also look at your posts in the my posts section with number of likes you got for each post.</li>
        <li>You can plan your joy with this website.</li>
    </ol>
</div>

<script>
// Get the button and the extra content
const toggleBtn = document.getElementById('toggle-btn');
const extraContent = document.getElementById('extra-content');

// Set the initial state of the extra content to hidden
extraContent.style.display = 'none';

// Add a click event listener to the button
toggleBtn.addEventListener('click', function() {
  // If the extra content is hidden, show it
  if (extraContent.style.display === 'none') {
    extraContent.style.display = 'block';
    toggleBtn.textContent = 'Hide about this website';
  } else {
    // If the extra content is visible, hide it
    extraContent.style.display = 'none';
    toggleBtn.textContent = 'Show about this website';
  }
});
</script>



	<marquee id="project_name" direction="right" behavior="alternate"
	style="
	position: absolute;
  color: white;
  font-family: Georgia, sans-serif;
  font-size: 50px;
  letter-spacing: -2px;
	padding:20px;
  bottom:-450px;
  right:100px;
  left:100px;
  border-width: 0px;
	">
      Location Bag
    </marquee>
</body>
</html>