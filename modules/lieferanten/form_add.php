<?php
function add_lieferant_show() {
	$return = '
	<div class="card card-block" id="card-shadow">
		<div class="card-title">
		<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-4">
						<input type="text" placeholder="Lieferant" id="Name" />
					</div>
					
					<div class="col-md-6">
					</div>					
					<div class="col-md-1">
						<input name="btnSave" type="button" class="btn btn-primary" value="Speichern" onclick="clickSpeichern();" id="speichern"/>
					</div>
				</div>	
		</div>
		<div class="card-text">
			<br/>
			<div class="vboxLeft">
								
				<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-4">	
						<div class="short-div" style="height:unset">
						<table class="table table-hover" >
							<thead>
								<tr>
									<th>Komponenten</th>
								</tr>
							</thead>
							<tbody >
								<tr>
									<td>Beispiel</td>
								</tr>
								<tr>
									<td>Beispiel</td>
								</tr>
								<tr>
									<td>Beispiel</td>
								</tr>
							</tbody>
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
									<td><input type="text" placeholder="Schlossallee" id="Name" /></td>
									
								</tr>
								<tr>
									<td>PLZ</td>
									<td><input type="text" placeholder="90488"  id="Name" /></td>
									
								</tr>
								<tr>
									<td>Ort</td>
									<td><input type="text" placeholder="N&uuml;rnberg" id="Name" /></td>
								</tr>
								<tr>
									<td>Telefonnummer</td>
									<td><input type="text" placeholder="0911 123456789" id="Name" /></td>
								</tr>
								<tr>
									<td>EMail</td>
									<td><input type="text" placeholder="beispiel.stalker@gmail.com" id="Name" /></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</div>';
	return $return;
	}
?>