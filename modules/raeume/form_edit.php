<?php
    function edit_raum_show($rooms, $components, $components_art) {
        
        $data_index = $rooms["r_id"];
        $roomNr = $rooms["r_nr"];
        $roomBezeichnung = $rooms["r_bezeichnung"];
        $roomNotiz = $rooms["r_notiz"];  
        
        $currentComponents_Of_Room = $rooms["komponenten"];
        
        
        $asdasd = array();
        
        foreach($components as $elementRight){
            
            foreach($currentComponents_Of_Room as $elementeLeft){
                if($elementRight["k_id"] != $elementeLeft["k_id"]){
                    $asdasd[] = $elementRight;
                }
            }         
        }

$str1 =
        "<form action=''>
        <div class='row'>
        <div class='col-md-12'>
		<div class='card card-block' id='card-shadow'>
			<div class='card-title'>
                <div class='row'>
                    <div class='col-md-1'></div>
                    
                    <div class='col-md-4'>
                        <input type='text' class='changeEditStatus' placeholder='Raum-Nr.' disabled name='roomnr' value='$roomNr' />
                        <input type='text' class='changeEditStatus' placeholder='Bezeichnung' value='$roomBezeichnung' disabled name='roomdsg' />
                    </div>
                    
                    <div class='col-md-1'>
                    </div>
                    
                    <div class='col-md-4'>
                        <div class='short-div'>
                            <label>Komponentenart:</label>
                            <select disabled class='chosen-select selectKoArt' id='selectKoArt' style='width: 150px;' onchange=\"filterTableBySelect(document.getElementById('table_right$data_index'), this.value);\">";
                            
                            $strA="";
                                            $strA.= "<option value='all'>all</option>";
                                            foreach ($components_art as $komponentart) {

                                                $strA.= "<option value=\"".$komponentart["ka_komponentenart"]."\">".$komponentart["ka_komponentenart"]."</option>";
                                            }
                            
                            $strB="</select>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <input name='btnSave' onclick='clickEditRoom()' id='btnSave' type='button' class='btn changeEditStatus btnEditRoom btn-primary' style='margin-left: 45px' value='Raum bearbeiten'/>
                    </div>
                </div>
			</div>
			<div class='card-text'>
				<br/>
				<div class='vboxLeft'>
						<div class='row'>
						<div class='col-md-1'>
						</div>	
						<div class='col-md-4'>
				        </div>	
						<div class='col-md-1'>
						</div>	
						</div>
					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-4'>	
							<table id='table_left$data_index' class='table table-hover'>
								<thead>
								<tr>
									<th>Name</th>
									<th>Art</th>
                                    <th style='width: 5px'></th>
								</tr>
								</thead>";
    $str2="";
    
                                    if (!empty($currentComponents_Of_Room)) {

                                            foreach ($currentComponents_Of_Room as $current_komponent) {
                                                $id = $current_komponent['k_id'];
                                                $name = $current_komponent['k_name'];
                                                $art = $current_komponent['ka_komponentenart'];
                                            
                                            
                                            
                                            $str2 .= "<tbody>";
                                            $str2 .= "<tr>";
                                            $str2 .= "<input type='hidden' name='id' value='$id'>";
                                            $str2 .= "<td>".$name."</td>";
                                            $str2 .= "<td>".$art."</td>";
                                            $str2 .= "<td> <div class='checkbox' >
                                                        <input class='changeEditStatus' disabled type='checkbox' value=''>
                                                      </div> </td>";
                                            $str2 .= "</tr>";
                                            $str2 .= "</tbody>";
                                        }
                                        
                                    }
                                
$str3 = "
                            </table>
							</div>
							<div class='col-md-1'>
							</div>	
							<div class='col-md-4'>";
	
                                $str5="
								<div class='short-div'>
								<table id='table_right$data_index' class='table table_right table-hover'>
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Art</th>
                                        <th style='width: 5px'></th>
                                    </tr>
                                    </thead>";
                                    $str6="";
                                        if (!empty($asdasd)) {

                                            foreach ($asdasd as $komponent) {
                                                
                                                $id = $komponent['k_id'];
                                                $name = $komponent['k_name'];
                                                $art = $komponent['ka_komponentenart'];

                                                $str6.= "<tbody>";
                                                $str6.= "<tr>";
                                                $str6 .= "<input type='hidden' name='id' value='$id'>";
                                                $str6.= "<td>".$name."</td>";
                                                $str6.= "<td>".$art."</td>";
                                                $str6 .= "<td> <div class='checkbox' >
                                                        <input class='changeEditStatus' disabled type='checkbox' value=''>
                                                      </div> </td>";
                                                $str6.= "</tr>";
                                                $str6.= "</tbody>";
                                            }

                                        }
						$str7="	</table>
								</div>
							</div>
					</div>	
					<div class='row'>
						<div class='col-md-4'></div>
						
							<input name='btnRem' id='btnRem' onclick='removeKomponentenToCurrentList($data_index)' type='button' class='btn changeEditStatus btn-primary' disabled value='entfernen'/>
						
                        <div class='col-md-4'></div>
						
							<input name='btnAdd' onclick=\"addKomponentenToCurrentList($data_index)\" id='btnAdd' type='button' class='btn changeEditStatus btn-primary' disabled style='margin-left: 5px;' value='hinzufügen'/>
					</div>
                    <br/>
                    <div class='row'>
                        <div class='col-md-1'></div>
                        
                        <div class='col-md-9'>
                            <textarea name='note' style='width:100%; height: 100px;' rows='2' class='changeEditStatus' disabled placeholder='Geben Sie hier Ihre Notiz ein...'>$roomNotiz</textarea>
                        </div>
                    </div>
                    
				</div>
			</div>
		
		</div>

	</div>
    </div>
    </form>
    <!-- zum initialisieren der chosen selects muss $('.chosen-select').chosen(); aufgerfen werden -->
    <script type='text/javascript'>
        $('.chosen-select').chosen();
        
    </script>";
        
        return $str1.$strA.$strB.$str2.$str3.$str5.$str6.$str7;
    }