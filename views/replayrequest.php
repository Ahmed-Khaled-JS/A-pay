<?php
require_once "../models/request.php";
require_once "../controllers/request.php";
require_once "../models/account.php";
$re = new REQUEST;
$acco = new account;
$fun = new requestcon;
$re->acc = $_POST["replay"];
$re->id = $_POST["replay_id"];
$re->amount = $_POST["amount"];
$acco->iban = $_POST["bank"];
if($fun->updaterequest($re,$acco)){
    
    header("location: request.php");
}else{
    header("location: request.php");
}
?>
    