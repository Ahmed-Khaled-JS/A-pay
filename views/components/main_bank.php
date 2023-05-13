<?php
require_once '../models/account.php';
function bankcard($account){
  echo '<div class="card margin-crads" style="margin:20px;">
  <div class="card-header">
    account in '.$account["name"].'
  </div>
  <div class="card-body">
    <h5 class="card-title">'. $account["firstName"] . $account["lastName"] .'</h5>
    <p class="card-text">saving Account '. $account["iban"] .'</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'. $account["iban"] .'">
    check balance
</button>
  </div>
</div>
<div class="modal fade" id="myModal'. $account["iban"] .'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">'. $account["Balance"] .' $</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

';
}
