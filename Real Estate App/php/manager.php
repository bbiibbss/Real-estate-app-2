<?php
	require_once("userClass.php");
	$user = new User();
	if (isset($_POST["promoteToManager"]) && $_POST["userType"]==3) {
		$userID=$_POST["userID"];
		$type=2;
		if ($userID=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
		else{
			if($user->promoteManager($userID, $type)){
				echo "<script type='text/javascript'>alert('Utilizador promovido a gestor com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
			else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["promoteToManager"]) && $_POST["userType"]==2) {
		$userID=$_POST["userID"];
		$type=3;

		if ($userID=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
		else{
			if($user->promoteManager($userID, $type)){
				$user->addNewRandPropertyManager($userID);
				echo "<script type='text/javascript'>alert('Utilizador despromovido de gestor com sucesso!');  window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
			else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}





?>