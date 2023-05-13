<?php
session_start();
if(isset($_SESSION["user_role"]) && $_SESSION["user_active"] == "active"){
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
    <title>active</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<?php
 require_once '../models/user.php';
 require_once '../controllers/Authcontroller.php';
 $errormsg = '';
 if(isset($_POST['pass'])){
    if(!empty($_POST['pass'])){
        if($_POST['pass'] === $_SESSION['pass-active']){
            $_SESSION['user_active'] = "active";
        }else{
            $errormsg = "2";
        }
        
    }
 }
 ?>
<div class="container sizeofcontainer">
            <?php if ($errormsg == "2"): ?>
            
            <div class="alert alert-danger">
                <strong>Wrong</strong> phone number or password wrong. Please try again
            </div>
            <?php endif; ?>
            <form action="active.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Enter 4 digit sent on mail:</label>
                    <div class="input-group">
                        <span class="input-group-text">#</span>
                        <input type="text" class="form-control" name="pass" placeholder="enter 4 digit">
                    </div>
                </div>
                
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">enter</button>
                </div>
            </form>
    
    </div>

    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>