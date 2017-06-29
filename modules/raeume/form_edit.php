<?php
    function edit_raum_show($data_index, $array_komponenten) {
        
        $komponenten_arten = array('0' => 'all');    
        foreach ($array_komponenten as $komponent) {
             $komponenten_arten[] = $komponent["art"];
        }
        $komponenten_arten = array_unique($komponenten_arten);   


$str1=
        "<form action=''>
        <div class='row'>
        <div class='col-md-12'>
		<div class='card card-block' id='card-shadow'>
			<div class='card-title'>
                <div class='row'>
                    <div class='col-md-1'></div>
                    
                    <div class='col-md-4'>
                        <input type='text' class='changeEditStatus' placeholder='Raum-Nr.' disabled name='roomnr' />
                        <input type='text' class='changeEditStatus' placeholder='Bezeichnung' disabled name='roomdsg' />
                    </div>
                    
                    <div class='col-md-1'>
                    </div>
                    
                    <div class='col-md-4'>
                        <div class='short-div'>
                            <label>Komponentenart:</label>
                            <select disabled class='chosen-select selectKoArt' id='selectKoArt' style='width: 150px;' onchange=\"filterTableBySelect(document.getElementById('table_right$data_index'), this.value);\">";
                            
                            $strA="";
                                            foreach (array_unique($komponenten_arten) as $komponent) {

                                                $strA.= "<option value=\"".$komponent."\">".$komponent."</option>";
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
    
                                    if (!empty($array_komponenten)) {
                                        
                                        foreach ($array_komponenten as $komponent) {
                                            $name = $komponent['name'];
                                            $art = $komponent['art'];
                                            
                                            
                                            
                                            $str2 .= "<tbody>";
                                            $str2 .= "<tr>";
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
                                        if (!empty($array_komponenten)) {

                                            foreach ($array_komponenten as $komponent) {
                                                $name = $komponent['name'];
                                                $art = $komponent['art'];

                                                $str6.= "<tbody>";
                                                $str6.= "<tr>";
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
						
							<input name='btnRem' id='btnRem' type='button' class='btn changeEditStatus btn-primary' disabled value='entfernen'/>
						
                        <div class='col-md-4'></div>
						
							<input name='btnAdd' onclick=\"addKomponentenToCurrentList($data_index)\" id='btnAdd' type='button' class='btn changeEditStatus btn-primary' disabled style='margin-left: 5px;' value='hinzufügen'/>
					</div>
                    <br/>
                    <div class='row'>
                        <div class='col-md-1'></div>
                        
                        <div class='col-md-9'>
                            <textarea name='note' style='width:100%; height: 100px;' rows='2' class='changeEditStatus' disabled placeholder='Geben Sie hier Ihre Notiz ein...'></textarea>
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