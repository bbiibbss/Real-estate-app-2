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
            ".$property->getAllPropertiesBackendAdmin()."
        </div>
    ";
?>