<?php
    include("../../php/session.php");
    require_once("../../php/propertyClass.php");
    $property = new Property();

    unset($_SESSION['property']);
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../../js/navBar.js"></script>
    <script src="../../js/filterSidenav.js"></script>
</head>
<body>

    <!-- NAVBAR -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href="" class="w3-bar-item w3-button">Imóveis</a>
                <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
                <a href="conta.php" class="w3-bar-item w3-button">Conta de Utilizador</a>
                <a href="../../php/logout.php?logout=true" class="w3-bar-item w3-button w3-hide-small" >LogOut</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a href="" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <a href="sobre.php" class="w3-bar-item w3-button w3-padding-large">Sobre</a>
        <a href="conta.php" class="w3-bar-item w3-button w3-padding-large">Conta de Utilizador</a>
        <a href="../../php/logout.php?logout=true" class="w3-bar-item w3-button w3-padding-large">LogOut</a>
    </div>

    <?php include("../../php/filters.php"); ?>

    <!-- PAGE CONTENT -->
    <div class="w3-content w3-padding page-content main" id="main" style="margin-top: 50px;">
        <div class="w3-container w3-padding-16">
            <h3 class="w3-border-bottom w3-border-light-grey">Imóveis</h3>
            <button style="font-size: 17px;" id="filterButton" class="filter-button" onclick="openNav()">FILTRAR <i class="fa fa-sliders edit-button"></i></button>
        </div>
        <div class="w3-row-padding w3-center">
            <?php  $property->getAllProperties();  ?>
        </div>
    </div>
    <button onclick="topFunction()" id="backToTopButton" title="top"><i class="fa fa-chevron-up"></i></button>

    <script src="../../js/backToTop.js"></script>

    <script src="../../js/priceFilter.js"></script>
    <script src="../../js/checkboxFilter.js"></script>
    <script src="../../js/filters.js"></script>

    <?php include("../../php/footer.php"); ?>

</body>
</html>
