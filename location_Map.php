<?php
session_start();
?>
<!DOCTYPE html>
<?php
if (isset($_SESSION['client'])) {
  require("config/config.php");
  $cemail = $_SESSION['client'];
  $cquery = "select * from client where email = '$cemail';";
  $records = mysqli_query($conn, $cquery);
  while ($cRow = mysqli_fetch_assoc($records)) {
    $cid = $cRow['id'];
  }
?>

  <head>
    <title>Ambicare</title>
    <link href="css/map.css" rel="stylesheet" type="text/css">
    <link href="fontawesome-free-5.13.0-web/css/all.min.css" rel="stylesheet">

  </head>

  <body>
    <div class="heading">
      <h2><a style="text-decoration: none;" href="location_Map.php">Ambicare</a></h2>
      <p class="mail"><i class="fa fa-user" aria-hidden="true"></i><?php echo $cemail; ?></p><a class="log_out" href="logOut.php">Logout</a>
    </div>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCR6Sa2LHVbsSCLvQIGoo8JdaUpme-zq8w"></script>
    <script type="text/javascript">
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(p) {
          var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
          var mapOptions = {
            center: LatLng,
            zoom: 16,
          };
          var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
          var marker = new google.maps.Marker({
            position: LatLng,
            map: map,
            title: "<div style = 'height:100vh;width:100vw'><b>Your location:</b><br />Latitude: " + p.coords.latitude + "<br />Longitude: " + p.coords.longitude
          });
          google.maps.event.addListener(marker, "click", function(e) {
            var infoWindow = new google.maps.InfoWindow();
            infoWindow.setContent(marker.title);
            infoWindow.open(map, marker);
          });
        });
      } else {
        alert('Geo Location feature is not supported in this browser.');
      }
    </script>
    <div class="mainMapContainer">
      <div class="mapContainer">
        <div id="dvMap" class="map_c">
        </div>
      </div>
    </div>
    <div class="puL_dL">
      <form method="Post">
        <label class="lc" for="pickupL">Pickup Location</label>
        <input class="ic pickupL_C" id="pickupL" type="text" name="pickupLocation" placeholder="Enter Pickup Location" required>
        <span class="dashed_l">---- ---- ---- ----</span>
        <label class="lc" for="dropL">Drop Location</label>
        <input class="ic dropL_C" id="dropL" type="text" name="dropLocation" placeholder="Enter Drop Location" required>
        <button class="b_Now" type="submit" name="action">Book Now</button>
      </form>
      <?php
      if (isset($_POST['action'])) {
        require("config/config.php");
        $pickupLocation = $_POST['pickupLocation'];
        $dropLocation = $_POST['dropLocation'];
        $query = "insert into p_d_location(cid, pickupL, dropL) values('$cid','$pickupLocation','$dropLocation');";
        $affectedRows = mysqli_query($conn, $query);
        if ($affectedRows > 0) { ?>
          <script type="text/javascript">
            window.location.assign("availableAmbulance.php");
          </script>
      <?php } else {
          echo "Unable to submit location, Please try again..." . mysqli_error($conn);
        }
      }
      ?>
    </div>
  </body>

  </html>
<?php
} else {
  header("location: clientlogin.php");
}
?>