<?php
function edit_lieferant_show($row = array()) {
	$return = '
	<form method="post">
	<input type="hidden" name="l_id" value="'.$row['l_id'].'"/>
	<div class="card card-block" id="card-shadow">
		<div class="card-title">
		</div>
		<div class="card-text">
			<br/>
			<div class="vboxLeft">
				<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-4">
						<input type="text" placeholder="Lieferant" name="lief[l_firmenname]" disabled class="feldAktivieren" value="'.$row['l_firmenname'].'"/>
					</div>
				</div>					
				<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-4">	
						<div class="short-div" style="height:unset">
						<table class="table table-hover" >
							<thead>
								<tr>
									<th>Komponenten</th>
									<th>Art</th>
								</tr>
							</thead>
							<tbody >';
foreach($row['komponenten'] as $komponent){
	$return .= '								<tr>';
	$return .= '<td>'.$komponent['k_name'].'</td>';
	$return .= '<td>'.$komponent['ka_komponentenart'].'</td>';
	$return .= '								</tr>';									
}
$return .='					</tbody>
						</table>
						</div>
					</div>
					<div class="col-md-1">
					</div>	
					<div class="col-md-4">							
							<table class="table table-hover" >
							<thead>
								<tr>
									<th colspan="2">Adresse</th>
								</tr>
							</thead>
							<tbody >
								<tr>
									<td>Stra&szlig;e / Hausnummer</td>
									<td><input type="text" placeholder="Schlossallee" name="lief[l_strasse]" disabled class="feldAktivieren" value="'.$row['l_strasse'].'"/></td>
									
								</tr>
								<tr>
									<td>PLZ</td>
									<td><input type="text" placeholder="90488"  name="lief[l_plz]" disabled class="feldAktivieren" value="'.$row['l_plz'].'"/></td>
									
								</tr>
								<tr>
									<td>Ort</td>
									<td><input type="text" placeholder="N&uuml;rnberg" name="lief[l_ort]" disabled class="feldAktivieren" value="'.$row['l_ort'].'"/></td>
								</tr>
								<tr>
									<td>Telefonnummer</td>
									<td><input type="text" placeholder="0911 123456789" name="lief[l_tel]" disabled class="feldAktivieren" value="'.$row['l_tel'].'"/></td>
								</tr>
								<tr>
									<td>Mobilnummer</td>
									<td><input type="text" placeholder="0911 123456789" name="lief[l_mobil]" disabled class="feldAktivieren" value="'.$row['l_mobil'].'"/></td>
								</tr>
								<tr>
									<td>Telefaxnummer</td>
									<td><input type="text" placeholder="0911 123456789" name="lief[l_fax]" disabled class="feldAktivieren" value="'.$row['l_fax'].'"/></td>
								</tr>
								<tr>
									<td>EMail</td>
									<td><input type="text" placeholder="beispiel.stalker@gmail.com" name="lief[l_email]" disabled class="feldAktivieren" value="'.$row['l_email'].'"/></td>
								</tr>
							</tbody>
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
				</div>
			</div>
		</div>
	</div>
	</form>';
	return $return;
	}
?>