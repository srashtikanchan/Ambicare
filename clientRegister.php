<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['client'])) {
    header("Location:location_Map.php");
} else {
?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ambicare</title>
        <link href="css/reg_log.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="main_form">
            <img src="img/ambulance.png" alt="Ambulance icon">
            <div class="outside_Form">
                <p class="rl_Title">Register</p>
                <form class="inner_form" method="POST">
                    <label class="label_control" for="Name">Name</label>
                    <input id="Name" class="input_control" type="text" name="name" placeholder="Enter Name"></input>
                    <label class="label_control" for="Contact">Contact</label>
                    <input id="Contact" class="input_control" type="tel" name="contact" placeholder="Enter Contact"></input>
                    <label class="label_control" for="Email">Email ID</label>
                    <input id="Email" class="input_control" type="email" name="email" placeholder="Enter Email ID"></input>
                    <label class="label_control" for="Password">Password</label>
                    <input id="Password" class="input_control" type="password" name="password" placeholder="Enter Password"></input>

                    <button class="btn_r" type="submit" name="action">REGISTER</button>
                </form>
                <p class="login">Already have an account | <a class="login_a" href="clientLogin.php">Login</a></p>
                <?php
                if (isset($_POST['action'])) {
                    require("config/config.php");
                    $name = $_POST['name'];
                    $contact = $_POST['contact'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $cQuery = "select * from client where email='$email';";
                    $cAffectedRows = mysqli_query($conn, $cQuery);
                    $cRecords = mysqli_num_rows($cAffectedRows);
                    if ($cRecords > 0) {
                        echo "<p class='c_Email'>This email ID is already registered</p>";
                    } else {
                        $query = "insert into client(name,contact,email,password)values('$name','$contact', '$email', '$password');";
                        $affectedRows = mysqli_query($conn, $query);
                        mysqli_close($conn);
                        if ($affectedRows > 0) {
                            $_SESSION['client'] = $email; ?>
                            <script type="text/javascript">
                                window.location.assign("location_Map.php");
                            </script>
            <?php } else {
                            echo "Unable to Signup, Try after some time..." . mysqli_error($conn);
                        }
                    }
                }
            } ?>
            </div>
        </div>
    </body>

</html>