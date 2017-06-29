<?php
function maske_show($row = array('l_id' =>"", 'l_firmenname' =>"",'komponenten' => array(),'l_strasse' =>"",'l_plz' =>"",'l_ort' =>"",'l_tel' =>"",'l_mobil' =>"",'l_fax' =>"",'l_email' =>"")
					$kompart = array()) {
	$return = "<div><form method=\"POST\">";
		
		$return .= '<div class="card card-block" id="card-shadow">
			<div class="card-title">
			</div>
			<div class="card-text">
				<br/>
				<div class="vboxLeft">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">
							<label>Name:</label>
							<input type="text" name="komp[k_name]" value="'.$row["k_name"].'" id="Name" disabled class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
						<label>Komponentenart:</label>';
								
	foreach($kompart as $art){
		if($art["ka_id"] == $row["ka_id"]) {
			$return .= $art["ka_komponentenart"];
		}
	}
								
	$return .= '
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
							<div class="short-div" style="height:unset">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Attribut</th>
										<th>Wert</th>
										<th>Einheit</th>
									</tr>
								</thead>
								<tbody >
									';
	
for($j = 0; $j < count($komponenten[$i]["komponentenattribute"]); $j++) {
	$return .= '	<tr>
								<td><input type="hidden" name="kat[k_id]" value="'.$komponenten[$i]["komponentenattribute"][$j]["k_id"].'"/></td>
								<td><input type="hidden" name="kat[kat_id]" value="'.$komponenten[$i]["komponentenattribute"][$j]["kat_id"].'"/></td>
								<td>'.$komponenten[$i]["komponentenattribute"][$j]["kat_bezeichnung"].'</td>
								<td><input name="kat[]" value="'.$komponenten[$i]["komponentenattribute"][$j]["khkat_wert"].'" size="10px" id="durchnummerieren" class="feldAktivieren" disabled /></td>
								<td>'.$komponenten[$i]["komponentenattribute"][$j]["kat_einheit"].'</td>
							</tr>';
}


	$return .= '</tbody>
							</table>
							</div>
						</div>
						<div class="col-md-1">
						</div>	
						<div class="col-md-4">
							<table class="table table-hover">
								<tr>
									<td><label>R&auml;ume:</label></td>
									<td>
										<select multiple name="raeume" class="chosen-select feldAktivieren Raeume" disabled id="Raeume">';
for($j =0; $j < count($raeume); $j++) {
	$vorhanden = false;
	for($k = 0; $k < count($komponenten[$i]["raeume"]); $k++) {	
		if($raeume[$j]["r_id"] == $komponenten[$i]["raeume"][$k]["r_id"]) {
			$vorhanden = true;
		 }
	}
		if($vorhanden) {
		$return .= '<option selected value="'.$raeume[$j]["r_nr"].'"> Raum '.$raeume[$j]["r_nr"].'</option>';
		}
		else {
			$return .= '<option value="'.$raeume[$j]["r_nr"].'"> Raum'.$raeume[$j]["r_nr"].'</option>';
		}
}
	
	
	
		
	$return .= '</select>
									</td>
								</tr>
								<tr>
									<td><label>Lieferant:</label></td>
									<td><select class="chosen-select feldAktivieren Lieferant" disabled name="komp[l_id]">';
	
	for($k = 0; $k < count($lieferanten); $k++) {
		if(	$komponenten[$i]["l_id"] == $lieferanten[$k]["l_id"]) {
			$return .= '<option selected value="'.$lieferanten[$k]["l_id"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
			}
		else {
			$return .= '<option value="'.$lieferanten[$k]["l_id"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
		}
	}
	
	$return .= '</select></td>
								</tr>
								<tr>
								<td><label>Gew&auml;hrleistungsdauer:</label></td>
								<td><input type="text" value="'.$komponenten[$i]["k_gewaehrleistung_bis"].'" id="gewaehrDauer" disabled class="feldAktivieren"/></td>
								</tr>
								<tr>
								<td><label>Hersteller:</label></td>
								<td><input type="text" value="'.$komponenten[$i]["k_hersteller"].'" id="Hersteller" disabled class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Einkaufsdatum:</label></td>
								<td><input type="text" class="feldAktivieren datepicker" value="'.$komponenten[$i]["k_einkaufsdatum"].'" id="datepicker" id="Einkaufsdatum" disabled /></td>
							</tr>
							</table>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-1">
						</div>						
						<div class="col-md-2">
							<input name="btnBearb" type="button" class="btn bearbeitenDeaktivieren btn-primary" value="Bearbeiten" onclick="clickBearbeiten();" id="bearbeiten"/>
						</div>
						<div class="col-md-2">
							<input name="btnSave" type="submit" class="btn feldAktivieren btn-primary" value="Speichern" disabled id="speichern"/>
						</div>
						<div class="col-md-1">
						</div>
						<div class="col-md-2">
							<input name="btnLoesch" type="submit" class="btn btn-primary" value="L&ouml;schen" id="loeschen"/>
						</div>
						<div class="col-md-1">
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</form>
	</div>';

	return $return;
}
