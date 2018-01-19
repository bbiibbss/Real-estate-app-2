<?php
    include("../php/session.php");

    require_once("../php/userClass.php");
    $user = new User();

    $loggedUserID = $_SESSION['userID_session'];
    $loggedUser = $_SESSION['user_session'];
    $loggedUser = array_map("utf8_encode", $loggedUser);

    $usersMenu="<a href='users.php' class='w3-bar-item w3-button w3-padding-large'>Utilizadores</a>";
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
    <script type="text/javascript" src="../js/navBar.js"></script>
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
                <a href='' class='w3-bar-item w3-button w3-padding-large'>Conta de Utilizador</a>
                <a href="../php/logout.php?logout=true" class="w3-bar-item w3-button w3-hide-small w3-padding-large">LogOut</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a  href="imoveis.php" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <?php echo $user->showToAdmin($usersMenu); ?>
        <?php echo $user->showToManager($visits); ?>
        <a  href="" class="w3-bar-item w3-button w3-padding-large">Conta de Utilizador</a>
        <a href="../php/logout.php?logout=true" class="w3-bar-item w3-button w3-padding-large">LogOut</a>
    </div>

    <!-- PAGE CONTENT -->
    <div class="w3-content w3-padding page-content">

        <div class="w3-container w3-padding-32">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Os Seus Dados</h3>
        </div>

        <div class="w3-row">
                <div class="w3-display-container w3-col l6 m6 s12 w3-padding">
                    <p><i class='fa fa-pencil w3-right edit-button' onclick="document.getElementById('userDataModal').style.display='block'"></i></p>
                    <?php $user->getLoggedUserData("",$loggedUserID);?>
                </div>
                <div class="w3-display-container w3-col l6 m6 s12 w3-padding">   
                    <p><i class='fa fa-pencil w3-right edit-button' onclick="document.getElementById('userPasswordModal').style.display='block'"></i></p>
                    <p><b>Password: </b><?php $user->codePassword("",$loggedUserID)?></p> 
                </div>
            </div>
        </div>
    </div>
    <script src="../js/modals.js"></script>
    <script src="../js/passwordVisible.js"></script>
    <script src="../js/passwordValidation.js"></script>
    <?php include("../php/footer.php"); ?>
    <?php include("../php/modals/userDataModal.php"); ?>

</body>
</html>
