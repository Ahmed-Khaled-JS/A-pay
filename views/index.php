<?php
session_start();
if(!isset($_SESSION["user_role"])){
    header("Location: login.php");
}else if($_SESSION["user_role"] == "2"){
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <link rel="stylesheet" href="./css/index.css">
    <title>Document</title>
    
</head>
<body>
<?php 
   $logedin = 1;
   include_once "./components/header.php";
   require_once '../models/user.php';
   require_once "../controllers/usercontroller.php";
   $usercontroller = new usercontroller;
   $user = new user;
   $accounts = $usercontroller->getaccounts();
   
?>
    <div class="main-layout d-flex flex-wrap">
        <div class="glassey">
            <i class="fa-solid fa-arrow-up-long sendr"></i>
            <p>Send</p>
            <p class="desc-p">now you can send instant money 24/7</p>
        </div>
        <div class="glassey">
            <i class="fa-solid fa-arrow-up-long reciver"></i>
            <p>receive</p>
            <p class="desc-p">now you can receive/collect instant money 24/7</p>
        </div>
        <div class="glassey">
            <i class="fa-solid fa-coins"></i>
            <p>check balance</p>
            <p class="desc-p">now you can check balance with click</p>
        </div>
    </div>
    <div class="container">
        <?php 
            include "./components/main_bank.php";
            require_once "./components/card_opition.php";
            if($accounts){
                bankcard($accounts[0]);
            }
        ?>
    </div>
    <div class="container d-flex flex-wrap justify-content-between container-fluid p-3">
         <?php 
            card_opoition("send", "fa-solid", "fa-arrow-up-long", "sendr","send.php");
            card_opoition("collect", "fa-solid", "fa-arrow-up-long", "reciver","collect.php");
            card_opoition("Manage account", "fa-solid", "fa-landmark", " general_i","manageaccounts.php");
            card_opoition("transactions History", "fa-solid", "fa-arrow-right-arrow-left", " transrotate ","transactions_History.php");
            card_opoition("pending requet", "fa-solid", "fa-arrow-up-long", "reciver","request.php");
            // card_opoition("manage favorite", "fa-solid", "fa-star", "general_i","goto");
        ?>
    </div>
    


    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>