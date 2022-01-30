<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['client'])) {
    $did = $_GET['did'];
    $ambulanceNumber = $_GET['ambulanceNo'];
    $clientEmail = $_GET['clientEmail'];
    $fees = $_GET['Fees'];
    $finalPrice = 0;
    require("config/config.php");
    $query = "select * from client where email = '$clientEmail';";
    $records = mysqli_query($conn,$query);
    $count = mysqli_num_rows($records);
    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($records)) {
        $cid = $row['id'];
      }
    }
?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/checkout.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Ambicare</title>
    </head>

<div class="row">
  <div class="col-50">
    <div class="container">
      <form method="POST">
      
        <div class="inner_row">
        
          <div class="col-50">
             <p>Fees<span class="price">₹ <?php echo $fees; ?></span></p>
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardName" placeholder="John More Doe"  required>
            <label for="ccnum">Credit card number</label>
            <input type="text" pattenrn="text" id="ccnum" name="cardNumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expMonth" placeholder="September" required>
            <div class="inner_row2">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expYear" placeholder="2018" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
          
        </div>
       
        <input type="submit" name="action" value="Continue to checkout" class="btn">
      </form>
      <?php
        if (isset($_POST['action'])) {
            require("config/config.php");
            $cardName = $_POST['cardName'];
            $cardNumber = $_POST['cardNumber'];
            $expMonth = $_POST['expMonth'];
            $expYear = $_POST['expYear'];
            $cvv = $_POST['cvv'];
            $cQuery = "insert into checkout(cid,cardName,cardNumber,expMonth,expYear,cvv,Fees) values('$cid','$cardName','$cardNumber','$expMonth','$expYear','$cvv','$fees');";
            $cRecords = mysqli_query($conn, $cQuery);
            if ($cRecords > 0) {
                header("location: book.php?did={$did}&ambulanceNo={$ambulanceNumber}&clientEmail={$clientEmail}&Fees={$fees}");
            } else {
                echo "There is some problem, Please try again after some time!";
            }
        }
      ?>
    </div>
  </div>
  
</div>

</html>
<?php
} else {
    header("location: clientLogin.php");
}
?>