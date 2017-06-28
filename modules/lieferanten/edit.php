<?php
    function edit_show() {
    $komponenten = array(
        0 => array(
            "name" => "Test1",
            "art" => "Storage"
        ),
        1 => array(
            "name" => "Test2",
            "art" => "Server"
        ),
        2 => array(
            "name" => "Test3",
            "art" => "Switch"
        ),
        3 => array(
            "name" => "Test4",
            "art" => "Client-PC"
        )
    );
    $komponenten_arten = array(
        "Storage",
        "Server",
        "Switch",
        "Client-PC",
        "Client-PC"
    );


$str1= "<div class='row'>
        <div class='col-md-12'>
		<div class='card card-block' id='card-shadow'>
			<div class='card-title'>
                <input type='text' placeholder='Raum-Nr.' name='roomnr' />
                <input type='text' placeholder='Bezeichnung' name='roomdsg' />
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
							<table class='table table-hover'>
								<thead>
								<tr>
									<th>Name</th>
									<th>Art</th>
								</tr>
								</thead>";
    $str2="";
    
                                    if (!empty($komponenten)) {
                                        $str2 .= "<tbody>";
                                        
                                        foreach ($komponenten as $komponent) {
                                            $name = $komponent['name'];
                                            $art = $komponent['art'];
                                            
                                            $str2 .= "<tr>";
                                            $str2 .= "<td>".$name."</td>";
                                            $str2 .= "<td>".$art."</td>";
                                            $str2 .= "</tr>";
                                        }
                                        
                                        $str2 .= "</tbody>";
                                    }
                                
$str3 = "
                            </table>
							</div>
							<div class='col-md-1'>
							</div>	
							<div class='col-md-4'>
								<div class='short-div'>
								<label>Komponentenart:</label>
                                    <select data-placeholder='test placeholder' class='chosen-select' style='width: 150px;' onchange=\"filterTableBySelect(document.getElementById('table_left'), this.value);\">";
                                        
        $str4="";
                                            foreach (array_unique($komponenten_arten) as $komponent) {

                                                $str4.= "<option value=\"".$komponent."\">".$komponent."</option>";
                                            }
                                        
                                $str5="</select>
								</div>
								<div class='short-div'>
								<table id='table_left' class='table table-hover'>
								<thead>
								<tr>
									<th>Name</th>
									<th>Art</th>
								</tr>
								</thead>";
                                $str6="";
                                    if (!empty($komponenten)) {
                                        
                                        foreach ($komponenten as $komponent) {
                                            $name = $komponent['name'];
                                            $art = $komponent['art'];
                                            
                                            $str6.= "<tbody>";
                                            $str6.= "<tr>";
                                            $str6.= "<td>".$name."</td>";
                                            $str6.= "<td>".$art."</td>";
                                            $str6.= "</tr>";
                                            $str6.= "</tbody>";
                                        }
                                        
                                    }
						$str7="	</table>
								</div>
							</div>
					</div>	
					<div class='row'>
						<div class='col-md-6'></div>
						<div class='col-md-1'>
							<input name='btnBearb' type='button' class='btn btn-primary' value='Bearbeiten'/>
						</div>
						<div class='col-md-1'>
							<input name='btnSave' type='button' class='btn btn-primary' value='Speichern'/>
						</div>
						<div class='col-md-1'>
							<input name='txtAnzahl' type='text'  value='55'/>
						</div>
						<div class='col-md-1'>
							<input name='btnAdd' type='button' class='btn btn-primary' value='Add'/>
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
        
        return $str1.$str2.$str3.$str4.$str5.$str6.$str7;
    }