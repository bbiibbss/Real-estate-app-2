<?php
    session_start();
    require_once("../../php/propertyClass.php");
    $property = new Property();
    require_once("../../php/userClass.php");
    $user = new User();
    if($user->isLoggedin()!=""){
        $user->redirect('../../index.php');
    }

    $id=$_GET["id"];
    if($id==""){
        echo"algo correu mal";
    }
    else{
        $path = "../../imoveis/".$id."/";
        $file=file($path.$id.".csv");
        $ppty=implode($file);
        $_SESSION['property']=$ppty;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>AZ REAL ESTATE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/stylesheet.css">
    <script src="../../js/navBar.js"></script>
</head>
<body>

    <!-- NAVBAR -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href="imoveis.php" class="w3-bar-item w3-button">Imóveis</a>
                <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
                <a onclick="document.getElementById('signupModal').style.display='block'" class="w3-bar-item w3-button">Inscreva-se</a>
                <a onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button" >LogIn</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a href="" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <a href=sobre.php" class="w3-bar-item w3-button w3-padding-large">Sobre</a>
        <a onclick="document.getElementById('signupModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large">Increva-se</a>
        <a onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large">LogIn</a>
    </div>

    <!-- PAGE CONTENT -->
    <div class="w3-content w3-margin-bottom w3-padding-24 page-content" style="margin-top: 50px;">
        <div class="w3-row w3-padding w3-left">
            <p><a href="imoveis.php">Imóveis</a> / <?php $file=explode(",", $file[0]);echo $file[2]; ?></p>
        </div>
        <?php
            $property->getPropertyDetails($ppty, $user);
        ?>
    </div>
    <script src="../../js/slideShow.js"></script>

    <?php include("../../php/footer.php"); ?>
    <?php include("../../php/modals/loginModal.php"); ?>
    <?php include("../../php/modals/signupModal.php"); ?>
</body>
</html>
