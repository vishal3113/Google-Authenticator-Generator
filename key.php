<?php
session_start();
require "Authenticator.php";


$Authenticator = new Authenticator();
// if (!isset($_SESSION['auth_secret'])) {
//     $secret = $Authenticator->generateRandomSecret();
//     $_SESSION['auth_secret'] = $secret;
// }


$qrCodeUrl = $Authenticator->getQR('ClickMinting', $_SESSION['auth_secret']);


// if (!isset($_SESSION['failed'])) {
//     $_SESSION['failed'] = false;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Time-Based Authentication like Google Authenticator</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <meta name="description" content="Implement Google like Time-Based Authentication into your existing PHP application. And learn How to Build it? How it Works? and Why is it Necessary these days."/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel='shortcut icon' href='/favicon.ico'  />
    <style>
        body,html {
            height: 100%;
        }       


        .bg { 
            /* The image used */
            background-image: url("images/bg.jpg");
            /* Full height */
            height: 100%; 
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
           
            background-size: cover;
        }
    </style>
</head>
<body  class="bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3"  style="background: white; padding: 60px; border-radius:20px; border:1px solid black; margin-top: 55  px;">
                <h1 style="text-align:center;">Google Authenticator</h1>
                <p style="text-align:center;">Make a Backup of this key For Future Use</p>
                <hr>
                <form action="check.php" method="post">
                    <div style="text-align: center;">
                        <?php if ($_SESSION['failed']): ?>
                            <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> Invalid Code.
                            </div>
                            <?php   
                                $_SESSION['failed'] = false;
                            ?>
                        <?php endif ?>
                            
                            <img style="text-align: center;;" class="img-fluid" src="<?php   echo $qrCodeUrl ?>" alt="Verify this Google Authenticator"><br><br>        
                            <!-- <input type="text" class="form-control" name="code" placeholder="******" style="font-size: xx-large;width: 200px;border-radius: 0px;text-align: center;display: inline;color: #0275d8;"><br> <br>    
                            <button type="submit" class="btn btn-md btn-primary" style="width: 200px;border-radius: 0px;">Verify</button> -->
                            <div>Scan The Code in Google Authenticator</div>
                            <br>
                            <button style=" color:black; padding:5px; border-radius:5px; width:100px;" href="index_1.php">I Confirm</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>