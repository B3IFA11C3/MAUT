<?php
    function add_raum_show($components, $components_art) {
    
		$data_index = 0;

$str1= "<div class='row'>
        <div class='col-md-12'>
		<div class='card card-block' id='card-shadow'>
			<div class='card-title'>
                <div class='row'>
                    <div class='col-md-1'></div>
                    
                    <div class='col-md-4'>
                        <input type='text' class='' placeholder='Raum-Nr.'  name='roomnr' value='' />
                        <input type='text' class='' placeholder='Bezeichnung' value=''  name='roomdsg' />
                    </div>
                    
                    <div class='col-md-1'>
                    </div>
                    
                    <div class='col-md-4'>
                        <div class='short-div'>
                            <label>Komponentenart:</label>
                            <select  class='chosen-select ' id='selectKoArt' style='width: 150px;' onchange=\"filterTableBySelect(document.getElementById('table_right$data_index'), this.value);\">";
                            
                            $strA="";
                                           $strA.= "<option value='all'>all</option>";
                                            foreach ($components_art as $komponentart) {

                                                $strA.= "<option value=\"".$komponentart["ka_komponentenart"]."\">".$komponentart["ka_komponentenart"]."</option>";
                                            }
                            
                            $strB="</select>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <input name='btnSave' type='button' class='btn btn-primary' style='margin-left: 45px' value='Raum hinzufügen'/>
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
								</thead><tbody></tbody>";
    $str2="";
    
                
                                
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
								</thead><tbody></tbody>";
                                $str6="";
                                    if (!empty($components)) {

                                            foreach ($components as $komponent) {
                                                
                                                $id = $komponent['k_id'];
                                                $name = $komponent['k_name'];
                                                $art = $komponent['ka_komponentenart'];

                                                $str6.= "<tbody>";
                                                $str6.= "<tr>";
                                                $str6 .= "<input type='hidden' name='id' value='$id'>";
                                                $str6.= "<td>".$name."</td>";
                                                $str6.= "<td>".$art."</td>";
                                                $str6 .= "<td> <div class='checkbox' >
                                                        <input class=''  type='checkbox' value=''>
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
						
							<input name='btnRem' id='btnRem' onclick='removeKomponentenToCurrentList($data_index)' type='button' class='btn  btn-primary'  value='entfernen'/>
						
                        <div class='col-md-4'></div>
						
							<input name='btnAdd' onclick='addKomponentenToCurrentList($data_index)' id='btnAdd' type='button' class='btn  btn-primary'  style='margin-left: 5px;' value='hinzufügen'/>
					</div>
                    <br/>
                    <div class='row'>
                        <div class='col-md-1'></div>
                        
                        <div class='col-md-9'>
                            <textarea name='note' style='width:100%; height: 100px;' rows='2' placeholder='Geben Sie hier Ihre Notiz ein...'></textarea>
                        </div>
                    </div>
				</div>
			</div>
		
		</div>

	</div>
    </div>
    <!-- zum initialisieren der chosen selects muss $('.chosen-select').chosen(); aufgerfen werden -->
    <script type='text/javascript'>
        $('.chosen-select').chosen();
		
			$( function() {
				$( \"#datepicker\" ).datepicker();
			} );
	
	
		
    </script>";
        
        return $str1.$strA.$strB.$str2.$str3.$str5.$str6.$str7;
    }