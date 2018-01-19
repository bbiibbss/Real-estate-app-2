<?php

	require_once("visitClass.php");
    $visit = new Visit();
	
	if (isset($_POST["submitVisitProposal"])) {
		$userID=$_POST["userId"];
		$propertyID=$_POST["propertyId"];
		$date=$_POST["visitDate"];
		$time=$_POST["visitTime"];
		$status=1;

		if ($date=="" || $time=="") {
			echo $error="preencher os campos";
		}
		else if($userID=="" || $propertyID==""){
			echo $error="algo correu mal";
		}
		else{
			if($visit->visitRequest($userID,$propertyID,$date,$time,$status)){
				echo "<script type='text/javascript'>alert('Pedido realizado com sucesso! A aguardar confirmação!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	else if(isset($_POST["updateUserVisitData"])){
		$propertyID=$_POST["propertyId"];
		$userID=$_POST["userId"];
		$date=$_POST["updateVisitDate"];
		$time=$_POST["updateVisitTime"];
		if($date=="" || $time==""){
			echo "<script type='text/javascript'>alert('!!!ATENÇÂO!!! Todos os campos são de preenchimento obrigatório!');  window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
		}
		else if($propertyID=="" || $userID==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
		}
		else{
			if($visit->updateVisitRequest($userID,$propertyID,$date,$time)){
				echo "<script type='text/javascript'>alert('Alteração realizada com sucesso! A aguardar confirmação!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
			}
		}
	}
	else if(isset($_POST["deleteVisitRequest"])){
		$propertyID=$_POST["propertyId"];
		$userID=$_POST["userId"];
		if($propertyID=="" || $userID==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
		}
		else{
			if($visit->deleteVisit($userID,$propertyID)){
				echo "<script type='text/javascript'>alert('Pedido cancelado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'</script>";
			}
		}
	}
	else if(isset($_POST["acceptRequest"])){
		$propertyID=$_POST["propertyId"];
		$userID=$_POST["userId"];
		$date=$_POST["date"];
		$time=$_POST["time"];
		$status = 2;

		if ($propertyID=="" || $userID=="" || $status=="" || $date=="" || $time=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
		elseif($visit->handleVisitRequest($userID,$propertyID,$date,$time,$status)){
			echo "<script type='text/javascript'>alert('Pedido aceite com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
	}
	else if(isset($_POST["declineRequest"])){
		$propertyID=$_POST["propertyId"];
		$userID=$_POST["userId"];
		$date=$_POST["date"];
		$time=$_POST["time"];
		$status = 3;

		if ($propertyID=="" || $userID=="" || $status=="" || $date=="" || $time=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
		elseif($visit->handleVisitRequest($userID,$propertyID,$date,$time,$status)){
			echo "<script type='text/javascript'>alert('Pedido aceite com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}
	}
?>