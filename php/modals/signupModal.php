<!-- SIGNUP FORM MODAL -->
<div id="signupModal" class="modal long-modal">
    <form enctype="multipart/form-data" accept-charset="utf-8" class="modal-content animate" method="post" action="../../php/signup.php">
        <div class="w3-container" style="background-color:#f1f1f1">
            <span onclick="document.getElementById('signupModal').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
            <div class="w3-row">
                <div class="w3-half" style="padding-right: 4.5px">
                    <label><b>Nome</b></label>
                    <input type="text" name="firstname" id="firstname" pattern="[^0-9]+" required>
                </div>
                <div class="w3-half" style="padding-left: 4.5px">
                    <label><b>Sobrenome</b></label>
                    <input type="text" name="lastname" id="lastname" pattern="[^0-9]+" required>
                </div>
            </div>
            <br>
            <div class="w3-row">
                <div class="w3-half" style="padding-right: 4.5px">
                   <label><b>Email</b></label>
                    <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" required>
                </div>
                <div class="w3-half" style="padding-left: 4.5px">
                    <label><b>Número de telefone</b></label>
                    <input type="number"  name="phoneNumber" id="phoneNumber" pattern="[0-9]+" required>
                </div>
            </div>
            <div class="w3-row">
                <div class="w3-third" style="padding-right: 6px">
                    <label><b>Ilha</b></label>
                    <input type="text" name="island" id="island" required>
                </div>
                <div class="w3-third" style="padding: 0 3px">
                    <label><b>Concelho</b></label>
                    <input type="text" name="county" id="county" required>
                </div>
                <div class="w3-third" style="padding-left: 6px">
                    <label><b>Freguesia</b></label>
                    <input type="text" name="parishId" id="parishId" required>
                </div>
            </div>
            <label><b>Password</b></label> <div class="tooltip"> <b> ?</b><span class="tooltiptext">A password tem que ter:<br>6 caracteres,<br>uma letra maiúscula,<br>uma letra minúscula,<br>um número!</span></div>
            <input type="password" name="password" id="password" onkeyup="passwordChanged('password');" oninput="validatePassword('password','passwordRepeat');" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
            
            <input type="checkbox" onclick="passwordVisible('password');">Mostrar Password<br>

            <span id="strength"></span><span id="forca"></span><br><br>
            <label><b>Repita a Password</b></label>
            <input type="password" onkeyup="validatePassword('password','passwordRepeat');" name="passwordRepeat" id="passwordRepeat" required>
            <span id="simbolo"></span>
            <span id="iguais"></span>
    
            <br><br>
            <button type="submit" name="submit" class="buttonLogin">Inscrever-se</button>
        </div>
    </form>
</div>
<script src="../../js/modals.js"></script>
<script src="../../js/passwordVisible.js"></script>
<script src="../../js/passwordValidation.js"></script>