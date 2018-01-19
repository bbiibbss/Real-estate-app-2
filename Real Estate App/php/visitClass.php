<?php

	require_once('propertyClass.php');

Class Visit{

	private $ppt;

	public function getUserVisitRequests($userID){
		$this->ppt = new Property();
		$visits = file("../../data/visitRequests.csv",FILE_SKIP_EMPTY_LINES);
		$visitsList = array();
		foreach ($visits as $visit) {
			array_push($visitsList, explode(",", $visit));
		}
		foreach ($visitsList as $visit) {
			$visitDate=$visit[2];
			$day= date("d", strtotime($visitDate));
		    $month= date("M", strtotime($visitDate));
		    $year= date("Y", strtotime($visitDate));
			if($visit[0]==$userID && $visit[4]==1){
				$dir="../../imoveis";
		        $dirs = scandir($dir);
		        for ($i=1; $i<sizeof($dirs)-1; $i++) {
		            $filePath = "../../imoveis/".$i."/";
		            $properties = file($filePath.$i.".csv",FILE_SKIP_EMPTY_LINES);
		            $propertiesList=array();
		            foreach ($properties as $property) {
		                array_push($propertiesList, explode(",", $property));
		            }
		            foreach ($propertiesList as $property) {
		                if($property[0]==$visit[1]){
		                	echo "
		                	<div class='w3-display-container w3-card w3-padding w3-padding-16 w3-margin-bottom w3-row'>
			                	<div class='w3-row w3-right'>
			                		<div class='w3-col l6 m6 s6 w3-padding'>
			                			<a onclick='openModal(\"edit".$visit[1]."\")'><i class='fa fa-pencil edit-button'></i></a>
			                		</div>
			                		<div class='w3-col l6 m6 s6 w3-padding'>
			                			<a onclick='openModal(\"remove".$visit[1]."\")'><i class='fa fa-remove edit-button'></i></a>
			                		</div>
			                	</div>
								<div class='w3-col l5 m12 s12'>
									<img class='property-thumbnail' src='".$filePath.$property[1]."'>
								</div>
								<div class='w3-col l7 m12 s12' style='padding-left:40px'>
								    <p>".$property[2]."</p>
								    <p>".$this->ppt->getCountyIslandParish($property[8], "../")."</p>
							        <p>Data: ".$day." de ".$month." de ".$year."</p>
				               		<p>Hora: ".$visit[3]."H</p>
								</div>
    						</div>
		                	";

		                	echo "
							<div id='edit".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick='openModal(\"edit".$visit[1]."\")' class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$userID."'>
					        	        <input type='hidden' name='propertyId' value='".$visit[1]."'>
							            <label><b>Data</b></label>
							            <input type='date' name='updateVisitDate' value='".$visit[2]."' required>
							            <label><b>Hora</b></label>
							            <input type='time' name='updateVisitTime' value='".$visit[3]."' required>
							            <br>
										<button name='updateUserVisitData' class='submitButton' type='submit'>Alterar dados</button>
									</div>
								</form>
							</div>
						";

						echo "
							<div id='remove".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick=\"document.getElementById('remove".$visit[1]."').style.display='none'\" class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$userID."'>
					        	        <input type='hidden' name='propertyId' value='".$visit[1]."'>
					        	        <h3>Tem a certeza que quer cancelar este pedido?</h3>
							            <br>
										<div class='w3-row'>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button name='deleteVisitRequest'  class='submitButton' type='submit'>SIM</button>
											</div>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button type='button' onclick=\"document.getElementById('remove".$visit[1]."').style.display='none'\"class='submitButton'>NÃO</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							";
		                }
					}
				}
			}
		}
	}

	public function getUserBookedVisits($userID){
		$this->ppt = new Property();
		$visits = file("../../data/visitRequests.csv",FILE_SKIP_EMPTY_LINES);
		$visitsList = array();
		foreach ($visits as $visit) {
			$visit=explode(",", $visit);
			$visitDate=$visit[2];
			$day= date("d", strtotime($visitDate));
		    $month= date("M", strtotime($visitDate));
		    $year= date("Y", strtotime($visitDate));
			if($visit[0]==$userID && $visit[4]==2){
				$dir="../../imoveis";
		        $dirs = scandir($dir);
		        for ($i=1; $i<sizeof($dirs)-1; $i++) {
		            $filePath = "../../imoveis/".$i."/";
		            $properties = file($filePath.$i.".csv",FILE_SKIP_EMPTY_LINES);
		            $propertiesList=array();
		            foreach ($properties as $property) {
		                array_push($propertiesList, explode(",", $property));
		            }
		            foreach ($propertiesList as $property) {
		                if($property[0]==$visit[1]){
		                	echo "
		                	<div class='w3-display-container w3-card w3-padding w3-padding-16 w3-margin-bottom w3-row'>
			                	<div class='w3-row w3-right'>
									<a onclick='openModal(\"remove".$visit[1]."\")'><i class='fa fa-remove edit-button'></i></a>
			                	</div>
								<div class='w3-col l5 m12 s12'>
									<img class='property-thumbnail' src='".$filePath.$property[1]."'>
								</div>
								<div class='w3-col l7 m12 s12' style='padding-left:40px'>
								    <p>".$property[2]."</p>
								    <p>".$this->ppt->getCountyIslandParish($property[8],"../")."</p>
							        <p>Data: ".$day." de ".$month." de ".$year."</p>
				               		<p>Hora: ".$visit[3]."H</p>
								</div>
    						</div>
		                	";
							echo "
							<div id='remove".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick=\"document.getElementById('remove".$visit[1]."').style.display='none'\" class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$userID."'>
					        	        <input type='hidden' name='propertyId' value='".$visit[1]."'>
					        	        <h3>Tem a certeza que quer cancelar este pedido?</h3>
							            <br>
										<div class='w3-row'>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button name='deleteVisitRequest' class='submitButton' type='submit'>SIM</button>
											</div>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button type='button' class='submitButton' onclick=\"document.getElementById('remove".$visit[1]."').style.display='none'\"> NÃO</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							";
		                }
					}
				}
			}
		}
	}

	public function getUserDeclinedVisits($userID){
		$this->ppt = new Property();
		$visits = file("../../data/visitRequests.csv", FILE_SKIP_EMPTY_LINES);
		$visitsList = array();
		foreach ($visits as $visit) {
			array_push($visitsList, explode(",", $visit));
		}
		foreach ($visitsList as $visit) {
			$visitDate=$visit[2];
			$day= date("d", strtotime($visitDate));
		    $month= date("M", strtotime($visitDate));
		    $year= date("Y", strtotime($visitDate));
			if($visit[0]==$userID && $visit[4]==3){
				$dir="../../imoveis";
		        $dirs = scandir($dir);
		        for ($i=1; $i<sizeof($dirs)-1; $i++) {
		            $filePath = "../../imoveis/".$i."/";
		            $properties = file($filePath.$i.".csv",FILE_SKIP_EMPTY_LINES);
		            $propertiesList=array();
		            foreach ($properties as $property) {
		                array_push($propertiesList, explode(",", $property));
		            }
		            foreach ($propertiesList as $property) {
		                if($property[0]==$visit[1]){
		                	echo "
		                	<div class='w3-display-container w3-card w3-padding w3-padding-16 w3-margin-bottom w3-row'>
			                	<div class='w3-row w3-right'>
			                		<a onclick='openModal(\"remove".$visit[1]."\")'><i class='fa fa-remove edit-button'></i></a>
			                	</div>
								<div class='w3-col l5 m12 s12'>
									<img class='property-thumbnail' src='".$filePath.$property[1]."'>
								</div>
								<div class='w3-col l7 m12 s12' style='padding-left:40px'>
								    <p>".$property[2]."</p>
								    <p>".$this->ppt->getCountyIslandParish($property[8],"../")."</p>
							        <p>Data: ".$day." de ".$month." de ".$year."</p>
				               		<p>Hora: ".$visit[3]."H</p>
								</div>
    						</div>
		                	";

		                	echo "
							<div id='remove".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick=\"document.getElementById('remove".$visit[1]."').style.display='none'\" class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$userID."'>
					        	        <input type='hidden' name='propertyId' value='".$visit[1]."'>
					        	        <h3>Tem a certeza que quer cancelar este pedido?</h3>
							            <br>
										<div class='w3-row'>
											<div class='w3-col l6 m6 s6'>
												<button name='deleteVisitRequest' class='submitButton' type='submit'>SIM</button>
											</div>
											<div class='w3-col l6 m6 s6'>
												<button type='button' class='submitButton' onclick=\"document.getElementById('remove".$visit[1]."').style.display='none'\" >NÃO</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							";
		                }
					}
				}
			}
		}
	}

	public function visitRequest($userID,$propertyID,$date,$time,$status){
		$newVisitRequest = array($userID,$propertyID,$date,$time,$status);
        $visitRequests=file("../data/visitRequests.csv",FILE_SKIP_EMPTY_LINES);
        array_filter($visitRequests);
        $visitRequestsList=array();
        foreach ($visitRequests as $visit) {
            array_push($visitRequestsList, explode(",", $visit));
        }
        foreach ($visitRequestsList as $visit) {
            if ($visit[0]==$userID && $visit[1]==$propertyID) {
            	if($visit[4]==1){
            		echo "<script type='text/javascript'>alert('Já tem um pedido de visita pendente para esta imóvel!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'; </script>";
            	}elseif($visit[4]==2){
            		echo "<script type='text/javascript'>alert('Já tem uma visita marcada para esta imóvel!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'; </script>";
            	} elseif($visit[4]==3){
            		echo "<script type='text/javascript'>alert('O pedido de visita que efectuou para este imóvel foi recusado!'); window.location.href = '".$_SERVER['HTTP_REFERER']."'; </script>";
            	}
                return false;
            }
        }
        $file = fopen("../data/visitRequests.csv", "a");
        $newVisitRequest=implode(",", $newVisitRequest);
        fwrite($file, $newVisitRequest."\n");
        fclose($file);
        return true;
	}

	public function getManagerVisitRequests($userID){
		$this->ppt = new Property();
		$managerProperties=file("../data/imoveis.csv", FILE_SKIP_EMPTY_LINES);
		$visits = file("../data/visitRequests.csv", FILE_SKIP_EMPTY_LINES);
        $visitsList = array();
        $propertiesList=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);
        foreach ($visits as $visit) {
            array_push($visitsList, explode(",", $visit));
        }
        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
        }
        foreach ($visitsList as $visit) {
        	foreach ($managerProperties as $mp) {
        		$mp=explode(",", $mp);
        		if ((int)$mp[0]==(int)$property[0] && (int)$mp[1]==$userID) {
        			$visitDate=$visit[2];
					$day= date("d", strtotime($visitDate));
				    $month= date("M", strtotime($visitDate));
				    $year= date("Y", strtotime($visitDate));
					foreach ($propertiesList as $property) {
		                if ($visit[1]==$property[0] && $visit[4]==1) {
		                	echo "
				            <div class='w3-col l3 m12 s12 w3-display-container w3-card w3-padding'>
					            <div class='w3-row'>
					            	<div class='w3-col l9 m8 w3-hide-small'>
					            	<p></p>
				               		</div>
					           		<div class='w3-col l2 m2 s6'>
				               			<p onclick=\"openModal('accept".$visit[0]."-".$visit[1]."').style.display='block'\"><i class='fa fa-check edit-button'></i></p>
				               		</div>
				               		<div class='w3-col l1 m2 s6'>
					               		<p onclick=\"openModal('decline".$visit[0]."-".$visit[1]."').style.display='block'\"><i class='fa fa-remove edit-button'></i></p>
					               	</div>
					            </div>
								<div class='w3-rowrow'>
									<img class='property-thumbnail' src='../imoveis/".$property[0]."/".$property[1]."'>
								</div>
								<div class='w3-row'>
								    <p>".$property[2]."</p>
								    <p>".$this->ppt->getCountyIslandParish($property[9],"")."</p>
							        <p>Data: ".$day." de ".$month." de ".$year."</p>
						            <p>Hora: ".$visit[3]."H</p>
								</div>
		    				</div>
				           	";

							echo "
							<div id='accept".$visit[0]."-".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick=\"document.getElementById('accept".$visit[0]."-".$visit[1]."').style.display='none'\" class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$visit[0]."'>
							        	<input type='hidden' name='propertyId' value='".$visit[1]."'>
							        	<input type='hidden' name='date' value='".$visit[2]."'>
							        	<input type='hidden' name='time' value='".$visit[3]."'>
							            <h3>Tem a certeza que quer aceitar este pedido?</h3>
							            <br>
										<div class='w3-row'>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button name='acceptRequest' class='submitButton' type='submit'>SIM</button>
											</div>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button type='button' onclick=\"document.getElementById('accept".$visit[0]."-".$visit[1]."').style.display='none'\"class='submitButton'>NÃO</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							";
							

							echo "
							<div id='decline".$visit[0]."-".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick=\"document.getElementById('decline".$visit[0]."-".$visit[1]."').style.display='none'\" class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$visit[0]."'>
							        	<input type='hidden' name='propertyId' value='".$visit[1]."'>
							        	<input type='hidden' name='date' value='".$visit[2]."'>
							        	<input type='hidden' name='time' value='".$visit[3]."'>
							            <h3>Tem a certeza que quer recusar este pedido?</h3>
							            <br>
										<div class='w3-row'>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button name='declineRequest' class='submitButton' type='submit'>SIM</button>
											</div>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button onclick=\"document.getElementById('decline".$visit[0]."-".$visit[1]."').style.display='none'\" type='button' class='submitButton'>NÃO</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							";
						}
					}
        		}
        	}
		}
	}

	public function getManagerBookedVisits($userID){
		$this->ppt = new Property();
		$managerProperties=file("../data/imoveis.csv", FILE_SKIP_EMPTY_LINES);
		$visits = file("../data/visitRequests.csv", FILE_SKIP_EMPTY_LINES);
        $visitsList = array();
        $propertiesList=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);

        foreach ($visits as $visit) {
            array_push($visitsList, explode(",", $visit));
        }

        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
        }
        
        foreach ($visitsList as $visit) {
        	foreach ($managerProperties as $mp) {
        		$mp=explode(",", $mp);
        		if ((int)$mp[0]==(int)$property[0] && (int)$mp[1]==(int)$userID) {
		        	$visitDate=$visit[2];
					$day= date("d", strtotime($visitDate));
				    $month= date("M", strtotime($visitDate));
				    $year= date("Y", strtotime($visitDate));
					foreach ($propertiesList as $property) {
		                if ($visit[1]==$property[0] && $visit[4]==2) {
		                	echo "
				            <div class='w3-col l3 m12 s12 w3-display-container w3-card w3-padding'>
					            <div class='w3-row w3-right '>
				               		<p onclick=\"openModal('decline".$visit[0]."-".$visit[1]."').style.display='block'\"><i class='fa fa-remove edit-button'></i></p>
					            </div>
								<div class='w3-rowrow'>
									<img class='property-thumbnail' src='../imoveis/".$property[0]."/".$property[1]."'>
								</div>
								<div class='w3-row'>
								    <p>".$property[2]."</p>
								    <p>".$this->ppt->getCountyIslandParish($property[9],"")."</p>
							        <p>Data: ".$day." de ".$month." de ".$year."</p>
						            <p>Hora: ".$visit[3]."H</p>
								</div>
		    				</div>
				           	";

							echo "
							<div id='decline".$visit[0]."-".$visit[1]."' class='modal'>
								<form enctype='multipart/form-data' accept-charset='utf-8' class='modal-content animate' method='post' action='../php/visit.php'>
									<div class='w3-container' style='background-color:#f1f1f1'>
										<span onclick=\"document.getElementById('decline".$visit[0]."-".$visit[1]."').style.display='none'\" class='close'>&times;</span>
									</div>
									<div class='container'>
										<input type='hidden' name='userId' value='".$visit[0]."'>
							        	<input type='hidden' name='propertyId' value='".$visit[1]."'>
							        	<input type='hidden' name='date' value='".$visit[2]."'>
							        	<input type='hidden' name='time' value='".$visit[3]."'>
							            <h3>Tem a certeza que quer recusar este pedido?</h3>
							            <br>
										<div class='w3-row'>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button name='declineRequest' class='submitButton' type='submit'>SIM</button>
											</div>
											<div class='w3-col l6 m6 s6 w3-padding'>
												<button onclick=\"document.getElementById('decline".$visit[0]."-".$visit[1]."').style.display='none'\" type='button' class='submitButton'>NÃO</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							";
						}
					}
				}
			}
		}
	}

	public function updateVisitRequest($userID,$propertyID,$date,$time){
		$date=date($date);
		$visits = file("../data/visitRequests.csv",FILE_SKIP_EMPTY_LINES);
        $visitsList=array();
        $updatedVisit=array($userID,$propertyID,$date,$time);
        foreach ($visits as $visit) {
            array_push($visitsList, explode(",", $visit));
        }
        foreach ($visitsList as $visit) {
            if($userID==$visit[0] && $propertyID==$visit[1]){
                array_splice($visit,0,4,$updatedVisit);
                $newVisit=array($visit);
                for ($i=0; $i <sizeof($visitsList); $i++) { 
                    if($visitsList[$i][0]==$userID && $visitsList[$i][1]==$propertyID){
                        array_splice($visitsList,$i,1, $newVisit);
                    }
                }
                $file=fopen("../data/visitRequests.csv", "w");
                foreach ($visitsList as $visit) {
                    $visit=implode(",", $visit);
                    $visit=str_replace('"', '', $visit);
                    fwrite($file, $visit);
                }
                fclose($file);
                return true;
            } 
        }
        return false;
	}

	public function deleteVisit($userID,$propertyID){
		$visits = file("../data/visitRequests.csv",FILE_SKIP_EMPTY_LINES);
        $visitsList=array();
        foreach ($visits as $visit) {
            array_push($visitsList, explode(",", $visit));
        }
        foreach ($visitsList as $visit) {
            if($propertyID==$visit[1] && $userID==$visit[0]){
                for ($i=0; $i <sizeof($visitsList); $i++) { 
                    if($visitsList[$i][0]==$userID && $visitsList[$i][1]==$propertyID){
                        array_splice($visitsList,$i,1, "");
                    }
                }
            } 
        }
        array_filter($visitsList);
        $file=fopen("../data/visitRequests.csv","w");
        foreach ($visitsList as $visit) {
        	$visit=implode(',', $visit);
        	if ($visit!="") {
        		fwrite($file, $visit);
        	}
        }
        fclose($file);
        return true; 
	}

	public function handleVisitRequest($userID,$propertyID,$date,$time,$status){
		$visits=file("../data/visitRequests.csv", FILE_SKIP_EMPTY_LINES);
        $visitsList=array();
        $updatedVisits=array($userID,$propertyID,$date,$time,$status."\n");
        array_filter($visits);
        foreach ($visits as $visit) {
            array_push($visitsList, explode(",", $visit));
        }
        foreach ($visitsList as $key => $visit) {
            if ($visit[0]==$userID && $visit[1]==$propertyID) {
                array_splice($visitsList,$key,1,array($updatedVisits));
            }
        }
        $file=fopen("../data/visitRequests.csv", "w");
        foreach ($visitsList as $key => $value) {
        	$value=implode(",", $value);
        	$value=str_replace('"', '', $value);
        	$value=str_replace('\n', '', $value);
        	fwrite($file, $value);
        }
        fclose($file);
        return true;
	}

	public function getManagerDayVisits($userID){
		$this->ppt = new Property();
		$managerProperties=file("../data/imoveis.csv", FILE_SKIP_EMPTY_LINES);
		$visits = file("../data/visitRequests.csv", FILE_SKIP_EMPTY_LINES);
        $visitsList = array();
        $propertiesList=array();
        $dir="../imoveis/*";
        $dirs = glob($dir);

        $todayDay= date("d");
        $todayMonth= date("m");
        $todayYear= date("Y");

        foreach ($dirs as $folder) {
            $number=explode("/", $folder);
            $id=end($number);
            $properties = file($folder."/".$id.".csv",FILE_SKIP_EMPTY_LINES);
            foreach ($properties as $property) {
                array_push($propertiesList, explode(",", $property));
            }
        }
        
        foreach ($visits as $visit) {
        	$visit=explode(",", $visit);
        	$day= date("d", strtotime($visit[2]));
			$month= date("M", strtotime($visit[2]));
			$monthNum= date("m", strtotime($visit[2]));
			$year= date("Y", strtotime($visit[2]));
        	if ((int)$todayDay==(int)$day && (int)$todayMonth==(int)$monthNum && (int)$todayYear==(int)$year) {
        		foreach ($managerProperties as $mp) {
	        		$mp=explode(",", $mp);
	        		if ((int)$mp[0]==(int)$property[0] && (int)$mp[1]==(int)$userID) {
			        	
						foreach ($propertiesList as $property) {
			                if ($visit[1]==$property[0] && $visit[4]==2) {
			                	array_push($visitsList,"
					            <div class='w3-col l4 m12 s12 w3-display-container w3-padding'>
					            	<div class='w3-card w3-padding'>
										<div class='w3-row'>
											<img class='property-thumbnail' src='../imoveis/".$property[0]."/".$property[1]."'>
										</div>
										<div class='w3-row'>
										    <p>".$property[2]."</p>
										    <p>".$this->ppt->getCountyIslandParish($property[9],"")."</p>
									        <p>Data: ".$day." de ".$month." de ".$year."</p>
								            <p>Hora: ".$visit[3]."H</p>
										</div>
									</div>
			    				</div>
					           	");
							}
						}
					}
				}
        	}
        	else{
        		return"<div w3-center w3-container w3-padding-large><h2>Não tem visitas marcadas para hoje!</h2></div>";
        	}
		}
		return implode($visitsList);
	}
}

?>