<?php

Class User{

	public function __construct(){}

    public function userType(){
        $userID = $_SESSION['user_session'][0];
        $file = file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        foreach ($file as $row) {
           array_push($userslist, explode(",", $row));
        }
        foreach ($userslist as $user) {
            if ($user[0]==$userID) {
                if($user[9]==1){
                    return 1;
                } else if($user[9]==2){
                    return 2;
                } else if($user[9]==3){
                    return 3;
                }
            }  
        }
    }

    public function showToManager($content){
        if ($this->isLoggedin()!="" && $this->userType()==2) {
            return $content;
        }
    }

    public function showToAdmin($content){
        if ($this->isLoggedin()!="" && $this->userType()==1) {
            return $content;
        }
    }
	
	public function userSignUp($id, $firstname, $lastname, $phone, $island, $county, $parish, $email, $password, $type) {
        $file = fopen("../data/users.csv","a");
        $newUser = array($id,$firstname,$lastname,$phone,$island,$county,$parish,$email,$password,$type);
        $newUser=implode(",", $newUser);
        fwrite($file, $newUser."\n");
        fclose($file);
        return true;      
    }

    public function login($email, $password) {
        $userlist=array();
        $users = file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        foreach ($users as $user) {
            array_push($userlist, explode(",", $user));
        }
        foreach ($userlist as $user) {
            if($user[7]==$email && $user[8]==$password){
                $user = array_map("utf8_encode", $user);
                $_SESSION['user_session'] = $user;
                $_SESSION['userID_session'] = $user[0];
                return true;
            }
        }
        return false;
    }

    public function isLoggedin() {
        if(isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }
     
    public function doLogout() {
        session_destroy();
        unset($_SESSION['user_session']);
        unset($_SESSION['userID_session']);
        $this->redirect('../index.php');
        return true;
    }

    public function getLoggedUserData($path,$id){
        $users=file($path."../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($user[0]==$id){
                $user=str_replace('"', '', $user);
                $name=$user[1];
                $surname=$user[2];
                $phone=$user[3];
                $island=$user[4];
                $county=$user[5];
                $parish=$user[6];
                $email=$user[7];
                echo"<p><b>Nome: </b>".$name."</p>
                <p><b>Apelido: </b>".$surname."</p>
                <p><b>Telefone: </b>".$phone."</p>
                <p><b>Ilha: </b>".$island."</p>
                <p><b>Concelho: </b>".$county."</p>
                <p><b>Freguesia: </b>".$parish."</p>
                <p><b>Email: </b>".$email."</p>";
            }
        }   
    }

    public function codePassword($path,$id){
        $users=file($path."../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($user[0]==$id){
                $pass=$user[8];
                $size=strlen($pass);
                $password=array();
                for ($i=1;$i<$size; $i++) {
                    array_push($password, "*");
                }
                echo implode("", $password);
            }
        }
    }

    public function updateLoggedUserData($id, $firstName, $lastName, $phoneNumber, $island, $county, $parish, $email){
        $users = file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        $updatedData=array($id, $firstName, $lastName, $phoneNumber, $island, $county, $parish, $email);
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($id==$user[0]){
                array_splice($user,0,8,$updatedData);
                $newUser=array($user);
                for ($i=0; $i <sizeof($userslist); $i++) { 
                    if($userslist[$i][0]==$id){
                        array_splice($userslist,$i,1, $newUser);
                    }
                }
            } 
        }
        $file=fopen("../data/users.csv", "w");
        foreach ($userslist as $user) {
            $user=implode(',', $user);
            $user=str_replace('"', '', $user);
            fwrite($file, $user);
            $_SESSION['user_session'] = $user;
        }
        fclose($file);
        return true;
    }

    public function updateLoggedUserPassword($id, $oldPassword, $password){
        $users = file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        $password=md5($password);
        $updatedData=array($password);
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($id==$user[0]){
                if($user[8]==md5($oldPassword)){
                    array_splice($user,8,1,$updatedData);
                    $newUser=array($user);
                    for ($i=0; $i <sizeof($userslist); $i++) { 
                        if($userslist[$i][0]==$id){
                            array_splice($userslist,$i,1, $newUser);
                        }
                    }
                }
            }
        }
        $updatedList=array();
        $file=fopen("../data/users.csv", "w");
        foreach ($userslist as $user) {
            $user=implode(',', $user);
            $user=str_replace('"', '', $user);
            fwrite($file, $user);
            $_SESSION['user_session'] = $user;
        }
        fclose($file);
        return true;  
    }

    public function updateUserDataModal($id){
        $users=file("../../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($user[0]==$id){
                $user=str_replace('"', '', $user);
                echo"<input type='hidden' name='userId' value='".$id."'>
            <label><b>Nome</b></label>
            <input type='text' name='firstName' value='".$user[1]."' required>
            <label><b>Sobrenome</b></label>
            <input type='text' name='lastName' value='".$user[2]."' required>
            <label><b>Número de telefone</b></label>
            <input type='number' name='phoneNumber' value='".$user[3]."' required>
            <div class='w3-row'>
                <div class='w3-col l4 m4 s12'>
                    <label><b>Ilha</b></label>
                    <input type='text' name='island' value='".$user[4]."' required> 
                </div>
                <div class='w3-col l4 m4 s12'>
                    <label><b>Concelho</b></label>
                    <input type='text' name='county' value='".$user[5]."' required>
                </div>
                <div class='w3-col l4 m4 s12'>
                    <label><b>Freguesia</b></label>
                    <input type='text' name='parish' value='".$user[6]."' required>
                </div>
            </div>
            <label><b>Email</b></label>
            <input type='text' name='email' value='".$user[7]."' required>";
            }
        }     
    }

    public function getAllUsers($type){
        $users=file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($user[9]==$type){
                echo" <li class='w3-row list-item'>
                
                    <div class='w3-col l1 m6 s12'>
                        <p><b>ID: </b>".$user[0]."</p>
                    </div>
                    <div class='w3-col l2 m6 s12'>
                        <p><b>Nome: </b><a href='#'>".$user[1]." ".$user[2]."</a></p>
                    </div>
                    <div class='w3-col l2 m6 s12'>
                        <p><b>Telefone: </b>".$user[3]."</p>
                    </div>
                    <div class='w3-col l3 m6 s12'>
                        <p><b>Morada: </b>".$user[6].", ".$user[5].", ".$user[4]."</p>
                    </div>
                    <div class='w3-col l3 m6 s12'>
                        <p><b>Email: </b>".$user[7]."</p>
                    </div>
                    <div class='w3-col l1 m6 s12'>";
                if ($type==3) {
                   echo "<form action='../php/manager.php' method='post'>
                            <input type='hidden' name='userID' value='".$user[0]."'>
                            <input type='hidden' name='userType' value='".$type."'>
                            <button type='submit' name='promoteToManager' class='edit-button'><i class='fa w3-xlarge fa-user-plus w3-right'></i></button>
                        </form>";
                } else if ($type==2) {
                    echo "<form action='../php/manager.php' method='post'>
                            <input type='hidden' name='userID' value='".$user[0]."'>
                            <input type='hidden' name='userType' value='".$type."'>
                            <button type='submit' name='promoteToManager' class='edit-button'><i class='fa w3-xlarge fa-user-times w3-right'></i></button>
                        </form>";
                    }
                        
                echo"  
                    </div>
                </li>";
            }
        }   
    }

    public function promoteManager($id, $type){
        $users = file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        $updatedData=array($type."\n");
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($id==$user[0]){
                array_splice($user,9,1,$updatedData);
                $newUser=array($user);
                for ($i=0; $i <sizeof($userslist); $i++) { 
                    if($userslist[$i][0]==$id){
                        array_splice($userslist,$i,1, $newUser);
                    }
                }
            }
        }
        $file=fopen("../data/users.csv", "w");
        foreach ($userslist as $user) {
            $user=implode(',', $user);
            $user=str_replace('"', '', $user);
            fwrite($file, $user);
        }
        fclose($file);
        return true;
    }

    public function addNewRandPropertyManager($userID){
        $properties=file("../data/imoveis.csv",FILE_SKIP_EMPTY_LINES);
        $users=file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $managers=array();
        $final=array();
        foreach ($users as $user) {
           $user=explode(",", $user);
           if ($user[9]==2) {
               array_push($managers, $user[0]);
           }
        }
        $propertyList=array();
        $count=0;
        foreach ($properties as $property) {
            array_push($propertyList, explode(",", $property));
        }
        foreach ($propertyList as $value) {
            $i=(int)$value[1];
            if ($i==$userID) {
                $rand=array_rand($managers,1);
                $newData=$value[0].",".$managers[$rand]."\n";
                array_push($final,$newData);
            }else{
                $oldData=$value[0].",".$i."\n";
                array_push($final,$oldData);
            }
        }
        $file=fopen("../data/imoveis.csv", "w");
        foreach ($final as $key => $row) {
            if($key==array_search(end($final), $final)){
                $row=str_replace("\n", "", $row);
            }
            fwrite($file, $row);
        }
        fwrite($file, "");
        fclose($file);
        return true; 
    }

    public function getAllManagersOptions(){
        $users=file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        $managers=array();
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($userslist as $user) {
            if($user[9]==2){
                echo"<option value='".$user[0]."'>".$user[1]." ".$user[2]."</option>";
            }
        }
    }

    public function updatePropertyManager($propertyID){
        $users=file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $properties=file("../data/imoveis.csv",FILE_SKIP_EMPTY_LINES);
        $userslist=array();
        $propertiesList=array();
        $managers=array();
        foreach ($users as $user) {
            array_push($userslist, explode(",", $user));
        }
        foreach ($properties as $property) {
            array_push($propertiesList, explode(",", $property));
        }
        foreach ($propertiesList as $property) {
            if ($property[0]==$propertyID) {
                $id=$property[1];
            }
        }
        foreach ($userslist as $user) {
            if ($user[9]==2) {
                if ($user[0]==$id) {
                    array_push($managers,"<option value='".$user[0]."' selected>".$user[1]." ".$user[2]."</option>");
                }
                else{
                    array_push($managers,"<option value='".$user[0]."'>".$user[1]." ".$user[2]."</option>");
                }
            }    
        }
        return implode($managers);
    }

    public function managerSales(){
        $table=array();
        $sales=file("../data/sales.csv",FILE_SKIP_EMPTY_LINES);
        $propertiesManagers=file("../data/imoveis.csv",FILE_SKIP_EMPTY_LINES);
        $users=file("../data/users.csv",FILE_SKIP_EMPTY_LINES);
        $saleslist=array();
        $year= date("Y",time());
        foreach ($sales as $sale) {
            $sale= explode(",", $sale);
            foreach ($propertiesManagers as $pm) {
                $pm=explode(",", $pm);
                if ($sale[0]==$pm[0]) {
                    $property=file("../imoveis/".$sale[0]."/".$sale[0].".csv",FILE_SKIP_EMPTY_LINES);
                    $property=explode(",", $property[0]);
                    array_push($saleslist, [$pm[1], $property[10],$sale[1]]);
                }
            }
        }
         array_push($table, "<table><tr><th>Gestor</th><th>Jan</th><th>Fev</th><th>Mar</th><th>Abr</th><th>Mai</th><th>Jun</th><th>Jul</th><th>Ago</th><th>Set</th><th>Out</th><th>Nov</th><th>Dez</th><th>".$year."</th></tr>");
        foreach ($users as $user) {
            $user=explode(",", $user);
            if ($user[9]==2) {
                array_push($table,"<tr><td>".$user[1]." ".$user[2]."</td>");
            
            
                $sumYear=0;
                for ($i=1; $i < 13; $i++) {
                    $sumMonth = 0;
                    foreach($saleslist as $sale) {
                        if ((int)$sale[0]==(int)$user[0] && date("Y", strtotime($sale[2]))==$year && date("m", strtotime($sale[2]))==$i) {
                            $sumYear+=$sale[1];
                            if((int)$sale[0]==(int)$user[0] && date("m", strtotime($sale[2]))==$i){
                                $sumMonth += $sale[1];
                            }
                        }
                    }
                     array_push($table,"<td>".$sumMonth."</td>");
                }
                 array_push($table,"<td>".$sumYear."</td></tr>");
            }
        }
        array_push($table,"</table>");
        return implode($table);
    }

}
?>