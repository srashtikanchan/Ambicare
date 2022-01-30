<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['client'])) {
     header("location: location_Map.php");
} elseif (isset($_SESSION['driver'])) {
     header("location: driver/driverPanel.php");
}
?>

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="css/style.css" rel="stylesheet" type="text/css">
     <title>Ambicare</title>
</head>

<body>
     <div class="heading">
          <h1>Ambicare</h1>
     </div>
     <div class="main">
          <div class="users_rl">
               <img src="img/ambulance.png">
               <p>Users</p>
               <div class="btns">
                    <a href="clientRegister.php">REGISTER</a>
                    <a href="clientLogin.php">LOGIN</a>
               </div>
          </div>
          <div class="drivers_rl">
               <img src="img/ambulance.png">
               <p>Drivers</p>
               <div class="btns">
                    <a href="driver/driverRegister.php">REGISTER</a>
                    <a href="driver/driverLogin.php">LOGIN</a>
               </div>
          </div>

     </div>
     <div class="adminLogin_container">
          <a href="admin/adminLogin.php">Admin Login</a>
     </div>
</body>

</html>