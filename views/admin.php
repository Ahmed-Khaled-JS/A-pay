<?php
session_start();
if(!isset($_SESSION["user_role"])){
    header("Location: login.php");
}else if($_SESSION["user_role"] == "1"){
    header("Location: index.php");
}
?>
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
   $logedin = 1;
   include_once "./components/header.php";
   require_once "../controllers/admincontroller.php";
   $admincontroller = new AdminController;
   $result = $admincontroller->get_users();
   $tranes = $admincontroller->get_trans();
   if(isset($_POST['BY']) && isset($_POST['search'])){
		if(!empty($_POST['BY']) && !empty($_POST['search'])){
			$result = $admincontroller->search_user($_POST['BY'],$_POST['search']);
			
		}
	}
 	if(isset($_POST['BY-tran']) && isset($_POST['search-tran'])){
		if(!empty($_POST['BY-tran']) && !empty($_POST['search-tran'])){
			$tranes = $admincontroller->search_tran($_POST['BY-tran'],$_POST['search-tran']);
			
		}
	}
?>
	<div class="container">
		<h2>User Table</h2>
		<form action="admin.php" method="post">
		<div class="form-group" style="width:30%">
        	<label for="inputField">Search BY:</label>
        	<select class="form-control" name="BY" id="inputField">
				<option value="firstName">Name</option>
				<option value="phone">phone</option>
				<option value="email">email</option>
			</select>
        </div>
		<div class="mb-3 mt-3"  style="width:30%">
			<div class="input-group">
				<input type="text" name="search" class="form-control" placeholder="Search">
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
			
        </div>
		</form>
		<table class="table table-bordered">
			<thead>
				<tr>
				<th>Name</th>
				<th>Phone</th>
				<th>Role</th>
				<th>email</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($result as $user) {
					if($user["role_id"] == "2"){
						$role = "Admin";
					}
					else if($user["role_id"] == "3"){
						continue;
					}else{
						$role = "User";
					}
					echo '
						<tr>
							<td>'. $user["firstName"] .  $user["lastName"] .'</td>
							<td>'. $user["phone"] .'</td>
							<td>'. $role .'</td>
							<td>'. $user["email"]  .'</td>
							<td>
							<form action="blockuser.php" method="POST">
							<div class="form-group">
								<input type="hidden" class="form-control" id="hiddenInput" value="'.$user["id"] .'"name="userid">
							</div>
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-danger">Block</button>
							</div>
							</form>
							</td>
						</tr>';
				}
				
					
				?>
			</tbody>
		</table>
		
		<h2>transition Table</h2>
		<form action="admin.php" method="post">
		<div class="form-group" style="width:30%">
        	<label for="inputField">Search BY:</label>
        	<select class="form-control" name="BY-tran" id="inputField">
				<option value="sender_iban">sender_iban</option>
				<option value="rec_iban">rec_iban</option>
				<option value="created_at">created_at</option>
				<option value="amount">amount</option>
			</select>
        </div>
		<div class="mb-3 mt-3"  style="width:30%">
			<div class="input-group">
				<input type="text" name="search-tran" class="form-control" placeholder="Search">
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
			
        </div>
		</form>
		<table class="table table-bordered">
			<thead>
				<tr>
				<th>sender_iban</th>
				<th>rec_iban</th>
				<th>created_at</th>
				<th>amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($tranes as $tran) {
						
						echo '
						<tr>
							<td>'.$tran["sender_iban"].'</td>
							<td>'.$tran["rec_iban"].'</td>
							<td>'.$tran["created_at"].'</td>
							<td>'.$tran["amount"].'</td>
						</tr>';
					}
			?>
			</tbody>
		</table>
	</div>

    		


    <script src="https://kit.fontawesome.com/0ea0c5df0a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>