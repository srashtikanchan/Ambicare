<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['client'])) {
?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="fontawesome-free-5.13.0-web/css/all.min.css" rel="stylesheet">
        <link href="css/aA.css" rel="stylesheet" type="text/css">
        <title>Ambicare</title>
    </head>

    <body>
        <div class="main_container">
            <div class="header_a_container">
                <h1 class='header_a'>Available Ambulance</h1>
                <p class="mail"><i class="fa fa-user" aria-hidden="true"></i><?php echo $_SESSION['client']; ?></p>
                <a href="logOut.php" class="log_out">Logout</a>
            </div>
            <div class="container_control">
                <?php
                require("config/config.php");
                if ($conn) {
                    $query = "SELECT * FROM driver AS d_s INNER JOIN ambulance as a_ce ON d_s.id = a_ce.did;";
                    $records = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($records);
                    $startTable = "<table border='0'><thead><tr><th>Sr No</th><th>Drivers</th><th>Ambulance Number</th><th>Fees</th><th>Select</th></tr></thead><tbody>";
                    $endTable = "</tbody></table>";
                    if ($count > 0) {
                        echo $startTable;
                        $srno = 0;
                        while ($dRow = mysqli_fetch_assoc($records)) {
                            $srno++;
                            echo "<tr><td>{$srno}</td><td>{$dRow['name']}</td><td>{$dRow['ambulanceNumber']}</td><td>₹ {$dRow['Fees']}</td><td><a href='checkout.php?did={$dRow['id']}&ambulanceNo={$dRow['ambulanceNumber']}&clientEmail={$_SESSION['client']}&Fees={$dRow['Fees']}'><i class='fa fa-check' aria-hidden='true'></i> Book</a></td></tr>";
                        }
                        echo $endTable;
                    }
                }
                ?>
            </div>
        </div>
    </body>

</html>
<?php
} else {
    header("location: clientLogin.php");
}
?>