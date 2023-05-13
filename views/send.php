<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <title>Document</title>
    <link rel="stylesheet" href="./css/trans.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<?php 
   $logedin = 1;
   include_once "./components/header.php";
   require_once "../controllers/usercontroller.php";
   require_once "../models/trans.php";
   $errormsg = '';
   $usercontroller = new usercontroller;
   $accounts = $usercontroller->getaccounts();
    if(isset($_POST['bank']) && isset($_POST['IBANORPhone'])&& isset($_POST['data'])&& isset($_POST['amount'])){
        if(!empty($_POST['bank']) && !empty($_POST['IBANORPhone'])&& !empty($_POST['data'])&& !empty($_POST['amount'])){
            $trans = new trans;
            $trans->sender_iban = $_POST['bank'];
            if($_POST['IBANORPhone'] == "iban"){
                $trans->rec_iban = $_POST['data'];
            }else{
                $trans->rec_phone = $_POST['data'];
            }
            $trans->amount = $_POST['amount'];
            if($usercontroller->sendmoney($trans)){
                $errormsg = '2';
            }else{
                $errormsg = '1';
            }
            
        }
    }
   
?>
    <h1>Transfer Money</h1>
    
    <form method="post" action="send.php">
    <?php if ($errormsg == '2'): ?>    
    <div class="alert alert-success">
        <strong>Success!</strong> transfer Money successful.
    </div>
    <?php endif; ?>
    <?php if ($errormsg == '1'): ?>    
    <div class="alert alert-danger">
        <strong>wrong!</strong> transfer Money fialed.
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="inputField">Choose IBAN:</label>
        <select class="form-control" name="bank" id="inputField">
            <?php
            foreach ($accounts as $key) {
                echo '<option value="'.$key["iban"].'">'.$key["iban"].'</option>';
            }
            ?>
        </select>
    </div>
    <select class="form-control" name="IBANORPhone" id="inputFieldop">
        <option value="iban">send with IBAN</option>
        <option value="phone">send with phone number</option>
    </select>
    <div class="mb-3 mt-3">
        <label for="email" class="form-label">Recipient's data:</label>
        <div class="input-group">
            <input type="text" name="data" class="form-control" placeholder="data">
        </div>
    </div>
      <label for="amount">Amount:</label>
      <input type="number" id="amount" name="amount" placeholder="Enter amount">
      
      <input  type="submit" value="Transfer">
    </form>



    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>
</html>
