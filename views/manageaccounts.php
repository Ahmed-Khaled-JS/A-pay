<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<?php
    require_once "../controllers/bankcontroller.php";
    require_once "../models/account.php";
    require_once "../controllers/usercontroller.php";
    $bankcon = new bankcontroller;
    $result = $bankcon->getbanks();
    $errormsg = '';
    $usercontroller = new usercontroller;
    if(isset($_POST['iban']) && isset($_POST['bank'])){
    if(!empty($_POST['iban']) && !empty($_POST['bank'])){
        $account = new account;
        $account->iban = $_POST['iban'];
        $account->bank_id = $_POST['bank'];
        session_start();
        $account->user_id = $_SESSION['user_id'];
        if($usercontroller->addaccount($account)){
            
        }else{
            $errormsg = '1';
        }
        
    }
    }
    
?>
<?php 
   $logedin = 1;
   include_once "./components/header.php";
   require_once "../views/components/main_bank.php";
   $accounts = $usercontroller->getaccounts();
   foreach ($accounts as $key) {
    bankcard($key);
   }
   
   
?>

<!-- Button to trigger the modal -->
<center>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Add account
</button>
</center>


<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add account</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        
        <form method="post" action="manageaccounts.php">
            <div class="form-group">
                <label for="inputField">Choose Bank:</label>
                <select class="form-control" name="bank" id="inputField">
                  <?php
                    foreach ($result as $key) {
                     echo '<option value="'.$key["id"].'">'.$key["name"].'</option>';
                    }
                  ?>
                </select>
            </div>
            <div class="mb-3 mt-3">
                    <label for="email" class="form-label">IBAN:</label>
                    <div class="input-group">
                        <input type="text" name="iban" class="form-control" placeholder="IBAN">
                    </div>
            </div>
            <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>