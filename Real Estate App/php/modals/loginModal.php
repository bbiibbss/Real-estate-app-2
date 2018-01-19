<!-- LOGIN FORM MODAL -->
<div id="loginModal" class="modal">
    <form enctype="multipart/form-data" accept-charset="utf-8" class="modal-content animate" method="post" action="../../php/login.php">
        <div class="w3-container" style="background-color:#f1f1f1">
            <span onclick="document.getElementById('loginModal').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
            <label><b>Email</b></label>
            <input type="text" name="loginEmail" id="loginEmail" required>
            <label><b>Password</b></label>
            <input type="password" name="loginPassword" id="loginPassword" required>
            <input type="checkbox" onclick="passwordVisible('loginPassword')">Mostrar Password<br><br>
            <button class="buttonLogin" type="submit">Login</button>
        </div>
    </form>
</div>
<script src="../../js/modals.js"></script>
<script src="../../js/passwordVisible.js"></script>