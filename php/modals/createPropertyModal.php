<!-- ADD PROPERTY MODAL -->
    <div id="addPropertyModal" class="modal long-modal">
        <form enctype="multipart/form-data" accept-charset="utf-8" class="modal-content animate" method="post" action="../php/property.php">
            <div class="w3-container" style="background-color:#f1f1f1">
                <span onclick="document.getElementById('addPropertyModal').style.display='none'" class="close">&times;</span>
            </div>
            <div class="container">
                <div class="w3-row">
                    <label><b>Nome:</b></label>
                    <input type="text" name="propertyName" required>
                    <br>
                </div>
                <div class="w3-row">
                    <div class="w3-third" style="padding-right: 4.5px">
                        <label><b>Imagem Principal:</b></label>
                        <br><br>
                        <img id='imgPreview' src='../img/imgPlaceholder.png' style="width:100%;">
                        <br>
                        <input type="file" name="photoToUpload" id="photoToUpload" onchange="previewFile('imgPreview','photoToUpload');">
                    </div>
                    <div class="w3-twothird w3-center" style="padding-left: 4.5px">
                        <label><b>Galeria de imagens:</b></label><br>
                        <button type="button" id="addPhoto">Adicional foto à galeria</button>
                        <br><br>
                        <div class="w3-row w3-padding" id="gallery">
                        </div>
                    </div>
                </div>
                <br>
                <div class="w3-row">
                    <div class="w3-half" style="padding-right: 4.5px">
                        <label><b>Tipo:</b></label>
                        <select name="propertyType" required>
                            <option name="propertyType" selected disabled>Selecione um tipo</option>
                            <?php $property->getAllPropertyTypes(); ?>
                        </select>
                    </div>
                    <div class="w3-half" style="padding-left: 4.5px">
                        <label><b>Tipologia:</b></label>
                        <select name="propertyTypology" required>
                            <option name="propertyTypology" selected disabled>Selecione uma tipologia</option>
                            <?php $property->getAllPropertyTypologies(); ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="w3-row">
                    <div class="w3-third" style="padding-right: 3px">
                        <label><b>Gestor Responsável</b></label>
                        <select name="manager" required>
                            <option name="manager" selected disabled>Selecione um gestor</option>
                            <?php $user->getAllManagersOptions(); ?>
                        </select>
                    </div>
                    <div class="w3-third" style="padding: 0 3px">
                        <label><b>Negócio:</b></label>
                        <select name="propertyBusinessType" required>
                            <option name="propertyBusinessType" selected disabled>Selecione uma negócio</option>
                            <?php $property->getAllPropertyBusinessTypes();  ?>
                        </select>
                    </div>
                    <div class="w3-third" style="padding-left:3px">
                        <label><b>Preço</b></label>
                        <input type="text" name="propertyPrice" required>
                    </div>
                </div>
                <br>
                <div class="w3-row">
                    <div class="w3-third" style="padding-right: 6px">
                        <label><b>Área:</b></label>
                        <input type="text" name="propertyArea" required>
                    </div>
                    <div class="w3-third" style="padding: 0 3px">
                        <label><b>Quartos:</b></label>
                        <input type="number" name="propertyBedrooms" required>
                    </div>
                    <div class="w3-third" style="padding-left: 6px">
                        <label><b>Casas de Banho:</b></label>
                        <input type="number" name="propertyBathrooms" required>
                    </div>
                </div>
                <br>
                <div class="w3-row">
                    <div class="w3-third" style="padding-right: 6px">
                        <label><b>Ilha</b></label>
                        <?php $property->getAllPropertyIslands(); ?>
                    </div>
                    <div class="w3-third" style="padding: 0 3px">
                        <label><b>Concelho</b></label>
                        <?php $property->getAllPropertyCounties(); ?>
                    </div>
                    <div class="w3-third" style="padding-left: 6px">
                        <label><b>Freguesia</b></label>
                        <?php $property->getAllPropertyParishes(); ?>
                    </div>
                </div>
                <br>
                <label><b>Descrição</b></label>
                <textarea name="propertyDescription" style="width: 100%" rows="5"></textarea>
                <br><br>
                <button type="submit" name="createProperty" class="buttonLogin">Criar</button>
            </div>
        </form>
    </div>
    