<?php
session_start();
?>
<!DOCTYPE html>
<?php
if (isset($_SESSION['client'])) {
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css//bookingMessage.css" rel="stylesheet" type="text/css">
        <title>Ambicare</title>
    </head>

    <body>
        <div class="heading">
            <h2><a style="text-decoration: none;" href="location_Map.php">Ambicare</a></h2>
            <a class="log_out" href="logOut.php">Logout</a>
        </div>
        <div class="main_container_M">
            <div class="control_container_M">
                <h1>Your Booking is Confirmed.</h1>
            </div>
        </div>
    </body>

    </html>

<?php
} else {
    header("location: clientLogin.php");
}
?>