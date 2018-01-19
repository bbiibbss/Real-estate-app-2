<?php
    include("../../php/session.php");
    require_once("../../php/propertyClass.php");
    $property = new Property();
    unset($_SESSION["property"]);

    require_once("../../php/userClass.php");
    $user = new User();
  
    $loggedUserID = $_SESSION['userID_session'];
    $loggedUser = $_SESSION['user_session'];
    $loggedUser = array_map("utf8_encode", $loggedUser);

    require_once("../../php/visitClass.php");
    $visit = new Visit();
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
    <style>
        .tab {overflow: hidden;border: 1px solid #ccc;background-color: #f1f1f1;width: 100%;}
        .tablinks{float: left;border: none;outline: none;cursor: pointer;padding: 14px 16px;transition: 0.3s;font-size: 17px;}
        .tab button:hover {background-color: #ddd;}
        .tab button.active {background-color: #ccc;}
        .tabcontent {display: none;padding: 6px 12px;border: 1px solid #ccc;border-top: none;}
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button w3-padding-large" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href="imoveis.php" class="w3-bar-item w3-button">Imóveis</a>
                <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
                <a href="" class="w3-bar-item w3-button">Conta de Utilizador</a>
                <a href="../../php/logout.php?logout=true" class="w3-bar-item w3-button">LogOut</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a  href="imoveis.php" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <a href="sobre.php" class="w3-bar-item w3-button w3-padding-large">Sobre</a>
        <a href="" class="w3-bar-item w3-button w3-padding-large">Conta de Utilizador</a>
        <a href="../../php/logout.php?logout=true" class="w3-bar-item w3-button w3-padding-large">LogOut</a>
    </div>

    <!-- PAGE CONTENT -->
    <div class="w3-content w3-padding page-content">
        <div class="w3-container w3-padding-32">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Os Seus Dados</h3>
        </div>

        <div class="w3-row-padding">
            <div class="w3-col l3 m6 s12 w3-margin-bottom">
                <h4>Dados de utilizador:</h4>
                <div class="w3-display-container w3-card w3-padding w3-margin-bottom">
                    <p><i class='fa fa-pencil w3-right edit-button' onclick="document.getElementById('userDataModal').style.display='block'"></i></p>
                    <?php $user->getLoggedUserData("../",$loggedUserID);?>
                </div>
                <div class="w3-display-container w3-card w3-padding w3-margin-top">   
                    <p><i class='fa fa-pencil w3-right edit-button' onclick="document.getElementById('userPasswordModal').style.display='block'"></i></p>
                    <p><b>Password: </b><?php $user->codePassword("../",$loggedUserID)?></p> 
                </div>
            </div>
            <div class="w3-col l1 w3-hide-small w3-hide-medium w3-margin-bottom">
                <div class="w3-display-container">
                </div>
            </div>
            <div class="w3-col l8 m6 s12 w3-margin-bottom">
                <h4>Visitas:</h4>
                <div class="tab w3-row">
                    <button class="tablinks w3-col l4 m4 s4" onclick="openContent(event, 'bookedVisits')" id="defaultOpen"><h5>Visitas marcadas</h5></button>
                    <button class="tablinks w3-col l4 m4 s4" onclick="openContent(event, 'declinedVisits')"><h5>Visitas recusadas</h5></button>
                    <button class="tablinks w3-col l4 m4 s4" onclick="openContent(event, 'visitRequests')"><h5>Visitas pendentes</h5></button>
                </div>
                <div id="bookedVisits" class="tabcontent">
                    <?php $visit->getUserBookedVisits($loggedUserID); ?>
                </div>
                <div id="declinedVisits" class="tabcontent">
                    <?php $visit->getUserDeclinedVisits($loggedUserID); ?>
                </div>
                <div id="visitRequests" class="tabcontent">
                    <?php $visit->getUserVisitRequests($loggedUserID); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/tabs.js"></script>

    <?php include("../../php/footer.php"); ?>
    <?php include("../../php/modals/userDataModal.php"); ?>

</body>
</html>
