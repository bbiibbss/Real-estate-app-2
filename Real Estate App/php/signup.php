<?php
    require_once("userClass.php");
    $client = new USER();

    if(isset($_POST['submit'])) {
        $firstname = trim($_POST['firstname']); 
        $lastname = trim($_POST['lastname']);
        $phone = trim($_POST['phoneNumber']);
        $island = $_POST['island'];
        $county = $_POST['county'];
        $parish = $_POST['parishId'];
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordRepeat = trim($_POST['passwordRepeat']);

        $firstname=str_replace(',', ' ', $firstname);
        $lastname=str_replace(',', ' ', $lastname);
        $island=str_replace(',', ' ', $island);
        $county=str_replace(',', ' ', $county);
        $parish=str_replace(',', ' ', $parish);
        
        if ($firstname=="" || $parish=="" || $lastname=="" || $email=="" || $password=="" || $password!=$passwordRepeat) {
            $error = "Todos os campos são de preenchimento obrigatório!"; 
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Insira um endereço de email válido!';
        }
        else {
            $path="../data/users.csv";
            if(!file_exists($path)){
                $file = fopen($path,"x");
                fclose($file);
            }else{
                if (filesize($path) == 0){
                    $type=1;
                }
                else{
                    $type=3;
                }
                $users = file($path);
                $userlist=array();
                foreach ($users as $user) {
                    array_push($userlist, explode(",", $user));
                }
                foreach ($userlist as $user) {
                    if($user[7]==$email){
                        echo "<script type='text/javascript'>alert('Este email já está a ser utilizado! Por favor, insira outro valor'); window.location.href = '../index.php';</script>";
                        die();
                    }   
                }
                $id=sizeof($users)+1;
                $pass=md5($password);
                if($client->userSignUp($id,$firstname,$lastname,$phone,$island,$county,$parish,$email,$pass,$type)){
                    echo "<script type='text/javascript'>alert('Utilizador criado com sucesso!'); window.location.href = '../index.php'</script>";
                }else{
                    echo "<script type='text/javascript'>alert('Algo correu mal! Tente nocamente mais tarde'); window.location.href = '../index.php'</script>";
                }
            }
        }   
    }
 
?>
