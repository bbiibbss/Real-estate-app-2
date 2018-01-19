<?php
    include("../php/session.php");
    require_once("../php/propertyClass.php");
    $property = new Property();

    require_once("../php/userClass.php");
    $user = new User();

    $usersMenu="<a href='' class='w3-bar-item w3-button w3-padding-large'>Utilizadores</a>";
    $visits="<a href='visitas.php' class='w3-bar-item w3-button w3-padding-large'>Visitas</a>";

?>
<!DOCTYPE html>
<html>
<head>
    <title>AZ REAL ESTATE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <script src="../js/navBar.js"></script>
    <script src="../js/findByName.js"></script>
    <style>
        .tab {overflow: hidden;border:none;background-color: #f1f1f1;width: 100%;}
        .tablinks{float: left;border: none;outline: none;cursor: pointer;padding: 14px 16px;transition: 0.3s;font-size: 17px;}
        .tab button:hover {background-color: #ddd;}
        .tab button.active {background-color: #ccc;}
        .tabcontent {display: none;padding: 6px 12px;border: none;}
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href='imoveis.php' class='w3-bar-item w3-button w3-padding-large'>Imóveis</a>
                <?php echo $user->showToAdmin($usersMenu); ?>
                <?php echo $user->showToManager($visits); ?>
                <a href='conta.php' class='w3-bar-item w3-button w3-padding-large'>Conta de Utilizador</a>
                <a href="../php/logout.php?logout=true" class="w3-bar-item w3-button w3-hide-small w3-padding-large">LogOut</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a  href="imoveis.php" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <?php echo $user->showToAdmin($usersMenu); ?>
        <?php echo $user->showToManager($visits); ?>
        <a  href="conta.php" class="w3-bar-item w3-button w3-padding-large">Conta de Utilizador</a>
        <a href="../php/logout.php?logout=true" class="w3-bar-item w3-button w3-padding-large">LogOut</a>
    </div>

    <!-- PAGE CONTENT -->
    <div class="w3-padding page-content">
        <div class="w3-container w3-padding-16">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Utilizadores</h3>
        </div>
        <div class="w3-container">
            <div class="tab w3-row">
                <button class="tablinks w3-col l6 m6 s6" onclick="openContent(event, 'clients')" id="defaultOpen"><h5>Clientes</h5></button>
                <button class="tablinks w3-col l6 m6 s6" onclick="openContent(event, 'managers')"><h5>Gestores</h5></button>
            </div>
            <div id="clients" class="tabcontent">
                <input type="text" id="searcClientshBar" onkeyup="findByName('searcClientshBar','clientsList');" placeholder=" Pesquisa por nome" title="Insira aqui o nome que procura.">
                <ul id="clientsList">
                    <?php $user->getAllUsers(3); ?>
                </ul>
            </div>
            <div id="managers" class="tabcontent">
                <input type="text" id="searManagerschBar" onkeyup="findByName('searManagerschBar','managersList');" placeholder=" Pesquisa por nome" title="Insira aqui o nome que procura.">          
                <ul id="managersList">
                    <?php $user->getAllUsers(2); ?>
                </ul>
            </div>
        </div>
        <script src="../js/tabs.js"></script>
    </div>
    <button onclick="topFunction()" id="backToTopButton" title="top"><i class="fa fa-chevron-up"></i></button>
    <script src="../js/backToTop.js"></script>

    <?php include("../php/footer.php"); ?>

</body>
</html>
