<?php
    include("../php/session.php");
    require_once("../php/propertyClass.php");
    $property = new Property();

    require_once("../php/userClass.php");
    $user = new User();

    $usersMenu="<a href='users.php' class='w3-bar-item w3-button w3-padding-large'>Utilizadores</a>";
    $visits="<a href='visitas.php' class='w3-bar-item w3-button w3-padding-large'>Visitas</a>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>AZ REAL ESTATE</title>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <script src="../js/navBar.js"></script>
    <script src="../js/previewImage.js"></script>
    <style>
        .tab {overflow: hidden;border: 1px solid #ccc;background-color: #f1f1f1;width: 100%;}
        .tablinks{float: left;border: none;outline: none;cursor: pointer;padding: 10px;transition: 0.3s;font-size: 17px;}
        .tab button:hover {background-color: #ddd;}
        .tab button.active {background-color: #ccc;}
        .tabcontent {display: none;}
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href='' class='w3-bar-item w3-button w3-padding-large'>Imóveis</a>
                <?php echo $user->showToAdmin($usersMenu); ?>
                <?php echo $user->showToManager($visits); ?>
                <a href='conta.php' class='w3-bar-item w3-button w3-padding-large'>Conta de Utilizador</a>
                <a href="../php/logout.php?logout=true" class="w3-bar-item w3-button w3-hide-small w3-padding-large">LogOut</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a  href="" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <?php echo $user->showToAdmin($usersMenu); ?>
        <?php echo $user->showToManager($visits); ?>
        <a  href="conta.php" class="w3-bar-item w3-button w3-padding-large">Conta de Utilizador</a>
        <a href="../php/logout.php?logout=true" class="w3-bar-item w3-button w3-padding-large">LogOut</a>
    </div>

    <!-- PAGE CONTENT -->
    <div class="w3-content page-content" style="margin-top: 50px;">
        <div class="w3-container">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Imóveis</h3>
        </div>
        
        <div class='w3-row-padding w3-center'>
            <!-- MANAGER -->
            <?php echo $user->showToManager(include("../php/managerProperties.php"));?>
            <!-- ADMIN -->
            <?php echo $user->showToAdmin(include("../php/adminProperties.php"));?>
        </div>
    </div>
    <script src="../js/adminPropertyFilters.js"></script>
    <button onclick="topFunction()" id="backToTopButton" title="top"><i class="fa fa-chevron-up"></i></button>

    <?php include("../php/footer.php"); ?>
    <?php include("../php/modals/createPropertyModal.php"); ?>
    <script src="../js/backToTop.js"></script>
    <script src="../js/previewImage.js"></script>
    <script src="../js/modals.js"></script>
    <script src="../js/filterSelect.js"></script>
    <script src="../js/addPhoto.js"></script>

</body>
</html>