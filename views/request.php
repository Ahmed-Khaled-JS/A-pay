<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
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
    require_once "../models/request.php";
    require_once "../controllers/request.php";
    require_once "../controllers/usercontroller.php";
    $usercontroller = new usercontroller;
    $accounts = $usercontroller->getaccounts();
    $requstfunc = new requestcon;
    $requests = $requstfunc->get_requests($_SESSION['user_id']);
    $errormsg = '';
    if(isset($_POST['phone']) && isset($_POST['amount'])){
        if(!empty($_POST['phone']) && !empty($_POST['amount'])){
            $request = new REQUEST;
            $request->rec_phone = $_POST['phone'];
            $request->amount = $_POST['amount'];
            $result = $requstfunc->getDetailsByphone($_POST['phone']);
            $request->rec_id = $result[0]["id"];
            $request->sender_id = $_SESSION['user_id'];
            if($requstfunc->sendrequest($request)){
                $errormsg = '2';
            }
        }
    }
    ?>
    <div class="container"  style="width:40%;">
        <div>
            <form action="request.php" method="POST">
            <?php if ($errormsg == '2'): ?>    
                <div class="alert alert-success">
                    <strong>Success!</strong> Request Sent.
                </div>
            <?php endif; ?>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Phone:</label>
                    <div class="input-group">
                        <input type="text" name="phone" class="form-control" placeholder="phone">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Amount:</label>
                    <div class="input-group">
                        <input type="text" name="amount" class="form-control" placeholder="amount">
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" value="Send">
                
           

            </form>
        </div>
        <?php
            foreach ($requests as $requesto){
                echo '<div class="card margin-crads" style="margin:20px;">
                    <div class="card-header">
                        pendding request
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">From '.$requesto["firstName"]. $requesto["lastName"].'</h5>
                        <p class="card-text">Amount : '.$requesto["amount"].'</p>
                        <div class="">
                        <form method="post" action="replayrequest.php">
                        <div class="form-group">
                            <label for="inputField">Choose IBAN:</label>
                            <select class="form-control" name="bank" id="inputField">
                            ';
                            foreach ($accounts as $key) {
                                echo '<option value="'.$key["iban"].'">'.$key["iban"].'</option>';
                            }
                            echo'

                            </select>
                            </div>
                            <input type="hidden" class="form-control" id="hiddenInput" value="1" name="replay">
                            <input type="hidden" class="form-control" id="hiddenInput" value="'.$requesto["amount"].'" name="amount">
                            <input type="hidden" class="form-control" id="hiddenInput" value="'.$requesto["hamada"].'" name="replay_id">
                            <button type="submit" class="btn btn-primary">
                                Agree
                            </button>
                        </form>
                        <form method="post" action="replayrequest.php">
                            <input type="hidden" class="form-control" id="hiddenInput" value="2" name="replay">
                            <input type="hidden" class="form-control" id="hiddenInput" value="'.$requesto["hamada"].'" name="replay_id">
                            <button type="submit" class="btn btn-danger">
                                reject
                            </button>
                        </form>
                        </div>
                        
                        
                    </div>
                </div>';
            }
        ?>

        
    </div>
    
      
    
    
    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>