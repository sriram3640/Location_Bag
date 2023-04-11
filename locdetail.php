<!DOCTYPE html>
<html>
<head>
  <title>Enter location details</title>
  <style>
    /* Global styles */
body {
  background: url("https://cdn.pixabay.com/photo/2018/09/03/23/56/sea-3652697__480.jpg") no-repeat center center fixed;
  background-size: cover;
  font-family: "Raleway", sans-serif;
  color: whitesmoke;
}

#main-wrapper {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
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
  width: 100%;
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

    function PreviewImage(number) {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("imglink" + number).files[0]);

      oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview" + number).src = oFREvent.target.result;
      }
    };
  </script>
</head>
<body onload="getLocation()" bgcolor="#191919">
  <div id="location" style=
    "position:absolute;
     top:50px;
     right:50px;
     font-size:30px;
     color:white;"></div>
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
  $query = "insert into location values('','$cityname','$locationname','$message','$locationtype','$imglink1','$imglink2','$imglink3','0')";
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
