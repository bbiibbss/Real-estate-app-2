<?php
    session_start();
    require_once("../../php/userClass.php");
    $user = new User();
    if($user->isLoggedin()!=""){
        $user->redirect('../../index.php');
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
    <script type="text/javascript" src="../../js/navBar.js"></script>
</head>
<body>

    <!-- NAVBAR  -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a class="w3-bar-item w3-padding w3-hide-medium w3-hide-large w3-right " href="javascript:void(0)" onclick="menuOpenClose()" title="Toggle Navigation Menu"><i class="w3-xlarge fa fa-bars w3-text-black"></i></a>
            <a href="/Projeto_PWI/frontend/loggedOut/homepage.php" class="w3-bar-item w3-button"><b>AZ</b> REAL ESTATE</a>
            <div class="w3-right w3-hide-small">
                <a href="/Projeto_PWI/frontend/loggedOut/imoveis.php" class="w3-bar-item w3-button">Imóveis</a>
                <a href="" class="w3-bar-item w3-button">Sobre</a>
                <a onclick="document.getElementById('signupModal').style.display='block'" class="w3-bar-item w3-button ">Inscreva-se</a>
                <a onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button">LogIn</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR MOBILE -->
    <div id="navDemo" class="w3-bar-block w3-black w3-padding-large w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:45px;">
        <a href="/Projeto_PWI/frontend/loggedOut/imoveis.php" class="w3-bar-item w3-button w3-padding-large">Imóveis</a>
        <a href="" class="w3-bar-item w3-button w3-padding-large">Sobre</a>
        <a onclick="document.getElementById('signupModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large">Increva-se</a>
        <a onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large">LogIn</a>
    </div>

    <!-- Header -->
    <div class="parallax" id="home">
        <div class="w3-display-middle w3-margin-top w3-center">
            <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>AZ</b></span> <span class="w3-hide-small w3-text-light-grey">REAL ESTATE</span></h1>
        </div>
    </div>

    <!-- Page content -->
    <div class="w3-content w3-padding page-content">
        <div class="w3-container w3-padding-32">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Quem somos</h3>
        </div>
        <div class="w3-row-padding">
            <div class="w3-col l6 m6 s12 w3-margin-bottom">
                <img width="100%" src="../../img/az.png">
            </div>
            <div class="w3-col l6 m6 s12 w3-margin-bottom">
                <p>A <span style="padding: 2px 5px;" class="w3-black w3-large w3-text-white w3-opacity-min"><b>AZ</b></span> REAL ESTATE - Gestão Imobiliária, abriu as suas portas em 2002, no Centro da Cidade de Ponta Delgada.</p>
                <p>A dedicação aos nossos clientes e o nosso profissionalismo são as nossas imagens de marca.</p>
                <p>Contamos com uma equipa de Consultores Imobiliários qualificados para lhes indicarem as soluções adequadas para a venda ou Arrendamento do seu Imóvel.</p>
                <p>Em Dezembro de 2010, criámos uma nova área de negócios, AZLIFE Condomínios, tendo como actividade a administração e gestão de Condomínios.</p>
                <p>Contacte-nos para um atendimento 100% personalizado.</p>
            </div>
        </div>

        <div class="w3-container w3-padding-32">
            <h3 class="w3-border-bottom w3-border-light-grey">Contactos</h3>
        </div>
        <div class="w3-row w3-center w3-container w3-margin-bottom">
            <div class="w3-col l4 m4 s12 w3-margin-bottom">
               <i class="fa fa-map-marker icone"></i> Rua da Tecnologia, Epsilon 2k, Tecnoparque da Lagoa, Lagoa, Açores
            </div>
            <div class="w3-col l4 m4 s12 w3-margin-bottom">
                <i class="fa fa-phone icone"></i><b> +135</b> 296 123 123
            </div>
            <div class="w3-col l4 m4 s12 w3-margin-bottom">
                <i class="fa fa-envelope icone"></i> azgestaoimobiliaria@mail.com
            </div>
        </div>
    </div>

    <?php include("../../php/footer.php"); ?>
    <?php include("../../php/modals/loginModal.php"); ?>
    <?php include("../../php/modals/signupModal.php"); ?>

</body>
</html>
