<?php
    return"
        <div class='w3-container w3-padding-16'>
            <h3 class='w3-border-bottom w3-border-light-grey w3-padding-16'>Estatísticas</h3>
        </div>
        <div class='w3-row-padding w3-center'>
            <div class='tab w3-row'>
                <button class='tablinks w3-col l3 m3 s3' onclick=\"openContent(event, 'salesByManager')\" id='defaultOpen'><h5>Vendas por Gestor</h5></button>
                <button class='tablinks w3-col l3 m3 s3' onclick=\"openContent(event, 'propertiesByLocalization')\"><h5>Imóveis por localização</h5></button>
                <button class='tablinks w3-col l3 m3 s3' onclick=\"openContent(event, 'propertiesByType')\"><h5>Imóveis por Tipo</h5></button>
                <button class='tablinks w3-col l3 m3 s3' onclick=\"openContent(event, 'propertiesByPrice')\"><h5>Imóveis por Intervalo de Preço</h5></button>
            </div>
            <div id='salesByManager' class='tabcontent'>
                <br>
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6' style='padding-right: 5px;'>
                        <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                            <input type='hidden' name='salesByManagerTable' value='".$user->managerSales()."'>
                            <button class='submitButton' type='submit' name='salesByManagerPDF'> <i class='fa fa-download'></i> PDF</button>
                        </form>
                    </div>
                    <div class='w3-col l6 m6 s6' style='padding-left: 5px;'>
                        <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                            <input type='hidden' name='salesByManagerTable' value='".$user->managerSales()."'>
                            <button class='submitButton' type='submit' name='salesByManagerCSV'> <i class='fa fa-download'></i> CSV</button>
                        </form>
                    </div>
                </div>
                <br>
                ".$user->managerSales()."
            </div>
            <div id='propertiesByLocalization' class='tabcontent'>
                <br>
                <div class='w3-row'>
                    <div class='w3-col l4 m6 s12 w3-padding'>
                        <h4>Imóveis por Ilha</h4>
                        <div class='w3-row'>
                            <div class='w3-col l6 m6 s6' style='padding-right: 5px;'>
                                <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                                    <input type='hidden' name='propertiesByIslandTable' value='".$property->getPropertiesByIsland()."'>
                                    <button class='submitButton' type='submit' name='propertiesByIslandPDF'> <i class='fa fa-download'></i> PDF</button>
                                </form>
                            </div>
                            <div class='w3-col l6 m6 s6' style='padding-left: 5px;'>
                                <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                                    <input type='hidden' name='propertiesByIslandTable' value='".$property->getPropertiesByIsland()."'>
                                    <button class='submitButton' type='submit' name='propertiesByIslandCSV'> <i class='fa fa-download'></i> CSV</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        ".$property->getPropertiesByIsland()."
                    </div>
                    <div class='w3-col l4 m6 s12 w3-padding'>
                        <h4>Imóveis por Concelho</h4>
                        <div class='w3-row'>
                            <div class='w3-col l6 m6 s6' style='padding-right: 5px;'>
                                <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                                    <input type='hidden' name='propertiesByCountyTable' value='".$property->getPropertiesByCounty()."'>
                                    <button class='submitButton' type='submit' name='propertiesByCountyPDF'> <i class='fa fa-download'></i> PDF</button>
                                </form>
                            </div>
                            <div class='w3-col l6 m6 s6' style='padding-left: 5px;'>
                                <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                                    <input type='hidden' name='propertiesByCountyTable' value='".$property->getPropertiesByCounty()."'>
                                    <button class='submitButton' type='submit' name='propertiesByCountyCSV'> <i class='fa fa-download'></i> CSV</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        ".$property->getPropertiesByCounty()."
                    </div>
                    <div class='w3-col l4 m6 s12 w3-padding'>
                        <h4>Imóveis por Freguesia</h4>
                        <div class='w3-row'>
                            <div class='w3-col l6 m6 s6' style='padding-right: 5px;'>
                                <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                                    <input type='hidden' name='propertiesByParishTable' value='".$property->getPropertiesByParish()."'>
                                    <button class='submitButton' type='submit' name='propertiesByParishPDF'> <i class='fa fa-download'></i> PDF</button>
                                </form>
                            </div>
                            <div class='w3-col l6 m6 s6' style='padding-left: 5px;'>
                                <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                                    <input type='hidden' name='propertiesByParishTable' value='".$property->getPropertiesByParish()."'>
                                    <button class='submitButton' type='submit' name='propertiesByParishCSV'> <i class='fa fa-download'></i> CSV</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        ".$property->getPropertiesByParish()."
                    </div>
                </div>
            </div>
            <div id='propertiesByType' class='tabcontent'>
                <br>
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6' style='padding-right: 5px;'>
                        <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                            <input type='hidden' name='propertiesByTypeTable' value='".$property->getPropertiesByType()."'>
                            <button class='submitButton' type='submit' name='propertiesByTypePDF'> <i class='fa fa-download'></i> PDF</button>
                        </form>
                    </div>
                    <div class='w3-col l6 m6 s6' style='padding-left: 5px;'>
                        <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                            <input type='hidden' name='propertiesByTypeTable' value='".$property->getPropertiesByType()."'>
                            <button class='submitButton' type='submit' name='propertiesByTypeCSV'> <i class='fa fa-download'></i> CSV</button>
                        </form>
                    </div>
                </div>
                <br>
                ".$property->getPropertiesByType()."
            </div>
            <div id='propertiesByPrice' class='tabcontent'>
                <br>
                <div class='w3-row'>
                    <div class='w3-col l6 m6 s6' style='padding-right: 5px;'>
                        <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                            <input type='hidden' name='propertiesByPriceRangeTable' value='".$property->getPropertiesByPriceRange()."'>
                            <button class='submitButton' type='submit' name='propertiesByPriceRangePDF'> <i class='fa fa-download'></i> PDF</button>
                        </form>
                    </div>
                    <div class='w3-col l6 m6 s6' style='padding-left: 5px;'>
                        <form enctype='multipart/form-data' accept-charset='utf-8' method='post' action='../php/statsFileCreator.php'>
                            <input type='hidden' name='propertiesByPriceRangeTable' value='".$property->getPropertiesByPriceRange()."'>
                            <button class='submitButton' type='submit' name='propertiesByPriceRangeCSV'> <i class='fa fa-download'></i> CSV</button>
                        </form>
                    </div>
                </div>
                <br>
                ".$property->getPropertiesByPriceRange()."
            </div>
        </div>
        <script src='../js/tabs.js'></script>
    ";
?>