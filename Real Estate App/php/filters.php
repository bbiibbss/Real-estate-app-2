<!-- FILTERS -->
    <div id="filterSidenav" class="filterSidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <button style="width: 100%;" class="accordion">Tipo de negócio:</button>
            <div class="panel">
                <?php $property->getBusinessTypeFilters(); ?>
            </div>
            <button style="width: 100%; " class="accordion">Tipo do Imóvel:</button>
            <div class="panel">
                <?php $property->getPropertyTypeFilters(); ?>
            </div>
            <button style="width: 100%; " class="accordion">Tipologia do Imóvel:</button>
            <div class="panel">
                <?php $property->getPropertyTypologyFilters(); ?>
            </div>
            <button style="width: 100%; " class="accordion">Intervalo de preço:</button>
            <div class="panel">
                <input onchange="filterSystem('<?php echo($property->minPrice());?>', '<?php echo($property->maxPrice());?>', 'minPrice', 'maxPrice', 'price');" type="number" id="minPrice" name="minPrice" value="" min="<?php echo($property->minPrice());?>" placeholder="Preço mínimo" max="<?php echo($property->maxPrice());?>">
                <br><br>
                <input onchange="filterSystem('<?php echo($property->minPrice());?>', '<?php echo($property->maxPrice());?>', 'minPrice', 'maxPrice', 'price');" type="number" id="maxPrice" name="maxPrice" value="" min="<?php echo($property->minPrice());?>" placeholder="Preço máximo" max="<?php echo($property->maxPrice());?>">
                <br><br>
            </div>
            <button style="width: 100%; " class="accordion">Área:</button>
            <div class="panel">
                <input onchange="filterSystem('<?php echo($property->minArea());?>', '<?php echo($property->maxArea());?>', 'minArea', 'maxArea', 'area');" type="number" id="minArea" name="minArea" value="" min="<?php echo($property->minArea());?>" placeholder="Área mínima" max="<?php echo($property->maxArea());?>">
                <br><br>
                <input onchange="filterSystem('<?php echo($property->minArea());?>', '<?php echo($property->maxArea());?>', 'minArea', 'maxArea', 'area');" type="number" id="maxArea" name="maxArea" value="" min="<?php echo($property->minArea());?>" placeholder="Área Máxima" max="<?php echo($property->maxArea());?>">
                <br><br>
            </div>
            <br>
            <p style="padding: 18px;">Localização:</p>
            <button style="width: 100%; " class="accordion">Ilha:</button>
            <div class="panel">
                <?php $property->getIslandFilters(); ?> 
            </div>
            <button style="width: 100%; " class="accordion">Concelho:</button>
            <div class="panel">
                <?php $property->getCountyFilters(); ?>
            </div>
            <button style="width: 100%; " class="accordion">Freguesia:</button>
            <div class="panel">
                <?php $property->getParishFilters(); ?>
            </div>
    </div>
    <script src="../../js/accordionPropertyFilters.js"></script>