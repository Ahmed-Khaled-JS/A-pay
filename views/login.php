<?php
session_start();
if(isset($_SESSION["user_role"])){
    if($_SESSION["user_role"] == "1"){
        header("Location: index.php");
    }else{
        header("Location: admin.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <title>Loin</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<?php 
   $logedin = 0;
   include "./components/header.php";
?>
<?php
 require_once '../models/user.php';
 require_once '../controllers/Authcontroller.php';
 $errormsg = '';
 if(isset($_POST['phone']) && isset($_POST['password_input'])){
    if(!empty($_POST['phone']) && !empty($_POST['password_input'])){
        $user = new user;
        $auth = new Auth;
        $user->phone = $_POST['phone'];
        $user->password = $_POST['password_input'];
        if($auth->login($user)){
            if($_SESSION["user_role"]=="1"){
                header("location: index.php");
            }else if($_SESSION["user_role"]=="2")
            {
                header("location: admin.php");
            }
        }else{
            $errormsg = '1';
        }
        
    }
 }
 ?>

	<div class="container sizeofcontainer">
            <h2 class="text-center" style="margin-top: 20px;">Login to A-Pay</h2>
            <p class="text-center text-secondary">create it,active it & Transfer Instant Money</p>
            <?php if ($errormsg): ?>
            
            <div class="alert alert-danger">
                <strong>Wrong</strong> phone number or password wrong. Please try again
            </div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">phone:</label>
                    <div class="input-group">
                        <span class="input-group-text">+20</span>
                        <input type="text" class="form-control" name="phone" placeholder="phoneNumber">
                    </div>
                </div>
                <div class="mb-3">
                   <div class="input-group">
                        <input type="password" class="form-control" id="password_input" name="password_input" placeholder="Password">
                        <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" id="show_hide_password_button">
                                <i class="fa fa-eye-slash" id="show_hide_password_icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-check mb-3 d-flex justify-content-between">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#">Forget password?</a>
                </div>
                
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
    
    </div>

    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
		$(document).ready(function() {
			$("#show_hide_password_button").click(function() {
				if ($("#password_input").attr("type") == "password") {
					$("#password_input").attr("type", "text");
					$("#show_hide_password_icon").removeClass("fa-eye-slash");
					$("#show_hide_password_icon").addClass("fa-eye");
				} else {
					$("#password_input").attr("type", "password");
					$("#show_hide_password_icon").removeClass("fa-eye");
					$("#show_hide_password_icon").addClass("fa-eye-slash");
				}
			});
		});
	</script>
</body>
</html>

