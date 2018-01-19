<?php

require_once('userClass.php');

Class Property{

    private $user;

    public function showToLoggedUser($user,$content){
        if ($user->isLoggedin()!="") {
            return $content;
        }
    }

    public function getAllProperties(){
        $dir="../../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $description = file_get_contents($folder."/".$id.".txt");
            $description = mb_convert_encoding($description, "UTF-8", "auto");
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                if($property[8]==1){
                    $_SESSION['property'] = $property;
                    echo"
                    <div class='w3-col l3 m6 s12 w3-margin-bottom propertyShow' id='propertyShow' ".$this->propertyFilterTags($property[0]).">
                        <div class='w3-display-container'>
                            <div style='max-height: 200px; overflow: hidden;'>
                                <img src='".$folder."/".$property[1]."' class='property-thumbnail'>
                            </div>
                            <div style='min-height: 280px;' class='dark w3-padding'>
                                <h4>".$property[2]."</h4>
                                <hr>
                                <p>".$this->getPropertyBusinessType($property[7],'../')."</p>
                                <p>".$this->getPropertyType($property[5],'../')."</p>
                                <p>".$this->getCountyIslandParish($property[9],'../')."</p>
                                <p>".$property[10]."€</p>
                            </div>
                            <a target='_blank' href='detalhes.php?id=".$property[0]."'><button class='seeMoreButton'>VER MAIS</button></a>
                        </div>
                    </div>
                    ";
                }
            }
        }
    }

    public function getAllFeaturedProperties(){
        $dir="../../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $filePath=$folder."/";
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $description = file_get_contents($folder."/".$id.".txt");
            $description = mb_convert_encoding($description, "UTF-8", "auto");
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                if($property[8]==1){
                    $featuredFile=file("../../data/featured.csv",FILE_SKIP_EMPTY_LINES);
                    $featureList = array();
                    foreach ($featuredFile as $featured) {
                        array_push($featureList, explode(",", $featured));
                    }
                    foreach ($featureList as $featured) {
                        if ((int)$featured[0]==(int)$property[0]) {
                            $_SESSION['property'] = $property;
                            echo"
                            <div class='w3-col l3 m6 s12 w3-margin-bottom propertyShow'>
                                <div class='w3-display-container'>
                                    <div style='max-height: 200px; overflow: hidden;'>
                                        <img src='".$folder."/".$property[1]."' class='property-thumbnail'>
                                    </div>
                                    <div style='min-height: 280px;' class='dark w3-padding'>
                                        <h4>".$property[2]."</h4>
                                        <hr>
                                        <p>".$this->getPropertyBusinessType($property[7],'../')."</p>
                                        <p>".$this->getPropertyType($property[5],'../')."</p>
                                        <p>".$this->getCountyIslandParish($property[9],'../')."</p>
                                        <p>".$property[10]." €</p>
                                    </div>
                                    <a target='_blank' href='detalhes.php?id=".$property[0]."'><button class='seeMoreButton'>VER MAIS</button></a>
                                </div>
                            </div>
                            ";
                        }
                    }
                }
            }
        }
    }

    public function getCountyIslandParish($parishID, $path){
        $parishes = file($path."../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $parishesList=array();
        foreach ($parishes as $parish) {
            array_push($parishesList, explode(",", $parish));
        }
        foreach ($parishesList as $parish) {
            $parish = array_map("utf8_encode", $parish);
            if ($parish[0] == $parishID) {
                $countyID=$parish[1];
                $parishName=$parish[2];

                $counties = file($path."../data/county.csv",FILE_SKIP_EMPTY_LINES);
                $countiesList=array();
                foreach ($counties as $county) {
                    array_push($countiesList, explode(",", $county));
                }
                foreach ($countiesList as $county) {
                    $county = array_map("utf8_encode", $county);
                    if ($countyID==$county[0]) {
                        $islandID=$county[1];
                        $countyName=$county[2];
                    
                        $islands = file($path."../data/island.csv",FILE_SKIP_EMPTY_LINES);
                        $islandsList=array();
                        foreach ($islands as $island) {
                            array_push($islandsList, explode(",", $island));
                        }
                        foreach ($islandsList as $island) {
                            $island = array_map("utf8_encode", $island);
                            if ($islandID==$island[0]) {
                                $islandName=$island[1];
                            }
                        }
                    }
                }
            }
        }
        return $parishName.", ".$countyName.", ".$islandName;
    }

    public function getPropertyType($pptType, $path){
        $propertyTypes = file($path."../data/propertyType.csv",FILE_SKIP_EMPTY_LINES);
        $propertyTypesList=array();
        foreach ($propertyTypes as $propertyType) {
            array_push($propertyTypesList, explode(",", $propertyType));
        }
        foreach ($propertyTypesList as $propertyType) {
            if($propertyType[0]==$pptType){
                $propertyType = array_map("utf8_encode", $propertyType);
                $pptTypeName=$propertyType[1];
                if ($pptType=="n") {
                    $pptTypeName="";
                }
            }
        }
        return  $pptTypeName;
    }

    public function getPropertyTypology($pptTypology, $path){
        $propertyTypologies = file($path."../data/propertyTypology.csv",FILE_SKIP_EMPTY_LINES);
        $propertyTypologiesList=array();
        foreach ($propertyTypologies as $propertyTypology) {
            array_push($propertyTypologiesList, explode(",", $propertyTypology));
        }
        foreach ($propertyTypologiesList as $propertyTypology) {
            if($propertyTypology[0]==$pptTypology){
                $propertyTypology = array_map("utf8_encode", $propertyTypology);
                if ($pptTypology==8) {
                    $pptTypologyName='Não se Aplica';
                }else{
                    $pptTypologyName=$propertyTypology[1];
                }
            }
        }
        return  $pptTypologyName;
    }

    public function getPropertyBusinessType($propertyBusinessType, $path){
        $businessTypes = file($path."../data/businessType.csv",FILE_SKIP_EMPTY_LINES);
        $businessTypeList=array();
        foreach ($businessTypes as $businessType) {
            array_push($businessTypeList, explode(",", $businessType));
        }
        foreach ($businessTypeList as $businessType) {
            if($businessType[0]==$propertyBusinessType){
                $businessType = array_map("utf8_encode", $businessType);
                $businessTypeName=$businessType[1];
            }
        }
        return  $businessTypeName; 
    }

    public function getPropertyDetails($property, $loggedUser){
        $property=explode(",", $property);
        $path = "../../imoveis/".$property[0]."/";
        $description = file_get_contents($path.$property[0].".txt");
        $description = mb_convert_encoding($description, "UTF-8", "auto");

        $visit="<div class='w3-row'><input type='hidden' name='userId' value=''><input type='hidden' name='propertyId' value=''><input type='submit' value='Marcar Visita' onclick=\"document.getElementById('visitModal').style.display='block'\" class='submitButton'></div>";
        echo "
        <div class='w3-row w3-padding-large'>
            <h2>REF:".$property[0]." - ".$property[2]."</h2>
            <div class='w3-col l6 m12 s12'>
                ".$this->detailsSliderMainImage($property[0])."
                <div class='w3-row w3-section'>
                    ".$this->detailsSliderDots($property[0])."
                </div>
            </div>
            <div class='w3-col l6 m12 s12 w3-padding'>
                <div class='w3-row'>
                    <h3><b>Detalhes:</b></h3>
                    <div class='w3-col l4 m4 s12'>
                        <p><b>Negócio:</b> ".$this->getPropertyBusinessType($property[7],'../')."</p>
                        <br><br>
                        <p><b>Preço:</b> ".$property[10]." €</p>
                        <br><br>
                        <p><b>Tipo:</b> ".$this->getPropertyType($property[5],'../')."</p>
                        <br><br>
                        <p><b>Tipologia:</b> ".$this->getPropertyTypology($property[6],'../')."</p>
                    </div>
                    <div class='w3-col l8 m8 s12'>
                        <p><b>Área:</b> ".$property[4]." m<sup>2</sup></p>
                        <br><br>
                        <p><b>Localização:</b> ".$this->getCountyIslandParish($property[9], '../')."</p>
                        <br><br>
                        <p><i class='fa fa-bed'></i> ".$property[11]."</p>
                        <br><br>
                        <p><i class='fa fa-bath'></i> ".$property[12]."</p>
                    </div>
                </div>
            </div>
            <div class='w3-row'>
                <h3><b>Descrição:</b></h3>
                <p>".utf8_decode($description)."</p>
            </div>
            <br><br>".$this->showToLoggedUser($loggedUser, $visit)."
        </div>
        ";
    }

    public function detailsSliderMainImage($propertyID){
        $path = "../../imoveis/".$propertyID."/";
        $images = file($path."images.csv",FILE_SKIP_EMPTY_LINES);
        $imagesList=array();
        foreach ($images as $image) {
            array_push($imagesList, explode(",", $image));
        }
        $dots=array();
        foreach ($imagesList as $image) {
            $dot= "
                <div class='w3-display-container mySlides'>
                    <img src='".$path.$image[0]."' style='width:100%'>
                    <div class='w3-display-bottomleft w3-container w3-black'>
                        <p>".$image[1]."</p>
                    </div>
                </div>
            ";
            array_push($dots, $dot);
        }
        return implode($dots);
    }

    public function detailsSliderDots($propertyID){
        $path = "../../imoveis/".$propertyID."/";
        $images = file($path."images.csv",FILE_SKIP_EMPTY_LINES);
        $imagesList=array();
        foreach ($images as $image) {
            array_push($imagesList, explode(",", $image));
        }
        $dots=array();
        $current=1;
        foreach ($imagesList as $image) {
            $dot="
            <div class='w3-col l2 m2 s2' style='height:70px; overflow:hidden;'>
                <img class='demo w3-opacity w3-hover-opacity-off' src='".$path.$image[0]."' style='width:100%;cursor:pointer' onclick='currentDiv(".$current.")'' title='".$image[1]."'>
            </div>";
            $current+=1;
            array_push($dots, $dot);
        }
        return implode($dots);
    }

    public function previewEditGallery($propertyID){
        $path = "../imoveis/".$propertyID."/";
        $images = file($path."images.csv",FILE_SKIP_EMPTY_LINES);
        $imagesList=array();
        foreach ($images as $image) {
            array_push($imagesList, explode(",", $image));
        }
        $dots=array();
        $current=1;
        foreach ($imagesList as $image) {
            $dot="
            <div class='w3-col l4 m6 s6 updateImageCol' onclick=\"document.getElementById('editImage".$image[0]."').style.display='block'\" style='height:130px;'>
                <div style='width:100%; height:100px; overflow:hidden;' class='w3-padding'>
                    <img src='".$path.$image[0]."' style='width:100%;'>
                </div>
                <label>".$image[1]."</label>
            </div>

            <div id='editImage".$image[0]."' class='modal long-modal'>
                <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                    <input type='hidden' name='prevImage' value='".$image[0]."'>
                    <input type='hidden' name='prevDesc' value='".$image[1]."'>
                    <input type='hidden' name='propertyId' value='".$propertyID."'>
                    <div class='w3-container' style='background-color:#f1f1f1'>
                        <span onclick=\"document.getElementById('editImage".$image[0]."').style.display='none'\" class='close'>&times;</span>
                    </div>
                    <div class='container'>
                        <div class='w3-row'>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <img id='imgPreview".$current.$current."' src='".$path.$image[0]."' style='width:100%;''>
                                <br><br>
                                <input type='file' id='newImage".$current.$current."' name='photoToUpload' onchange=\"previewFile('imgPreview".$current.$current."','newImage".$current.$current."');\">

                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <label><b>Descrição:</b></label><br><br>
                                <input type='text' name='updatedImageDescription' value='".$image[1]."'>
                            </div>
                        </div>
                        <br><br><br>
                        <div class='w3-row-padding'>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='updatePropertyImage' type='submit' class='submitButton'>EDITAR</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('deleteImage".$image[0]."').style.display='block'\">ELIMINAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id='deleteImage".$image[0]."' class='modal long-modal'>
                <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                    <div class='w3-container' style='background-color:#f1f1f1'>
                        <span onclick=\"document.getElementById('deleteImage".$image[0]."').style.display='none'\" class='close'>&times;</span>
                    </div>
                    <div class='container w3-row-padding'>
                        <input type='hidden' name='image' value='".$image[0]."'>
                        <input type='hidden' name='propertyId' value='".$propertyID."'>
                        <p>Tem a certeza que deseja eliminar este conteúdo?</p>
                        <div class='w3-half' style='padding-right: 4.5px'>
                            <button name='deletePropertyImage' type='submit' class='submitButton'>SIM</button>
                        </div>
                        <div class='w3-half' style='padding-left: 4.5px'>
                            <button type='button' class='submitButton' onclick=\"document.getElementById('deleteImage".$image[0]."').style.display='none'\">NÃO</button>
                        </div>
                    </div>
                </form>
            </div>
            ";
            $current+=1;
            array_push($dots, $dot);
        }
        return implode($dots);
    }

    public function getAllPropertiesBackendManager(){
        $this->user = new User();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        $list=array();
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $description = file_get_contents($folder."/".$id.".txt");
            $description = mb_convert_encoding($description, "UTF-8", "auto");
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                $property = array_map("utf8_encode", $property);
                $ppt="
                <div class='w3-col l4 m6 s12 w3-section w3-padding-small filterDiv ".$this->adminFilterProperties($property[0])."''>
                    <div class='w3-display-container w3-card' style='min-height: 700px;'>
                        <div class='w3-row'>
                            <div class='w3-col l1 m3 s3 w3-padding'>
                                <p onclick=\"document.getElementById('editPropertyModal".$property[0]."').style.display='block'\"><i class='fa fa-pencil edit-button'></i></p>
                            </div>
                            <div class='w3-col l5 m3 s3 w3-padding'>
                                <form>
                                    <input type='hidden' name='propertyID' value='".$property[0]."'>
                                        ".$this->getPropertyStatus($property[8], $property[0])."
                                </form>
                            </div>
                            <div class='w3-col l5 m3 s3 w3-padding'>
                                ".$this->getFeaturedProposalStatus($property[0])."
                            </div>
                            <div class='w3-col l1 m3 s3 w3-padding'>
                                <p onclick=\"document.getElementById('deleteProperty".$property[0]."').style.display='block'\"><i class='fa fa-remove edit-button'></i></p>
                            </div>
                        </div>
                        <div class='w3-row-padding'>
                            <div class='w3-col l6 m12 s12'>
                                <p>REF:".$property[0]."</p>
                                <p>".utf8_decode($property[2])."</p>
                                <p>".$this->getPropertyBusinessType($property[7],'')."</p>
                                <p>".$property[10]." €</p>
                                <p>".$this->getCountyIslandParish($property[9],'')."</p>
                            </div>
                            <div class='w3-col l6 m12 s12'>
                                <p>".$this->getPropertyType($property[5],'')."</p>
                                <p>".$this->getPropertyTypology($property[6],'')."</p>
                                <p>".$property[4]." m<sup>2</sup></p>
                                <p><i class='fa fa-bed'></i> ".$property[11]."</p>
                                <p><i class='fa fa-bath'></i> ".$property[12]."</p>
                            </div>
                            <div class='w3-row'>
                                <div style='height: 200px; overflow-y: scroll;'>
                                    <p>".utf8_decode($description)."</p>
                                </div>
                            </div>
                            <div class='w3-row'>
                                <div style='height: 200px; overflow-y: scroll;'> 
                                    <div class='w3-col l4 m6 s6 updateImageCol w3-center' onclick=\"document.getElementById('addNewImageModal".$property[0]."').style.display='block';\" style='height:130px;'>
                                        <img src='../img/plus.png' style='width:85%;'>
                                    </div>
                                    ".$this->previewEditGallery($property[0])."
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id='editPropertyModal".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <input type='hidden' name='status' value='".$property[8]."'>
                        <input type='hidden' name='id' value='".$property[0]."'>
                        <input type='hidden' name='image' value='".$property[1]."'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('editPropertyModal".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container'>
                            <div class='w3-row'>
                                <div class='w3-third' style='padding-right: 3px'>
                                    <label><b>Nome:</b></label>
                                    <input type='text' name='propertyName' value='".utf8_decode($property[2])."' required>
                                </div>
                                <div class='w3-third' style='padding: 0 3px'>
                                    <label><b>Tipo:</b></label>
                                    <select name='propertyType' required>
                                        ".$this->updatePropertyType($property[5])."
                                    </select>
                                </div>
                                <div class='w3-third' style='padding-left: 3px'>
                                    <label><b>Tipologia:</b></label>
                                    <select name='propertyTypology' required>
                                        ".$this->updatePropertyTypology($property[6])."
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='w3-row'>
                                <div class='w3-third' style='padding-right: 4.5px'>
                                    <label><b>Gestor Responsável:</b></label>
                                    <select name='updateManager' required>
                                        ".$this->user->updatePropertyManager($property[0])."
                                    </select>
                                </div>
                                <div class='w3-third' style='padding-right: 4.5px'>
                                    <label><b>Negócio:</b></label>
                                    <select name='propertyBusinessType' required>
                                        ".$this->updatePropertyBusinessType($property[7])."
                                    </select>
                                </div>
                                <div class='w3-third' style='padding-left: 4.5px'>
                                    <label><b>Preço</b></label>
                                    <input type='text' name='propertyPrice' value='".$property[10]."' required>
                                </div>
                            </div>
                            <br>
                            <div class='w3-row'>
                                <div class='w3-third' style='padding-right: 6px'>
                                    <label><b>Área:</b></label>
                                    <input type='text' name='propertyArea' value='".$property[4]."' required>
                                </div>
                                <div class='w3-third' style='padding: 0 3px'>
                                    <label><b>Quartos:</b></label>
                                    <input type='number' name='propertyBedrooms'  value='".$property[11]."' required>
                                </div>
                                <div class='w3-third' style='padding-left: 6px'>
                                    <label><b>Casas de Banho:</b></label>
                                    <input type='number' name='propertyBathrooms' value='".$property[12]."' required>
                                </div>
                            </div>
                            <br>
                            <div class='w3-row'>
                                ".$this->updatePropertyParish($property[9])."
                            </div>
                            <br><br>
                            <label><b>Descrição</b></label>
                            <textarea name='propertyDescription' style='width: 100%' rows='5'>".utf8_decode($description)."</textarea>
                            <br><br>
                            <button type='submit' name='updateProperty' class='buttonLogin'>EDITAR</button>
                        </div>
                    </form>
                </div>

                <div id='deleteProperty".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('deleteProperty".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container w3-row-padding'>
                        <input type='hidden' name='id' value='".$property[0]."'>
                            <p>Tem a certeza que deseja eliminar este conteúdo?</p>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='deleteProperty' type='submit' class='submitButton'>SIM</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('deleteProperty".$property[0]."').style.display='none'\">NÃO</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id='updatePropertyStatus".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('updatePropertyStatus".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container w3-row-padding'>
                        <input type='hidden' name='id' value='".$property[0]."'>
                        <input type='hidden' name='status' value='".$property[8]."'>
                            <p>Tem a certeza que deseja alterar o estado desteimóvel?</p>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='updatePropertyStatus' type='submit' class='submitButton'>SIM</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('updatePropertyStatus".$property[0]."').style.display='none'\">NÃO</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id='createFeaturedRequest".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('createFeaturedRequest".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container w3-row-padding'>
                            <input type='hidden' name='propertyID' value='".$property[0]."'>
                            <p>Tem a certeza que deseja propor este imóvel?</p>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='createFeaturedRequest' type='submit' class='submitButton'>SIM</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('updatePropertyStatus".$property[0]."').style.display='none'\">NÃO</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id='addNewImageModal".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('addNewImageModal".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container'>
                            <div class='w3-row'>
                                <div class='w3-col l5 m5 s12' style='padding-right: 4.5px'>
                                    <input type='hidden' name='propertyId' value='".$id."'>
                                    <img id='previewNewImage".$property[0]."' src='../img/imgPlaceholder.png' style='width:100%;'>
                                    <br><br>
                                    <input type='file' id='addPropertyNewPhoto".$property[0]."' name='addPropertyNewPhoto' onchange=\"previewFile('previewNewImage".$property[0]."','addPropertyNewPhoto".$property[0]."');\">
                                </div>
                                <div class='w3-col l7 m7 s12' style='padding-left: 4.5px'>
                                    <label><b>Descrição:</b></label><br><br>
                                    <input type='text' name='newImageDescription'>
                                </div>
                            </div>
                            <br><br><br>
                            <div class='w3-row-padding'>
                                <button name='addNewPropertyImage' type='submit' class='submitButton'>ADICIONAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                ";
                array_push($list, $ppt);
            }
        }
        return implode($list);
    }

    public function getAllPropertiesBackendAdmin(){
        $dir="../imoveis/*";
        $dirs = glob($dir);
        $list=array();
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $description = file_get_contents($folder."/".$id.".txt");
            $description = mb_convert_encoding($description, "UTF-8", "auto");
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                $property = array_map("utf8_encode", $property);
                $ppt="
                <div class='w3-col l4 m6 s12 w3-section w3-padding-small filterDiv ".$this->adminFilterProperties($property[0])."'>
                    <div class='w3-display-container w3-card' style='min-height: 700px;'>
                        <div class='w3-row'>
                            ".$this->getFeaturedProposalStatusAdmin($property[0])."
                        </div>
                        <div class='w3-row-padding'>
                            <div class='w3-col l6 m12 s12'>
                                <p>REF:".$property[0]."</p>
                                <p>".utf8_decode($property[2])."</p>
                                <p>".$this->getPropertyBusinessType($property[7],'')."</p>
                                <p>".$property[10]." €</p>
                                <p>".$this->getCountyIslandParish($property[9],'')."</p>
                            </div>
                            <div class='w3-col l6 m12 s12'>
                                <p>".$this->getPropertyType($property[5],'')."</p>
                                <p>".$this->getPropertyTypology($property[6],'')."</p>
                                <p>".$property[4]." m<sup>2</sup></p>
                                <p><i class='fa fa-bed'></i> ".$property[11]."</p>
                                <p><i class='fa fa-bath'></i> ".$property[12]."</p>
                            </div>
                            <div class='w3-row'>
                                <div style='height: 200px; overflow-y: scroll;'>
                                    <p>".utf8_decode($description)."</p>
                                </div>
                            </div>
                            <div class='w3-row'>
                                <div style='height: 200px; overflow-y: scroll;'> 
                                    ".$this->previewEditGallery($property[0])."
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id='removePropertyFromFeatured".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('removePropertyFromFeatured".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container w3-row-padding'>
                            <input type='hidden' name='id' value='".$property[0]."'>
                            <p>Tem a certeza que deseja remover este imóvel dos destaques?</p>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='removePropertyFromFeatured' type='submit' class='submitButton'>SIM</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('removePropertyFromFeatured".$property[0]."').style.display='none'\">NÃO</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id='declineFeaturedPropertyRequest".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('declineFeaturedPropertyRequest".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container w3-row-padding'>
                            <input type='hidden' name='id' value='".$property[0]."'>
                            <p>Tem a certeza que deseja recusar este pedido?</p>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='declineFeaturedPropertyRequest' type='submit' class='submitButton'>SIM</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('declineFeaturedPropertyRequest".$property[0]."').style.display='none'\">NÃO</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id='addPropertyToFeatured".$property[0]."' class='modal long-modal'>
                    <form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/property.php'>
                        <div class='w3-container' style='background-color:#f1f1f1'>
                            <span onclick=\"document.getElementById('addPropertyToFeatured".$property[0]."').style.display='none'\" class='close'>&times;</span>
                        </div>
                        <div class='container w3-row-padding'>
                            <input type='hidden' name='propertyID' value='".$property[0]."'>
                            <p>Tem a certeza que deseja adicionar este imóvel aos destaques?</p>
                            <div class='w3-half' style='padding-right: 4.5px'>
                                <button name='addPropertyToFeatured' type='submit' class='submitButton'>SIM</button>
                            </div>
                            <div class='w3-half' style='padding-left: 4.5px'>
                                <button type='button' class='submitButton' onclick=\"document.getElementById('addPropertyToFeatured".$property[0]."').style.display='none'\">NÃO</button>
                            </div>
                        </div>
                    </form>
                </div>
                ";
                array_push($list, $ppt);
            }
        }
        return implode($list);
    }

    public function createProperty($name, $description, $type, $typology, $businessType, $price, $area, $bedrooms, $bathrooms, $parish, $mainImage, $images, $id, $dir, $manager){
        $status = 1;
        $newPropertyManager=$id.",".$manager."\n";
        $descriptionFile = $id.".txt";
        $newProperty = array($id, $mainImage, utf8_encode($name), $descriptionFile, $area, $type, $typology, $businessType, $status, $parish, $price, $bedrooms, $bathrooms);
        $file = fopen($dir."/".$id.".csv", "x");
        $newProperty=implode(",", $newProperty);
        fwrite($file, $newProperty);
        fclose($file);
        $file = fopen($dir."/images.csv", "x");
        foreach ($images as $image) {
            $image=implode(",", $image);
            fwrite($file, $image."\n");
        }
        fclose($file);
        $file = fopen($dir."/".$descriptionFile, "x");
        fwrite($file, utf8_encode($description));
        fclose($file);
        $file = fopen("../data/imoveis.csv", "a");
        fwrite($file, $newPropertyManager);
        fclose($file);
        return true;
    }

    public function deleteProperty($id){
        $dirPath="../imoveis/".$id;
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
        $properties = file("../data/imoveis.csv",FILE_SKIP_EMPTY_LINES);
        $propertiesList=array();
        foreach ($properties as $property) {
            array_push($propertiesList, explode(",", $property));
        }
        foreach ($propertiesList as $property) {
            if($id==$property[0]){
                $newproperty=array();
                for ($i=0; $i <sizeof($propertiesList); $i++) { 
                    if($propertiesList[$i][0]==$id){
                        array_splice($propertiesList,$i,1, $newproperty);
                    }
                }
            } 
        }
        $file=fopen("../data/imoveis.csv", "w");
        foreach ($propertiesList as $property) {
            $property=implode(',', $property);
            fwrite($file, $property);
        }
        fclose($file);
        return true;
    }

    public function updateProperty($name, $description, $type, $typology, $businessType, $price, $area, $bedrooms, $bathrooms, $parish, $id, $status, $image, $manager){
        $descriptionFile = $id.".txt";
        $dir="../imoveis/".$id;
        $updatedData = array($id, $image, $name, $descriptionFile, $area, $type, $typology, $businessType, $status, $parish, $price, $bedrooms, $bathrooms);
        $file = fopen($dir."/".$id.".csv", "w");
        $updatedData=implode(",", $updatedData);
        fwrite($file, $updatedData);
        fclose($file);
        $file = fopen($dir."/".$descriptionFile, "w");
        fwrite($file, utf8_encode($description));
        fclose($file);
        $pms=file("../data/imoveis.csv",FILE_SKIP_EMPTY_LINES);
        $pmsList=array();
        $updatedPropertyManager=[$id,$manager."\n"];
        foreach ($pms as $pm) {
            array_push($pmsList, explode(",", $pm));
        }
        foreach ($pmsList as $pm) {
            if($id==$pm[0] && $manager!=$pm[1]){
                array_splice($pm,0,4,$updatedPropertyManager);
                $newpm=array($pm);
                for ($i=0; $i <sizeof($pmsList); $i++) { 
                    if($pmsList[$i][0]==$id && $pmsList[$i][1]!=$manager){
                        array_splice($pmsList,$i,1, $newpm);
                    }
                }
                $file=fopen("../data/imoveis.csv", "w");
                foreach ($pmsList as $pm) {
                    $pm=implode(",", $pm);
                    $pm=str_replace('"', '', $pm);
                    fwrite($file, $pm);
                }
                fclose($file);
                return true;
            } 
        }
        return false;
    }

    public function updatePropertyStatus($id, $status){
        $property = file("../imoveis/".$id."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
        $propertyItems=array();
        if($status==1){
            $stat=2;
        }elseif($status==2){
            $stat=1;
        }
        $updatedData=array($stat);
        foreach ($property as $propertyItem) {
            array_push($propertyItems, explode(",", $propertyItem));
        }
        foreach ($propertyItems as $item) {
            if($id==$item[0]){
                array_splice($item,8,1,$updatedData);
                $newStatus=array($item);
            }
        }
        $item=implode(",",$item);
        $file=fopen("../imoveis/".$id."/".$id.".csv", "w");
        fwrite($file, $item);
        fclose($file);

        if ($stat==2) {
            $date=date("Y-m-d");
            $newSale=$id.",".$date."\n";
            $file=fopen("../data/sales.csv", "a");
            fwrite($file, $newSale);
            fclose($file);
        }elseif($stat==1){
            $sales=file("../data/sales.csv",FILE_SKIP_EMPTY_LINES);
            $list=array();
            $data=array();
            foreach ($sales as $sale) {
                array_push($list, explode(",", $sale));
            }
            foreach ($list as $sale) {
                if ($sale[0]==$id) {
                    array_splice($list,array_search($id, $sale),1, $data);
                }
            }
            $file=fopen("../data/sales.csv", "w");
            foreach ($list as $row) {
                $row=implode(",", $row);
                fwrite($file, $row);
            }
            fclose($file);
        }

        return true;
    }

    public function updatePropertyImage($img, $description, $id){
        $images = file("../imoveis/".$id."/images.csv",FILE_SKIP_EMPTY_LINES);
        $imagesList=array();
        $updatedData=array($description."\n");
        foreach ($images as $image) {
            array_push($imagesList, explode(",", $image));
        }
        foreach ($imagesList as $image) {
            if($img==$image[0]){
                array_splice($image,1,1,$updatedData);
                $newImage=array($image);
                for ($i=0; $i <sizeof($imagesList); $i++) { 
                    if($imagesList[$i][0]==$img){
                        array_splice($imagesList,$i,1, $newImage);
                    }
                }
            } 
        }
        $file=fopen("../imoveis/".$id."/images.csv", "w");
        foreach ($imagesList as $image) {
            $image=implode(',', $image);
            fwrite($file, $image);
        }
        fclose($file);
        return true; 
    }

    public function deletePropertyImage($img, $id){
        $images = file("../imoveis/".$id."/images.csv",FILE_SKIP_EMPTY_LINES);
        $imagesList=array();
        foreach ($images as $image) {
            array_push($imagesList, explode(",", $image));
        }
        foreach ($imagesList as $image) {
            if($img==$image[0]){
                $newImage=array("\n");
                for ($i=0; $i <sizeof($imagesList); $i++) { 
                    if($imagesList[$i][0]==$img){
                        array_splice($imagesList,$i,1, $newImage);
                    }
                }
            } 
        }
        $file=fopen("../imoveis/".$id."/images.csv", "w");
        foreach ($imagesList as $image) {
            $image=implode(',', $image);
            fwrite($file, $image);
        }
        fclose($file);
        $dir = "../imoveis/".$id;
        unlink($dir."/".$img);
        return true; 
    }

    public function addNewPropertyImage($img, $description, $id){
        $newImage=$img.",".$description."\n";
        $file=fopen("../imoveis/".$id."/images.csv", "a");
        fwrite($file, $newImage);
        fclose($file);
        return true;
    }

    public function createFeaturedRequest($id){
        $requests = fopen("../data/featuredRequest.csv", "a");
        $id=array($id);
        fputcsv($requests, $id);
        return true;
    }

    public function addPropertyToFeatured($id){
        $requestsFile = file("../data/featuredRequest.csv",FILE_SKIP_EMPTY_LINES);
        $requestsList=array();
        $removePpt=array();
        foreach ($requestsFile as $request) {
            array_push($requestsList, explode(",", $request));
        }
        foreach ($requestsList as $request) {
            if ($request[0]==$id) {
               array_splice($requestsList,array_search($id, $request),1,$removePpt);
            }
        }
        $requests=fopen("../data/featuredRequest.csv", "w");
        foreach ($requestsList as $request) {
            $request=implode(",", $request);
            fwrite($requests, $request);
        }
        fclose($requests);

        $featured = fopen("../data/featured.csv", "a");
        $id=array($id);
        fputcsv($featured, $id);
        return true;
    }

    public function removePropertyFromFeaturedRequests($id){
        $featuredFile = file("../data/featuredRequest.csv",FILE_SKIP_EMPTY_LINES);
        $featuredList=array();
        $removePpt=array();
        foreach ($featuredFile as $featured) {
            array_push($featuredList, explode(",", $featured));
        }
        foreach ($featuredList as $featured) {
            if ((int)$featured[0]==$id) {
               array_splice($featuredList,array_search($id, $featured),1,$removePpt);
            }
        }
        $featuredProperties=fopen("../data/featuredRequest.csv", "w");
        foreach ($featuredList as $featured) {
            $featured=implode(",", $featured);
            fwrite($featuredProperties, $featured);
        }
        fclose($featuredProperties);
        return true;
    }

    public function removePropertyFromFeatured($id){
        $featuredFile = file("../data/featured.csv",FILE_SKIP_EMPTY_LINES);
        $featuredList=array();
        $removePpt=array();
        foreach ($featuredFile as $featured) {
            array_push($featuredList, explode(",", $featured));
        }
        foreach ($featuredList as $featured) {
            if ((int)$featured[0]==$id) {
               array_splice($featuredList,array_search($id, $featured),1,$removePpt);
            }
        }
        $featuredProperties=fopen("../data/featured.csv", "w");
        foreach ($featuredList as $featured) {
            $featured=implode(",", $featured);
            fwrite($featuredProperties, $featured);
        }
        fclose($featuredProperties);
        return true;
    }

    public function getPropertiesByParish(){
        $table=array();
        $indexes=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            array_push($indexes, end($number));
        }
        $parishes=file("../data/parish.csv",FILE_SKIP_EMPTY_LINES);

        array_push($table,"<table><tr><th>Freguesia</th><th>Número de Imóveis</th></tr>");
        foreach ($parishes as $parish) {
            $parish=explode(",", $parish);
            $sum=0;
            array_push($table,"<tr><td>".utf8_encode($parish[2])."</td>");
            foreach ($indexes as $index) {
                $properties = file("../imoveis/".$index."/".$index.".csv",FILE_SKIP_EMPTY_LINES);
                foreach ($properties as $property) {
                    $property=explode(",", $property);
                    if ((int)$parish[0]==(int)$property[9]) {
                        $sum += 1;
                    }
                }
            }
            array_push($table,"<td>".$sum."</td></tr>");
        }
        array_push($table,"</table>");
        return implode($table);
    }

    public function getPropertiesByCounty(){
        $table=array();
        $indexes=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            array_push($indexes, end($number));
        }
        $parishes=file("../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $counties=file("../data/county.csv",FILE_SKIP_EMPTY_LINES);
        array_push($table,"<table><tr><th>Concelhos</th><th>Nº de Imóveis no Concelho</th></tr>");
        foreach ($counties as $county) {
                $county=explode(",", $county);
                $sum=0;
                array_push($table,"<tr><td>".utf8_encode($county[2])."</td>");
            foreach ($parishes as $parish) {
                $parish=explode(",", $parish);
                if ($parish[1]==$county[0]) {
                    foreach ($indexes as $index) {
                        $properties = file("../imoveis/".$index."/".$index.".csv",FILE_SKIP_EMPTY_LINES);
                        foreach ($properties as $property) {
                            $property=explode(",", $property);
                            if ((int)$parish[0]==(int)$property[9]) {
                                $sum += 1;
                            }
                        }
                    }
                }
            }
            array_push($table,"<td>".$sum."</td></tr>");
        }
        array_push($table,"</table>");
        return implode($table);
    }

    public function getPropertiesByIsland(){
        $table=array();
        $indexes=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            array_push($indexes, end($number));
        }
        $parishes=file("../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $counties=file("../data/county.csv",FILE_SKIP_EMPTY_LINES);
        $islands=file("../data/island.csv",FILE_SKIP_EMPTY_LINES);
        array_push($table,"<table><tr><th>Ilhas</th><th>Nº de Imóveis na Ilha</th></tr>");
        foreach ($islands as $island) {
            $island=explode(",", $island);
            $sum=0;
            array_push($table,"<tr><td>".utf8_encode($island[1])."</td>");
            foreach ($counties as $county) {
                $county=explode(",", $county);
                foreach ($parishes as $parish) {
                    $parish=explode(",", $parish);
                    if ($parish[1]==$county[0] && $county[1]==$island[0]) {
                        foreach ($indexes as $index) {
                            $properties = file("../imoveis/".$index."/".$index.".csv",FILE_SKIP_EMPTY_LINES);
                            foreach ($properties as $property) {
                                $property=explode(",", $property);
                                if ((int)$parish[0]==(int)$property[9]) {
                                    $sum += 1;
                                }
                            }
                        }
                    }
                }
            }
            array_push($table,"<td>".$sum."</td></tr>");
        }
        array_push($table,"</table>");
        return implode($table);
    }

    public function getPropertiesByType(){
        $table=array();
        $indexes=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            array_push($indexes, end($number));
        }
        $types=file("../data/propertyType.csv",FILE_SKIP_EMPTY_LINES);

        array_push($table,"<table><tr><th>Tipo de Imóvel</th><th>Número de Imóveis do tipo</th></tr>");
        foreach ($types as $type) {
            $type=explode(",", $type);
            $sum=0;
            array_push($table,"<tr><td>".utf8_encode($type[1])."</td>");
            foreach ($indexes as $index) {
                $properties = file("../imoveis/".$index."/".$index.".csv",FILE_SKIP_EMPTY_LINES);
                foreach ($properties as $property) {
                    $property=explode(",", $property);
                    if ((int)$type[0]==(int)$property[5]) {
                        $sum += 1;
                    }
                }
            }
            array_push($table,"<td>".$sum."</td></tr>");
        }
        array_push($table,"</table>");
        return implode($table);
    }

    public function getPropertiesByPriceRange(){
        $table=array();
        $indexes=array();
        $prices=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            array_push($indexes, $id);
            $properties = file("../imoveis/".$id."/".$id.".csv");
            foreach ($properties as $property) {
                $property=explode(",", $property);
                array_push($prices, $property[10]);
            }
        }
        asort($prices);
        array_push($table,"<table><tr><th>Intervalo de Preço</th><th>Número de Imóveis</th></tr>");
        $min=0;
        $max=100000000;
        $range=round($max/20);
        for ($i=0; $i <=($max-$range); $i+=$range) {
            $sum=0;
            $top=$min+$range;
            foreach ($indexes as $index) {
                $properties = file("../imoveis/".$index."/".$index.".csv");
                foreach ($properties as $property) {
                    $property=explode(",", $property);
                    if ($property[10]<$top && $property[10]>=$min) {
                        $sum+=1;
                    }
                }
            }
            array_push($table, "<tr><td>".$min." - ".$top."</td><td>".$sum."</td></tr>");
            $min+=$range;
        }
        foreach ($indexes as $index) {
            $properties = file("../imoveis/".$index."/".$index.".csv");
            foreach ($properties as $property) {
                $property=explode(",", $property);
                if ($property[10]>=$top) {
                    $sum+=1;
                }
            }
        }
        array_push($table, "<tr><td> >".$top."</td><td>".$sum."</td></tr>");
        array_push($table,"</table>");
        return implode($table);
    }


    /*********\
      FILTERS
    \*********/
    public function propertyFilterTags($id){
        $property=file("../../imoveis/".$id."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
        foreach ($property as $row) {
            $row=explode(",", $row);
        }
        $parishID=(int)$row[9];
        $parishes = file("../../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $parishesList=array();
        foreach ($parishes as $parish) {
            array_push($parishesList, explode(",", $parish));
        }
        foreach ($parishesList as $parish) {
            $parish = array_map("utf8_encode", $parish);
            if ((int)$parish[0] == $parishID) {
                $countyID=(int)$parish[1];
                $parishName=$parish[2];
                $counties = file("../../data/county.csv",FILE_SKIP_EMPTY_LINES);
                $countiesList=array();
                foreach ($counties as $county) {
                    array_push($countiesList, explode(",", $county));
                }
                foreach ($countiesList as $county) {
                    $county = array_map("utf8_encode", $county);
                    if ($countyID==(int)$county[0]) {
                        $islandID=(int)$county[1];
                        $countyName=$county[2];
                        $islands = file("../../data/island.csv",FILE_SKIP_EMPTY_LINES);
                        $islandsList=array();
                        foreach ($islands as $island) {
                            array_push($islandsList, explode(",", $island));
                        }
                        foreach ($islandsList as $island) {
                            $island = array_map("utf8_encode", $island);
                            if ($islandID==(int)$island[0]) {
                                $islandName=$island[1];
                            }
                        }
                    }
                }
            }
        }
        $businessTypeFile=file("../../data/businessType.csv",FILE_SKIP_EMPTY_LINES);
        foreach ($businessTypeFile as $btRow) {
            $btRow=explode(",", $btRow);
            if ((int)$btRow[0]==(int)$row[7]) {
                $businessTypeName=$btRow[1];
            }
        }
        $propertyTypeFile=file("../../data/propertyType.csv",FILE_SKIP_EMPTY_LINES);
        foreach ($propertyTypeFile as $ptRow) {
            $ptRow=explode(",", $ptRow);
            if ((int)$ptRow[0]==(int)$row[5]) {
                $propertyTypeName=$ptRow[1];
            }
        }
        $propertyTypologyFile=file("../../data/propertyTypology.csv",FILE_SKIP_EMPTY_LINES);
        foreach ($propertyTypologyFile as $ptyRow) {
            $ptyRow=explode(",", $ptyRow);
            if ((int)$ptyRow[0]==(int)$row[6]) {
                $propertyTypologyName=$ptyRow[1];
            }
        }
        $bt = filter_var(strtolower(str_replace(' ', '', $businessTypeName)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
        $pt = filter_var(strtolower(str_replace(' ', '', $propertyTypeName)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $pty = filter_var(strtolower(str_replace(' ', '', $propertyTypologyName)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $isl = filter_var(strtolower(str_replace(' ', '', $islandName)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $cnt = filter_var(strtolower(str_replace(' ', '', $countyName)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $prsh = filter_var(strtolower(str_replace(' ', '', $parishName)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return "data-area='".$row[4]."' data-price='".$row[10]."' data-category='".$bt." ".$pt." ".$pty." ".$isl." ".$cnt." ".$prsh."'";
    }

    public function getFeaturedProposalStatus($propertyID){
        $featured=file("../data/featured.csv",FILE_SKIP_EMPTY_LINES);
        $requests=file("../data/featuredRequest.csv",FILE_SKIP_EMPTY_LINES);
        if (!empty($featured)) {
            foreach ($featured as $value) {
                if ((int)$value[0]==$propertyID) {
                    return "<div class='label success'>EM DESTAQUE</div>";
                } 
            }
        }
        if (!empty($requests)) {
            foreach ($requests as $val) {
                if ((int)$val[0]==$propertyID && (int)$value[0]!=$propertyID) {
                    return "<div class='label warning'>EM APRECIAÇÃO</div>";
                }
            }
        }
        if ($propertyID!=(int)$value[0] && (int)$val[0]!=$propertyID) {
            return "<button type='button' onclick=\"document.getElementById('createFeaturedRequest".$propertyID."').style.display='block'\" class='btn info'>PROPOR</span>";
        }
    }

    public function adminFilterProperties($propertyID){
        $featured=file("../data/featured.csv",FILE_SKIP_EMPTY_LINES);
        $requests=file("../data/featuredRequest.csv",FILE_SKIP_EMPTY_LINES);
        $property=file("../imoveis/".$propertyID."/".$propertyID.".csv",FILE_SKIP_EMPTY_LINES);
        $tags=array();
        $property=explode(",", $property[0]);
        if ((int)$property[8]==1) {
            array_push($tags, "activeProperty ");
        }
        elseif ((int)$property[8]==2){
            array_push($tags, "notActive ");
        }
        if (!empty($featured)) {
            foreach ($featured as $value) {
                if ((int)$value[0]==$propertyID) {
                    array_push($tags, "featured ");
                }
            }
        }
        if (!empty($requests)) {
            foreach ($requests as $val) {
                if ((int)$val[0]==$propertyID && (int)$value[0]!=$propertyID) {
                    array_push($tags, "requests ");
                }
            }
        }
       
        return implode(" ", $tags);
    }

    public function getFeaturedProposalStatusAdmin($propertyID){
        $featured=file("../data/featured.csv",FILE_SKIP_EMPTY_LINES);
        $requests=file("../data/featuredRequest.csv",FILE_SKIP_EMPTY_LINES);
        if (!empty($featured)) {
            foreach ($featured as $value) {
                if ((int)$value[0]==$propertyID) {
                    return "<div class='w3-col l5 m5 s5 w3-padding'>
                            <div class='label success'>EM DESTAQUE</div>
                        </div>
                        <div class='w3-col l5 m5 s5 w3-padding'>
                            <p></p>
                        </div>
                        <div class='w3-col l2 m2 s2 w3-padding'>
                            <button type='button' onclick=\"document.getElementById('removePropertyFromFeatured".$propertyID."').style.display='block'\" class=' btn danger'><i class='fa fa-remove'></i></button>
                        </div>";
                }
            }
        } 
        if (!empty($requests)) {
            foreach ($requests as $val) {
                if ((int)$val[0]==$propertyID) {
                    return "<div class='w3-col l5 m5 s5 w3-padding'>
                        <div class='label warning'>EM APRECIAÇÂO</div>
                    </div>
                    <div class='w3-col l3 m3 s3 w3-padding'>
                        <p></p>
                    </div>
                        <div class='w3-col l2 m2 s2 w3-padding'>
                            <button type='button' onclick=\"document.getElementById('addPropertyToFeatured".$propertyID."').style.display='block'\" class='btn success'><i class='fa fa-check'></i></button>
                        </div>
                        <div class='w3-col l2 m2 s2 w3-padding'>
                        <button type='button' onclick=\"document.getElementById('declineFeaturedPropertyRequest".$propertyID."').style.display='block'\" class=' btn danger'><i class='fa fa-remove'></i></button>
                    </div>";
                }
            }
        }
        if ((int)$val[0]!=$propertyID && (int)$value[0]!=$propertyID) {
            return "<div class='w3-col l10 m10 s10 w3-padding'>
                    <p></p>
                </div>
                <div class='w3-col l2 m2 s2 w3-padding'>
                    <button type='button' onclick=\"document.getElementById('addPropertyToFeatured".$propertyID."').style.display='block'\" class='btn info'><i class='fa fa-plus'></i></span>
                </div>";
        }
    }
    
    public function getPropertyStatus($status, $pptID){
        if($status==1){
            return "<button class='btn success' type='button' onclick=\"document.getElementById('updatePropertyStatus".$pptID."').style.display='block'\">ATIVO</button>";
        }elseif($status==2){
            return "<button class='btn danger' type='button' onclick=\"document.getElementById('updatePropertyStatus".$pptID."').style.display='block'\">CONCLUÍDO</button>";
        }
    }

    public function getBusinessTypeFilters(){
        $businessTypes = file("../../data/businessType.csv",FILE_SKIP_EMPTY_LINES);
        $businessTypesList=array();
        foreach ($businessTypes as $businessType) {
            array_push($businessTypesList, explode(",", $businessType));
        }
        foreach ($businessTypesList as $businessType) {
            $bt=$businessType[1];
            $value = filter_var(strtolower(str_replace(' ', '', $bt)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            echo"
                <input type='checkbox' name='businessType' id='".$value."' value='".$value."'> ".$bt."<br>";
        }
    }

    public function getPropertyTypeFilters(){
        $propertyTypes = file("../../data/propertyType.csv",FILE_SKIP_EMPTY_LINES);
        $propertyTypesList=array();
        foreach ($propertyTypes as $propertyType) {
            array_push($propertyTypesList, explode(",", $propertyType));
        }
        foreach ($propertyTypesList as $propertyType) {
            $propertyType = array_map("utf8_encode", $propertyType);
            $pt=$propertyType[1];
            $replace = strtolower(str_replace(' ', '', $pt));
            $value = filter_var($replace, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            echo"
                <input type='checkbox' name='propertyType' id='".$value."' value='".$value."'> ".$pt."<br>";  
        }
    }

    public function getPropertyTypologyFilters(){
        $propertyTypologies = file("../../data/propertyTypology.csv",FILE_SKIP_EMPTY_LINES);
        $propertyTypologiesList=array();
        foreach ($propertyTypologies as $propertyTypology) {
            array_push($propertyTypologiesList, explode(",", $propertyTypology));
        }
        foreach ($propertyTypologiesList as $propertyTypology) {
            $pt=$propertyTypology[1];
            $replace = strtolower(str_replace(' ', '', $pt));
            $value = filter_var($replace, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            if (strpos($pt,"n")===true) {
                echo"";
            }
            else{
                echo"
                    <input type='checkbox' name='propertyTypology' id='".$value."' value='".$value."'> ".$pt."<br>";
            }   
        }
    }

    public function getIslandFilters(){
        $islands = file("../../data/island.csv",FILE_SKIP_EMPTY_LINES);
        $islandsList=array();
        foreach ($islands as $island) {
            array_push($islandsList, explode(",", $island));
        }
        foreach ($islandsList as $island) {
            $island = array_map("utf8_encode", $island);
            $islID =$island[0];
            $islName=$island[1];
            $replace = strtolower(str_replace(' ', '', $islName));
            $value = filter_var($replace, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            echo"<input type='checkbox' data-type='island' name='island' id='".$value."' value='".$islID."'> ".$islName."<br>";  
        }
    }

    public function getCountyFilters(){
        $counties = file("../../data/county.csv",FILE_SKIP_EMPTY_LINES);
        $countiesList=array();
        foreach ($counties as $county) {
            array_push($countiesList, explode(",", $county));
        }
        foreach ($countiesList as $county) {
            $county = array_map("utf8_encode", $county);
            $islandID=$county[1];
            $countyName=$county[2];
            $replace = strtolower(str_replace(' ', '', $countyName));
            $value = filter_var($replace, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $islands = file("../../data/island.csv",FILE_SKIP_EMPTY_LINES);
            $islandsList=array();
            foreach ($islands as $island) {
                array_push($islandsList, explode(",", $island));
            }
            foreach ($islandsList as $island) {
                $island = array_map("utf8_encode", $island);
                if ($islandID==$island[0]) {
                    $islandName=$island[1];
                }
            }
            $replaceIsl = strtolower(str_replace(' ', '', $islandName));
            $islValue = filter_var($replaceIsl, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            echo"<div class='county' data-category='".$islValue."'>
                    <input type='checkbox' name='county' id='".$value."' value='".$value."'> ".$countyName."
                </div>"; 
        }  
    }

    public function getParishFilters(){
        $parishes = file("../../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $parishesList=array();
        foreach ($parishes as $parish) {
            array_push($parishesList, explode(",", $parish));
        }
        foreach ($parishesList as $parish) {
            $parish = array_map("utf8_encode", $parish);
            $parishID = $parish[0];
            $countyid=$parish[1];
            $parishName=$parish[2];
            $replace = strtolower(str_replace(' ', '', $parishName));
            $value = filter_var($replace, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $counties = file("../../data/county.csv",FILE_SKIP_EMPTY_LINES);
            $countiesList=array();
            foreach ($counties as $county) {
                array_push($countiesList, explode(",", $county));
            }
            foreach ($countiesList as $county) {
                $county = array_map("utf8_encode", $county);
                if ($countyid==$county[0]) {
                    $islId=$county[1];
                    $countyName=$county[2];
                }
                $islands = file("../../data/island.csv",FILE_SKIP_EMPTY_LINES);
                $islandsList=array();
                $islandName="";
                foreach ($islands as $island) {
                    array_push($islandsList, explode(",", $island));
                }
                foreach ($islandsList as $island) {
                    $island = array_map("utf8_encode", $island);
                    if ($islId==$island[0]) {
                        $islandName=$island[1];
                    }
                }
                $replaceIsl = strtolower(str_replace(' ', '', $islandName));
                $islValue = filter_var($replaceIsl, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            }
            $replaceCnt = strtolower(str_replace(' ', '', $countyName));
            $cntValue = filter_var($replaceCnt, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            echo"<div class='parish' data-category='".$cntValue." ".$islValue."'>
                    <input type='checkbox' name='parish' id='".$value."' value='".$parishID."'> ".$parishName."
                </div>
            ";
        } 
    }

    public function minPrice(){
        $dir="../../imoveis/*";
        $dirs = glob($dir);
        $prices=array();
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                array_push($prices, $property[10]);
            }
        }
        arsort($prices);
        return (int)end($prices);
    }

    public function maxPrice(){
        $dir="../../imoveis/*";
        $dirs = glob($dir);
        $prices=array();
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                array_push($prices, $property[10]);
            }
        }
        asort($prices);
        return (int)end($prices);
    }

    public function minArea(){
        $dir="../../imoveis/*";
        $dirs = glob($dir);
        $areas=array();
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                array_push($areas, $property[4]);
            }
        }
        arsort($areas);
        return (int)end($areas);
    }

    public function maxArea(){
        $dir="../../imoveis/*";
        $dirs = glob($dir);
        $areas=array();
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            $description = file_get_contents($folder."/".$id.".txt");
            $description = mb_convert_encoding($description, "UTF-8", "auto");
            $propertiesList=array();
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
            foreach ($propertiesList as $property) {
                array_push($areas, $property[4]);
            }
        }
        asort($areas);
        return (int)end($areas);
    }

    public function getAllPropertyIslands(){
        $islands = file("../data/island.csv",FILE_SKIP_EMPTY_LINES);
        $islandsList=array();
        foreach ($islands as $island) {
            array_push($islandsList, explode(",", $island));
        }
        echo"
            <select name='island' class='select-island'>
                <option value='-1' selected disabled>Selecione uma ilha</option>
            ";
        foreach ($islandsList as $island) {
            $id =$island[0];
            $island = array_map("utf8_encode", $island);
            $name=$island[1];
            echo"
                <option value='".$id."'>".$name."</option>
            "; 
        }
        echo"</select>";
    }

    public function getAllPropertyCounties(){
        $counties = file("../data/county.csv",FILE_SKIP_EMPTY_LINES);
        $countiesList=array();
        foreach ($counties as $county) {
            array_push($countiesList, explode(",", $county));
        }
        echo"
            <select name='county' class='select-county'>
                <option value='-1' selected disabled>Selecione um concelho</option>
            ";
        foreach ($countiesList as $county) {
            $id=$county[0];
            $islandID=$county[1];
            $county = array_map("utf8_encode", $county);
            $name=$county[2];
            echo"
                <option data-island='".$islandID."' value='".$id."'>".$name."</option>
            ";
        }
        echo"</select>";
    }

    public function getAllPropertyParishes(){
        $parishes = file("../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $parishesList=array();
        foreach ($parishes as $parish) {
            array_push($parishesList, explode(",", $parish));
        }
        echo"
            <select name='parish' class='select-parish'>
                <option value='-1' selected disabled>Selecione uma freguesia</option>
        ";
        foreach ($parishesList as $parish) {
            $id = $parish[0];
            $countyID=$parish[1];
            $parish = array_map("utf8_encode", $parish);
            $name=$parish[2];

            echo"
                <option data-county='".$countyID."' value='".$id."'>".$name."</option>
            ";
        }
        echo"</select>";
    }

    public function getAllPropertyBusinessTypes(){
        $bTypes = file("../data/businessType.csv",FILE_SKIP_EMPTY_LINES);
        $bTypesList=array();
        foreach ($bTypes as $bType) {
            array_push($bTypesList, explode(",", $bType));
        }
        foreach ($bTypesList as $bType) {
            $id =$bType[0];
            $bType = array_map("utf8_encode", $bType);
            $name=$bType[1];
            echo"
                <option value='".$id."'>".$name."</option>
            "; 
        }
    }

    public function getAllPropertyTypes(){
        $pTypes = file("../data/propertyType.csv",FILE_SKIP_EMPTY_LINES);
        $pTypesList=array();
        foreach ($pTypes as $pType) {
            array_push($pTypesList, explode(",", $pType));
        }
        foreach ($pTypesList as $pType) {
            $id =$pType[0];
            $pType = array_map("utf8_encode", $pType);
            $name=$pType[1];
            echo"
                <option value='".$id."'>".$name."</option>
            "; 
        }
    }

    public function getAllPropertyTypologies(){
        $pTypologies = file("../data/propertyTypology.csv",FILE_SKIP_EMPTY_LINES);
        $pTypologysList=array();
        foreach ($pTypologies as $pTypology) {
            array_push($pTypologysList, explode(",", $pTypology));
        }
        foreach ($pTypologysList as $pTypology) {
            $id =$pTypology[0];
            $pTypology = array_map("utf8_encode", $pTypology);
            $name=$pTypology[1];
            echo"
                <option value='".$id."'>".$name."</option>
            "; 
        }
    }

    public function updatePropertyType($type){
        $pTypes = file("../data/propertyType.csv",FILE_SKIP_EMPTY_LINES);
        $pTypesList=array();
        foreach ($pTypes as $pType) {
            array_push($pTypesList, explode(",", $pType));
        }
        $types=array();
        foreach ($pTypesList as $pType) {
            $id =$pType[0];
            $pType = array_map("utf8_encode", $pType);
            $name=$pType[1];
            if ($type==$id) {
                array_push($types,"<option value='".$id."' selected>".$name."</option>");
            }
            else{
                array_push($types,"<option value='".$id."'>".$name."</option>");
            }
        }
        return implode($types); 
    }

    public function updatePropertyTypology($typology){
        $pTypologies = file("../data/propertyTypology.csv",FILE_SKIP_EMPTY_LINES);
        $pTypologysList=array();
        foreach ($pTypologies as $pTypology) {
            array_push($pTypologysList, explode(",", $pTypology));
        }
        $typologies=array();
        foreach ($pTypologysList as $pTypology) {
            $id =$pTypology[0];
            $pTypology = array_map("utf8_encode", $pTypology);
            $name=$pTypology[1];
            if ($typology==$id) {
                array_push($typologies,"<option value='".$id."' selected>".$name."</option>");
            }else{
                array_push($typologies,"<option value='".$id."'>".$name."</option>");
            } 
        }
        return implode($typologies);
    }

    public function updatePropertyBusinessType($businessType){
        $bTypes = file("../data/businessType.csv",FILE_SKIP_EMPTY_LINES);
        $bTypesList=array();
        foreach ($bTypes as $bType) {
            array_push($bTypesList, explode(",", $bType));
        }
        $business=array();
        foreach ($bTypesList as $bType) {
            $id =$bType[0];
            $bType = array_map("utf8_encode", $bType);
            $name=$bType[1];
            if($businessType == $id){
                array_push($business,"<option value='".$id."' selected>".$name."</option>");
            }
            else{
                array_push($business,"<option value='".$id."'>".$name."</option>");
            }
        }
        return implode($business);
    }

    public function updatePropertyParish($parishid){
        $parishes = file("../data/parish.csv",FILE_SKIP_EMPTY_LINES);
        $counties = file("../data/county.csv",FILE_SKIP_EMPTY_LINES);
        $islands = file("../data/island.csv",FILE_SKIP_EMPTY_LINES);
        $parishesList=array();
        $islandsList=array();
        $countiesList=array();
        foreach ($parishes as $parish) {
            $parish=explode(",", $parish);
            $id = $parish[0];
            $countyID=$parish[1];
            $parish = array_map("utf8_encode", $parish);
            $name=$parish[2];
            if ($parishid == $id) {
                $sel="selected";
            }else{
                $sel="";
            }
            array_push($parishesList,"<option data-updateCounty='".$countyID."' value='".$id."' ".$sel.">".$name."</option>");

        }
        foreach ($counties as $county) {
            $county=explode(",", $county);
            $islandID=$county[1];
            foreach ($parishes as $parish) {
                $parish=explode(",", $parish);
                if ($parish[0]==$parishid) {
                    $countyID=$parish[1];
                }
            }
            $id=$county[0];
            $islandID=$county[1];
            $county = array_map("utf8_encode", $county);
            $name=$county[2];
            if ($countyID == $county[0]) {
                $sel="selected";
            }else{
                $sel="";
            }
            array_push($countiesList,"<option data-updateIsland='".$islandID."' value='".$id."' ".$sel.">".$name."</option>");        
        }
        foreach ($islands as $island) {
            $island=explode(",", $island);
            foreach ($counties as $county) {
                $county=explode(",", $county);
                if($county[1]==$island[0]){
                    foreach ($parishes as $parish) {
                        $parish=explode(",", $parish);
                        if ($parish[1]==$county[0]) {
                            if ($parish[0]==$parishid) {
                                $islandID=$county[1];
                            }
                        }    
                    }
                    
                }    
            }
            $id = $island[0];
            $island = array_map("utf8_encode", $island);
            $name=$island[1];
            if ($id==$islandID) {
                $sel="selected";
            }
            else{
                $sel="";
            }
            array_push($islandsList, "<option value='".$id."' ".$sel.">".$name."</option>"); 
        }

        return "<div class='w3-third' style='padding-right: 6px'>
                <label><b>Ilha</b></label>
                <select name='updateIsland' class='select-island'>
                    ".implode($islandsList)."
                </select>
            </div>
            <div class='w3-third' style='padding: 0 3px'>
                <label><b>Concelho</b></label>
                <select name='updateCounty' class='select-county'>
                    ".implode($countiesList)."
                </select>
            </div>
            <div class='w3-third' style='padding-left: 6px'>
                <label><b>Freguesia</b></label>
                <select name='parish' class='select-parish'>
                    ".implode($parishesList)."
                </select>
            </div>
        ";
    }

}
?>