<?php
	require_once"fileClass.php";
	$file = new FileCSVPDF();

	require_once'userClass.php';
	$user= new User();

	require_once'propertyClass.php';
	$property= new Property();

	if (isset($_POST["salesByManagerPDF"])) {
		$fileName="vendas_por_gestor__";
		$title="Vendas Mensais e Anuais Por Gestor";
		$content=$_POST["salesByManagerTable"];

		if ($fileName=="" || $title=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createPDFFile($content, $title, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByIslandPDF"])) {
		$fileName="imoveis_por_ilha_";
		$title="Imóveis por Ilha";
		$content=$_POST["propertiesByIslandTable"];

		if ($fileName=="" || $title=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createPDFFile($content, $title, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByCountyPDF"])) {
		$fileName="imoveis_por_concelho_";
		$title="Imóveis por Concelho";
		$content=$_POST["propertiesByCountyTable"];

		if ($fileName=="" || $title=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createPDFFile($content, $title, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByParishPDF"])) {
		$fileName="imoveis_por_freguesia_";
		$title="Imóveis por Freguesia";
		$content=$_POST["propertiesByParishTable"];

		if ($fileName=="" || $title=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createPDFFile($content, $title, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByTypePDF"])) {
		$fileName="imoveis_por_tipo_";
		$title="Imóveis por Tipo";
		$content=$_POST["propertiesByTypeTable"];

		if ($fileName=="" || $title=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createPDFFile($content, $title, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByPriceRangePDF"])) {
		$fileName="imoveis_por_preco_";
		$title="Imóveis por Intervalo de Preço";
		$content=$_POST["propertiesByPriceRangeTable"];

		if ($fileName=="" || $title=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createPDFFile($content, $title, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["salesByManagerCSV"])) {
		$fileName="vendas_por_gestor_";
		$content=$_POST["salesByManagerTable"];

		if ($fileName=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createCSVFile($content, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByIslandCSV"])) {
		$fileName="imoveis_por_ilha_";
		$content=$_POST["propertiesByIslandTable"];

		if ($fileName=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createCSVFile($content, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByCountyCSV"])) {
		$fileName="imoveis_por_concelho_";
		$content=$_POST["propertiesByCountyTable"];

		if ($fileName=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createCSVFile($content, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByParishCSV"])) {
		$fileName="imoveis_por_freguesia_";
		$content=$_POST["propertiesByParishTable"];

		if ($fileName=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createCSVFile($content, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByTypeCSV"])) {
		$fileName="imoveis_por_tipo_";
		$content=$_POST["propertiesByTypeTable"];

		if ($fileName=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createCSVFile($content, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["propertiesByPriceRangeCSV"])) {
		$fileName="imoveis_por_preco_";
		$content=$_POST["propertiesByPriceRangeTable"];

		if ($fileName=="" || $content=="") {
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($file->createCSVFile($content, $fileName)){
				echo "<script type='text/javascript'>alert('Ficheiro criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
?>