<?php
    include("../../php/session.php");
    require_once("../../php/propertyClass.php");
    $property = new Property();
    
    unset($_SESSION["property"]);
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
    <script type="text/javascript" src="../../js/navBar.js"></script>
</head>
<body>

    <!-- NAVBAR -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href="imoveis.php" class="w3-bar-item w3-button">Imóveis</a>
                <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
                <a href="conta.php" class="w3-bar-item w3-button">Conta de Utilizador</a>
                <a href="../../php/logout.php?logout=true" class="w3-bar-item w3-button">LogOut</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a  href="imoveis.php" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <a href="sobre.php" class="w3-bar-item w3-button w3-padding-large">Sobre</a>
        <a href="conta.php" class="w3-bar-item w3-button w3-padding-large">Conta de Utilizador</a>
        <a href="../../php/logout.php?logout=true" class="w3-bar-item w3-button w3-padding-large">LogOut</a>
    </div>

    <!-- HEADER -->
    <div class="parallax">
        <div class="w3-display-middle w3-margin-top w3-center">
            <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>AZ</b></span> <span class="w3-hide-small w3-text-light-grey">REAL ESTATE</span></h1>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="w3-padding page-content">
        <div class="w3-container w3-padding-32">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Propriedades em Destaque</h3>
        </div>
        <div class="w3-row-padding w3-center">
            <?php $property->getAllFeaturedProperties();  ?>
        </div>
    </div>
    <button onclick="topFunction()" id="backToTopButton" title="top"><i class="fa fa-chevron-up"></i></button>

    <script src="../../js/backToTop.js"></script>

    <?php include("../../php/footer.php"); ?>

</body>
</html>
