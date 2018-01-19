<?php
	require_once("propertyClass.php");
    $property = new Property();

	if (isset($_POST["createProperty"])) {
		$name=$_POST["propertyName"];
		$description=$_POST["propertyDescription"];
		$type=$_POST["propertyType"];
		$typology=$_POST["propertyTypology"];
		$businessType=$_POST["propertyBusinessType"];
		$price=$_POST["propertyPrice"];
		$area=$_POST["propertyArea"];
		$bedrooms=$_POST["propertyBedrooms"];
		$bathrooms=$_POST["propertyBathrooms"];
		$parish=$_POST["parish"];
		$manager=$_POST["manager"];

		$mainImage = $_FILES["photoToUpload"]["name"];
	
		$dirs = glob("../imoveis/*");
		if (empty($dirs)) {
			$id=1;
		}else{
			$last=end($dirs);
			$num=explode("/", $last);
			$id=end($num)+1;
		}
		$dir = "../imoveis/".$id;
		if (!file_exists($dir)) {
		    mkdir($dir, 0777, true);
		}
		

		$temp = explode(".", $mainImage);
		$mainImageNewName = $id."_0".'.'.end($temp);
		move_uploaded_file($_FILES["photoToUpload"]["tmp_name"], $dir."/".$mainImageNewName);

		$images=array();
		array_push($images, [$mainImageNewName, $name]);

		$count=1;
		for ($i=1; $i < 50 ; $i++) { 
			if (isset($_FILES["imageGallery".$i]["name"])) {
				$count+=1;
			}else{
				break;
			}
		}

		for ($i=1; $i< $count; $i++) {
			$galleryImage = $_FILES["imageGallery".$i]["name"];
			$imageDescription = $_POST["imageDescription".$i];
			$temp = explode(".", $galleryImage);
	        $newfilename = $id."_".$i.'.'.end($temp);
	        move_uploaded_file($_FILES["imageGallery".$i]["tmp_name"], $dir."/".$newfilename);
	       	array_push($images, [$newfilename, $imageDescription]);
		}

		if($name=="" || $description=="" || $type=="" || $typology=="" || $businessType=="" || $price=="" || $area=="" || $bedrooms=="" || $bathrooms=="" || $parish=="" || $mainImage=="" || $manager==""){
			echo "<script type='text/javascript'>alert('Todos os campos são de preenchimento obrigatório!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";

		}else{
			
			if($property->createProperty($name, $description, $type, $typology, $businessType, $price, $area, $bedrooms, $bathrooms, $parish, $mainImageNewName, $images, $id, $dir, $manager)){
				echo "<script type='text/javascript'>alert('Imóvel criado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["updateProperty"])) {
		$id=$_POST["id"];
		$name=$_POST["propertyName"];
		$description=$_POST["propertyDescription"];
		$type=$_POST["propertyType"];
		$typology=$_POST["propertyTypology"];
		$businessType=$_POST["propertyBusinessType"];
		$price=$_POST["propertyPrice"];
		$area=$_POST["propertyArea"];
		$bedrooms=$_POST["propertyBedrooms"];
		$bathrooms=$_POST["propertyBathrooms"];
		$parish=$_POST["parish"];
		$status=$_POST["status"];
		$image=$_POST["image"];
		$manager=$_POST["updateManager"];

		if($name=="" || $description=="" || $type=="" || $typology=="" || $businessType=="" || $price=="" || $area=="" || $bedrooms=="" || $bathrooms=="" || $parish=="" || $manager==""){
			echo "<script type='text/javascript'>alert('Todos os campos são de preenchimento obrigatório!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";

		}else{
			if($property->updateProperty($name, $description, $type, $typology, $businessType, $price, $area, $bedrooms, $bathrooms, $parish, $id, $status, $image, $manager)){
				echo "<script type='text/javascript'>alert('Imóvel editado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["deleteProperty"])) {	
		$id=$_POST["id"];

		if($id==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";

		}else{
			if($property->deleteProperty($id)){
				echo "<script type='text/javascript'>alert('Imóvel removido com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["createFeaturedRequest"])) {
		$id=$_POST["propertyID"];

		if($id==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";

		}else{
			if($property->createFeaturedRequest($id)){
				echo "<script type='text/javascript'>alert('Pedido realizado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif(isset($_POST["updatePropertyStatus"])) {
		$id=$_POST["id"];
		$status=$_POST["status"];

		if($id == ""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		} else {
			if($property->updatePropertyStatus($id, $status)){
				echo "<script type='text/javascript'>alert('Estatdo do imóvel alterado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif(isset($_POST["updatePropertyImage"])) {
		$prevImage=$_POST["prevImage"];
		$prevDescription=$_POST["prevDesc"];
		$newImage=$_FILES["photoToUpload"]["name"];
		$newDescription=$_POST["updatedImageDescription"];
		$id=$_POST["propertyId"];

		if($prevImage=="" || $prevDescription=="" || $newDescription=="" || $id==""){
			echo "<script type='text/javascript'>alert('Todos os campos são de preenchimento obrigatório!');indow.location.href = '".$_SERVER['HTTP_REFERER']."'; </script>";
		}else{
			if(!empty($newImage)){
				$dir = "../imoveis/".$id;

				unlink($dir."/".$prevImage);

				$temp = explode(".", $newImage);
				$newImageNewName = $prevImage;
				move_uploaded_file($_FILES["photoToUpload"]["tmp_name"], $dir."/".$newImageNewName);
			}else{
				$newImageNewName=$prevImage;
			}

			if($property->updatePropertyImage($newImageNewName, $newDescription, $id)){
				echo "<script type='text/javascript'>alert('Imagem editada com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif(isset($_POST["deletePropertyImage"])) {
		$image=$_POST["image"];
		$id=$_POST["propertyId"];
		echo "<script type='text/javascript'>console.log('image: ".$image."<br>id: ".$id."');</script>";
		if($image=="" || $id==""){
			echo "<script type='text/javascript'>alert('Todos os campos são de preenchimento obrigatório!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if($property->deletePropertyImage($image,$id)){
				echo "<script type='text/javascript'>alert('Imagem removida com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif(isset($_POST["addNewPropertyImage"])) {
		$description=$_POST["newImageDescription"];
		$id=$_POST["propertyId"];
		$newImage = $_FILES["addPropertyNewPhoto"]["name"];
		if($newImage=="" || $description=="" || $id==""){
			echo "<script type='text/javascript'>alert('Todos os campos são de preenchimento obrigatório!');indow.location.href = '".$_SERVER['HTTP_REFERER']."'; </script>";
		}else{
			$dir="../imoveis/".$id;
		        $number = count(glob($dir))-3;
		        $files = glob($dir."/*");
		        $images=array();
		        foreach ($files as $file) {
		            $num=explode("/", $file);
		            $name=end($num);
		            $type=explode(".", $name);
		            if ($type[1]!="csv" && $type[1]!="txt") {
		                array_push($images, $type[0]);
		            }
		        }
		        $indexes=array();
		        foreach ($images as $image) {
		            $imageNum=explode("_", $image);
		            array_push($indexes, $imageNum[1]);
		        }
		        asort($indexes);
		        $index=end($indexes)+1;
				$temp = explode(".", $newImage);
				$newImageNewName = $id."_".$index.'.'.end($temp);
				move_uploaded_file($_FILES["addPropertyNewPhoto"]["tmp_name"], $dir."/".$newImageNewName);
			if($property->addNewPropertyImage($newImageNewName,$description,$id)){
				echo "<script type='text/javascript'>alert('Imagem adicionada com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["addPropertyToFeatured"])) {
		$id=$_POST["propertyID"];

		if($id==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!');window.location.href = '".$_SERVER['HTTP_REFERER']."'; </script>";

		}else{
			if($property->addPropertyToFeatured($id)){
				if ($property->removePropertyFromFeaturedRequests($id)) {
					echo "<script type='text/javascript'>alert('Pedido realizado com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["removePropertyFromFeatured"])) {
		$id=$_POST["id"];

		if($id==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";

		}else{
			if($property->removePropertyFromFeatured($id)){
				echo "<script type='text/javascript'>alert('Imóvel removido dos destaques com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
	elseif (isset($_POST["declineFeaturedPropertyRequest"])) {
		$id=$_POST["id"];

		if($id==""){
			echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";

		}else{
			if($property->removePropertyFromFeaturedRequests($id)){
				echo "<script type='text/javascript'>alert('Imóvel removido dos pedidos para destaque com sucesso!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				echo "<script type='text/javascript'>alert('Algo correu mal! Tente novamente mais tarde!'); window.location.href = '".$_SERVER['HTTP_REFERER']."';</script>";
			}
		}
	}
?>