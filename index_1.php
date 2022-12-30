<?php

session_start();
require "Authenticator.php";


    $Authenticator = new Authenticator();
    if (!isset($_SESSION['auth_secret'])) {
        $secret = $Authenticator->generateRandomSecret();
        $_SESSION['auth_secret'] = $secret;
    }
    $qrCodeUrl = $Authenticator->getQR('myPHPnotes', $_SESSION['auth_secret']);


    if (!isset($_SESSION['failed'])) {
        $_SESSION['failed'] = false;
    }
    
    
    $_SESSION='unset';
    header("refresh:10,url=index_1.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="check.php" method="post">
    <input type="text" class="form-control" name="code" placeholder="******" style="font-size: xx-large;width: 200px;border-radius: 0px;text-align: center;display: inline;color: #0275d8;"><br> <br>    
 <button type="submit" class="btn btn-md btn-primary" style="width: 200px;border-radius: 0px;">Verify</button>
    <?php if ($_SESSION['failed']): ?>
                                 <div class="alert alert-danger" role="alert">
                                            <strong>Oh snap!</strong> Invalid Code.
                                </div>
                                <?php   
                                    $_SESSION['failed'] = false;
                                ?>
    <?php endif ?>
    </form>
</body>
</html>
