<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <title>Document</title>
    <link rel="stylesheet" href="./css/his.css">
    
</head>
<body>
<?php 
   $logedin = 1;
   include_once "./components/header.php";
   require_once '../controllers/transcontroller.php';
   require_once '../controllers/usercontroller.php';
   require_once '../models/trans.php';
   $trans = new transcontroller;
   $usercontroller = new usercontroller;
   
   if(isset($_POST["bank"])){
    if(!empty($_POST['bank'])){
        $tran = new trans;
        $tran->rec_iban = $_POST["bank"];
        $tran->id = $_POST["transid"];
        if($trans->collect_money($tran)){
            
        }else{
            $errormsg = '1';
        }
        
    }
    }
   

    $accounts = $usercontroller->getaccounts();
    $transic = $trans->get_collect();

?>



    <!-- <div class="card">
      <h2>Collect Payment</h2>
      <button class="button">Collect All</button>
    </div> -->
    
    <?php
    foreach ($transic as $key) {
      echo '<div class="sender">
        <h3>Collect money</h3>
          <p id="first-paragraph">sender IBAN: '. $key["sender_iban"] .'</p></br>
          <p id="second-paragraph">Amount: '. $key["amount"] .'</p>
          
          <form method="post" action="collect.php">
          <div class="form-group">
              <label for="inputField">Choose Bank:</label>
          <select class="form-control" name="bank" id="inputField">';
          foreach ($accounts as $account){
              echo '<option value="'.$account["iban"].'">'.$account["iban"].'</option>';
          }
          echo ' 
          </select>
          </div>
          <div class="form-group">
              <input type="hidden" class="form-control" id="hiddenInput" value="'.$key["id"] .'"name="transid">
          </div>
          <div class="col-md-12 text-center">
                    <button type="submit" class="button">collect</button>
          </div>
          </form>
          </div>

      ';
     };
    
    ?>



    
    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>