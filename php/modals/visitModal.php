<!-- VISIT MODAL -->
<div id="visitModal" class="modal">
    <form enctype="multipart/form-data" accept-charset="utf-8" class="modal-content animate" method="post" action="../../php/visit.php">
        <div class="w3-container" style="background-color:#f1f1f1">
            <span onclick="document.getElementById('visitModal').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
            <input type="hidden" name="userId" value="<?php echo $loggedUserID; ?>">
            <input type="hidden" name="propertyId" value="<?php echo $ppty[0]; ?>">
            <div class="w3-row">
                <div class="w3-col l6 m6 s12">
                    <label><b>Data</b></label>
                    <br>
                    <input style="margin-right: 10px;" type="date" name="visitDate" id="visitDateInput" min='1899-01-01' max='2000-13-13' required>
                </div>
                <div class="w3-col l6 m6 s12">
                    <label><b>Hora</b></label>
                    <br>
                    <input style="margin-left: 10px;" type="time" name="visitTime" required>
                </div> 
            </div>
            <br>
            <br>
            <button class="submitButton" name="submitVisitProposal" type="submit">Propor Visita!</button>
        </div>
    </form>
</div>
<script src="../../js/dateFilter.js"></script>
<script src="../../js/modals.js"></script>