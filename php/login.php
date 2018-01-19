<?php
    session_start();
    require_once("userClass.php");
    $user = new USER();

    if(isset($_POST['loginEmail'])) {
        $email = $_POST['loginEmail'];
        $pass = md5($_POST['loginPassword']);

        $user->login($email,$pass);
            
        if($user->login($email,$pass)) {
            echo "<script type='text/javascript'>alert('Login realizado com sucesso'); window.location.href = '../index.php';</script>";
        }
        else {
            echo "<script type='text/javascript'>alert('O seu email ou password estão errados.'); window.location.href = '../index.php';</script>";
        }   
    }

?>