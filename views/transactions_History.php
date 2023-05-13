<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <link rel="stylesheet" href="./css/index.css">
    <title>transactions History</title>
</head>
<body>
<?php 
   $logedin = 1;
   include_once "./components/header.php";
   require_once "../controllers/usercontroller.php";
   require_once "../models/user.php";
   $usercontroller = new usercontroller;
   $user = new user;
   $user->id = $_SESSION['user_id'];
   $tranes = $usercontroller->get_transforuser($user);
   if(isset($_POST['BY-tran']) && isset($_POST['search-tran'])){
        if(!empty($_POST['BY-tran']) && !empty($_POST['search-tran'])){
            $tranes = $usercontroller->search_tranForUser($_POST['BY-tran'],$_POST['search-tran'],$user);
            
        }
    }

?>
    <div class="container">
		<h2>transition Table</h2>
		<form action="transactions_History.php" method="post">
		<div class="form-group" style="width:30%">
        	<label for="inputField">Search BY:</label>
        	<select class="form-control" name="BY-tran" id="inputField">
				<option value="sender_iban">sender_iban</option>
				<option value="rec_iban">rec_iban</option>
                <option value="userrec.firstName">name</option>
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
                <th>rec_name</th>
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
							<td>'.$tran["recfirst"] .$tran["reclast"].'</td>
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