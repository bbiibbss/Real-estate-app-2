<?php
    return"
        <div id='filterButtonsContainer'>
            <button class='filter-button active' onclick=\"filterSelection('all')\"> TODOS OS ÍMÓVEIS</button>
            <button class='filter-button' onclick=\"filterSelection('featured')\"> ÍMÓVEIS EM DESTAQUE</button>
            <button class='filter-button' onclick=\"filterSelection('requests')\"> PEDIDOS PARA DESTAQUE</button>
            <button class='filter-button' onclick=\"filterSelection('activeProperty')\"> ATIVOS</button>
            <button class='filter-button' onclick=\"filterSelection('notActive')\"> CONCLUÍDOS</button>
        </div>
        <div class='propertiesContainer'>
            <div class='w3-col l4 m6 s12 w3-section add-property' onclick=\"document.getElementById('addPropertyModal').style.display='block'\" style='min-height: 700px;'>
                <div class='w3-display-container w3-center'>
                    <img src='../img/plus.png' style='max-height: 500px; margin-top: 40%;'>
                </div>
            </div>".$property->getAllPropertiesBackendManager().
        "</div>
    ";
?>