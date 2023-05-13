<?php
require_once "../models/user.php";
require_once "../controllers/admincontroller.php";
$user = new user;
$adminController = new AdminController;
$user->id = $_POST["userid"];
$user->role_id = 3;
if($adminController->Block_user($user)){
    header("Location: admin.php");

}else{
    header("Location: admin.php");
}
?>
