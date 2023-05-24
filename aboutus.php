<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
	<style>
		/* Flip card effect CSS */
    body {
  background: url("https://cdn.pixabay.com/photo/2018/02/24/17/57/nature-3178760__480.jpg") no-repeat center center fixed;
  background-size: cover;
  font-family: Arial, sans-serif;
  color:black;
}
		.flip-card {
			background-color: transparent;
			width: 300px;
			height: 400px;
			perspective: 1000px;
			margin: 10px 100px 10px 100px;
			display: inline-block;
		}

		.flip-card-inner {
			position: relative;
			width: 100%;
			height: 100%;
			text-align: center;
			transition: transform 0.6s;
			transform-style: preserve-3d;
		}

		.flip-card:hover .flip-card-inner {
			transform: rotateY(180deg);
		}

		.flip-card-front, .flip-card-back {
			position: absolute;
			width: 100%;
			height: 100%;
			backface-visibility: hidden;
		}

		.flip-card-front {
			color: black;
		}

		.flip-card-back {
			background-color:#5597b1;
			color: black;
			transform: rotateY(180deg);
			padding: 10px;
			text-align: center;
		}
		.card-container {
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
			margin: 50px;
		}
    a {
  color:white;
  font-size: 20px; 
  position: absolute;
  top: 80px;
  right: 20px;
  text-decoration: none;
  border:solid white 2px;
  padding:5px;
}
#ss{
	color:white;
  font-size: 20px; 
  position: absolute;
  top: 120px;
  right: 20px;
  text-decoration: none;
  border:solid white 2px;
  padding:5px;
}
a:hover{
  background-color: lightgreen;
  color:black;
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
    transform: translateY(500%);
  }
  to {
    transform: translateY(0);
  }
}
h1 {
  animation: slide-in-out 2s ease-out;
}
.card-container {
  animation: slide-in 2s ease-out;
}
a {
  animation: slide-in-out 2s ease-out;
}
	</style>
</head>
<body>
  <center>
  <h1 style="color:white; font-family: Verdana, sans-serif;">ABOUT US</h1>
  </center>
  <b><a href="homepage.php">BACK TO HOME</a></b>
<div class="card-container">
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front">
					<img src="us1.jpg" alt="Person 1" style="width:280px;height:240px;padding:10px;">
          <h2 style="color:white">Sriram Surisetti</h2>
				</div>
				<div class="flip-card-back">
					<h2>Sriram Surisetti</h2>
					<h3>student of NIT Andhra Pradesh</h3>
          <h3><span>&#128222;</span>7989117576</h3>
          <h3><span>&#64;</span>sriramsurisetti3412@gmail.com</h3>

				</div>
			</div>
		</div>
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front">
					<img src="che.jpeg" alt="Person 2" style="width:280px;height:240px;padding:10px;">
          <h2 style="color:white">Sushma Onapakala</h2>
				</div>
				<div class="flip-card-back">
					<h2>Sushma Onapakala</h2>
					<h3>student of NIT Andhra Pradesh</h3>
          <h3><span>&#128222;</span>8074138452</h3>
          <h3><span>&#64;</span>sushma123@gmail.com</h3>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
