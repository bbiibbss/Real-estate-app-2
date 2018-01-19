<?php
    return "
        <div class='w3-container w3-padding-16'>
            <h3 class='w3-border-bottom w3-border-light-grey w3-padding-16'>Hoje</h3>
        </div>
        <div class='w3-row-padding w3-center'>
            ".$visit->getManagerDayVisits($userID)."
        </div>
	";
?>