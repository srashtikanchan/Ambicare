<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['client'])) {
    header("location: location_Map.php");
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
                <p class="rl_Title">Login</p>
                <form class="inner_form" method="POST">
                    <label class="label_control" for="Email">Email ID</label>
                    <input id="Email" class="input_control" type="text" name="email" placeholder="Enter Email ID"></input>
                    <label class="label_control" for="Password">Password</label>
                    <input id="Password" class="input_control" type="password" name="pwd" placeholder="Enter Password"></input>
                    <button class="btn_r" type="submit" name="action">LOGIN</button>
                </form>
                <p class="login">New here | <a class="login_a" href="clientRegister.php">Register</a></p>
                <?php
                if (isset($_POST["action"])) {
                    require("config/config.php");
                    $email = $_POST["email"];
                    $password = $_POST["pwd"];
                    $query = "select * from client where email='$email' and password='$password';";
                    $records = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($records);
                    if ($count > 0) {
                        $_SESSION['client'] = $email;
                ?>
                        <script type="text/javascript">
                            window.location.assign("location_Map.php");
                        </script>
            <?php
                    } else {
                        echo "<p class='alert'>Invalid credentials, Please try again</p>";
                    }
                }
            }
            ?>
            </div>
        </div>
    </body>

</html>