<!-- EDIT USER DATA MODAL -->
<div id="userDataModal" class="modal">
    <form enctype="multipart/form-data" accept-charset="utf-8" class="modal-content animate" method="post" action="../../php/updateUserData.php">
        <div class="w3-container" style="background-color:#f1f1f1">
            <span onclick="document.getElementById('userDataModal').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
            <?php $user->updateUserDataModal($loggedUserID);  ?>
            <button id="updateUserData" name="updateUserData" class="submitButton" type="submit">Alterar dados</button>
        </div>
    </form>
</div>
 <!-- EDIT USER PASSWORD MODAL -->
<div id="userPasswordModal" class="modal">
    <form enctype="multipart/form-data" accept-charset="utf-8" class="modal-content animate" method="post" action="../../php/updateUserData.php">
        <div class="w3-container" style="background-color:#f1f1f1">
            <span onclick="document.getElementById('userPasswordModal').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
            <input type="hidden" name="userId" value="<?php echo $loggedUser[0]; ?>">
            <label><b>Password Atual</b>
            <input type="password" name="oldPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
            <br>
            <label><b>Nova Password</b></label> <div class="tooltip"> <b> ?</b><span class="tooltiptext">A password tem que ter:<br>6 caracteres,<br>uma letra maiúscula,<br>uma letra minúscula,<br>um número!</span></div>
            <input type="password" name="password" id="password" onkeyup="passwordChanged('password');" oninput="validatePassword('password','passwordRepeat');" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
            
            <input type="checkbox" onclick="passwordVisible('password')">Mostrar Password<br>

            <span id="strength"></span><span id="forca"></span><br><br>
            <label><b>Repita a Nova Password</b></label>
            <input type="password" onkeyup="validatePassword('password','passwordRepeat');" name="passwordRepeat" id="passwordRepeat" required>
            <span id="simbolo"></span>
            <span id="iguais"></span>
    
            <br><br>
            <button name="updateUserPassword" class="submitButton" type="submit">Alterar Password</button>
        </div>
    </form>
</div>
<script src="../../js/modals.js"></script>
<script src="../../js/passwordVisible.js"></script>
<script src="../../js/passwordValidation.js"></script>