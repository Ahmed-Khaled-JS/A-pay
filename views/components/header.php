
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>

<nav class="navbar navbar-expand-sm bg-light">
  <div class="d-flex justify-content-between container-fluid">
    <div>
        <a class="navbar-brand" href="index.php">A-Pay</a>
    </div>

	<?php
   if ($logedin == 1 && $_SESSION['user_role'] == 1): ?>

        <div class="d-flex">
            <a class="nav-link" href="send.php">Send</a>
            <a class="nav-link" href="request.php">request</a>
            <a class="nav-link" onclick="togglepro_d(this)" href="#"><i class="fa-solid fa-user"></i></a>
            <ul class="dropdown-menu  rigthpos" id="drodown">
              <li><a class="nav-link" href="logout.php">logout</a></li>
            </ul>
        </div>
  <?php
   elseif ($logedin == 1 && $_SESSION['user_role'] == 2): ?>

        <div class="d-flex">
            <a class="nav-link" href="blacklist.php">black list</a>
            <a class="nav-link" href="savepdf.php">Report</a>
            <a class="nav-link" onclick="togglepro_d(this)" href="#"><i class="fa-solid fa-user"></i></a>
            <ul class="dropdown-menu  rigthpos" id="drodown">
              <li><a class="nav-link" href="logout.php">logout</a></li>
            </ul>
        </div>
  <?php elseif($logedin == 2): ?>
		  <div>
            <a class="btn btn-secondary" href="login.php">Login</a>
      </div>
	<?php else: ?>
		  <div>
            <a class="btn btn-secondary" href="signup.php">sign up</a>
      </div>
	<?php endif; ?>
  </div>
</nav>
<script>
function togglepro_d(x) {
    if($("#drodown").hasClass('show')){
      $("#drodown").removeClass('show');
    }else{
      $("#drodown").addClass("show");
    }
    
}
</script>