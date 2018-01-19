<?php
	session_start();
	
	require_once 'userClass.php';
	$user = new USER();

	if(!$user->isLoggedin()) {
		$user->redirect('http://localhost/Projeto_PWI/index.php');
	}
?>