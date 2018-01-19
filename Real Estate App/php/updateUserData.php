<?php

    require_once("userClass.php");
    $user = new USER();
	
	if (isset($_POST['updateUserData'])) {
		$id=$_POST['userId'];
		$firstName=$_POST['firstName'];
		$lastName=$_POST['lastName'];
		$phoneNumber=$_POST['phoneNumber'];
		$island=$_POST['island'];
		$county=$_POST['county'];
		$parish=$_POST['parish'];
		$email=$_POST['email'];

		if ($id=="" || $firstName=="" || $lastName=="" || $phoneNumber=="" || $island=="" || $county=="" || $parish=="" || $email=="") {
			$error = "Os campos não podem estar vazios";
		}else{
			if($user->updateLoggedUserData($id, $firstName, $lastName, $phoneNumber, $island, $county, $parish, $email)){
				echo "<script type='text/javascript'>alert('Dados atualizados com sucesso!'); window.location.href = '../frontend/loggedin/conta.php'</script>";
	        }
	        else {
	        	echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!');window.location.href = '../frontend/loggedin/conta.php'</script>";
			}
		}
	}
	elseif (isset($_POST['updateUserPassword'])) {
		$id=$_POST['userId'];
		$oldPassword=$_POST['oldPassword'];
		$newPassword=$_POST['password'];
		$newPasswordRepeat=$_POST['passwordRepeat'];
		if ($id=="" || $oldPassword=="" || $newPassword=="" || $newPasswordRepeat=="") {
			echo "<script type='text/javascript'>alert('Todos os campos são de preenchimento obrigatório!'); window.location.href = '../frontend/loggedin/conta.php';</script>";
		}
		elseif($newPassword != $newPasswordRepeat){
			echo "<script type='text/javascript'>alert('As passwords inseridas nos campos 'Nova password' e 'repita a nova password' não são iguais. Tente novamente!'); window.location.href = '../frontend/loggedin/conta.php';</script>";
		}
		elseif($oldPassword == $newPassword){
			echo "<script type='text/javascript'>alert('A nova password tem de ser diferente da password antiga!');window.location.href = '../frontend/loggedin/conta.php';</script>";
		}
		else{
			if($user->updateLoggedUserPassword($id, $oldPassword, $newPassword)){
				echo "<script type='text/javascript'>alert('Password atualizada com sucesso!');window.location.href = '../frontend/loggedin/conta.php';</script>";
	        }
	        else {
	            echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); </script>";
			}
		}	
	}
?>