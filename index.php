<?php

	require_once("php/session.php");

    require_once('php/userClass.php');
    $user = new USER();

    $loggedinUser = $_SESSION['user_session'];

    $userType = $loggedinUser[9];

    if ($user->isLoggedin()!="") {
        if ($userType==1 || $userType==2){
            $user->redirect('backend/homepage.php');
        }
        else if($userType==3){
            $user->redirect('frontend/loggedin/homepage.php');
        }
    }
    else{
    	$user->redirect('frontend/loggedout/homepage.php');
    }
	die();
?>