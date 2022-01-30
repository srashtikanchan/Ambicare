<?php
$did = $_GET['did'];
$ambulanceNumber = $_GET['ambulanceNo'];
$clientEmail = $_GET['clientEmail'];
$fees = $_GET['Fees'];
require('config/config.php');
if ($conn) {
    $cQuery = "select * from client where email='$clientEmail';";
    $cRecords = mysqli_query($conn, $cQuery);
    $cCount = mysqli_num_rows($cRecords);
    if ($cCount > 0) {
        while ($cRow = mysqli_fetch_assoc($cRecords)) {
            $cid = $cRow['id'];
        }
    }
    $lQuery = "select * from p_d_location as pdl inner join client as c_ent on pdl.cid = c_ent.id where email = '$clientEmail';";
    $lRecords = mysqli_query($conn, $lQuery);
    $lCount = mysqli_num_rows($lRecords);
    if ($lCount > 0) {
        while ($lRow = mysqli_fetch_assoc($lRecords)) {
            $pickupL = $lRow['pickupL'];
            $dropL = $lRow['dropL'];
        }
    }
    $bQuery = "insert into bookings (cid,did,ambulanceNumber,pickupL,dropL,Fees) values('$cid','$did','$ambulanceNumber','$pickupL','$dropL','$fees');";
    $bRecords = mysqli_query($conn, $bQuery);
    if ($bRecords > 0) { 
       header("location: bookingConfirmedMessage.php");
    } else {
        echo "There is some problem, Please try again!"; 
    }
}
