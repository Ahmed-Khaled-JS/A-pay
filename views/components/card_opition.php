<?php

function card_opoition($typeOfService,$icon1,$icon2,$icon3,$goto) {
    echo '<div class="card text-white bg-dark mb-3" style="width: 8rem;margin: 0 0 0 20px;color:white;text-align:center;border-radius: 10px;">
    <div class="card-header">'. $typeOfService. '</div>
    <div class="card-body">
        <a style="color:white" href="' . $goto .'"><i class="'. $icon1. " " . $icon2 . "  ". $icon3. '"></i></a>
    </div>
  </div>
  ';
}

?>
