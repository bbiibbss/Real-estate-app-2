<?php
	require_once('session.php');
	require_once('userClass.php');
	$user = new USER();
	
	if(isset($_GET['logout']) && $_GET['logout']=="true") {
		$user->doLogout();
	}
?>