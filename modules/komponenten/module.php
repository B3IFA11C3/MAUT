<?php

require_once("code/table.php");
require_once("code/tablefunctions.php");

function komponenten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponenten</h1></div>';
	$status = "";

	if(isset($_POST["btnLoesch"]))
		$status = Components::delete((int)$_POST['k_id']) ? "success" : "error";
	else if(isset($_POST["btnSave"]))
		$status = Components::change((int)$_POST['k_id'], $_POST['komp']) ? "success" : "error";
	else if(isset($_POST["btnHinzu"]))
	{
		$status = "error";
		$id = Components::add($_POST['komp']);
		if($id !== FALSE)
		{
			$status = "success";
			foreach($_POST["kat"] as $kat)
				Components::setattr($id, $kat["kat_id"], $kat["khkat_wert"]);
		}
	}

	if($status == "error")
		$content .= '<div class="alert alert-danger" role="alert" style="width: 90%; margin: 10px auto;"><center><b>Fehler!</b> Konnte nicht gespeichert werden.</center></div>';
	else if($status == "success")
		$content .= '<div class="alert alert-success" role="alert" style="width: 90%; margin: 10px auto;"><center><b>Erfolgreich gespeichert!</b></center></div>';
	
	if(isset($_POST['kat']) && isset($_POST['btnSave'])){
		foreach($_POST['kat'] as $kat){		
			Components::setattr($_POST['k_id'], $kat['kat_id'], $kat['khkat_wert']);
		}
	}
	
	$komponenten = Components::list_all();
	$komponentenArten = Componenttypes::list_all();
	$raeume = Rooms::list_all();
	$lieferanten = Supplier::list_all();
	//echo "<pre>".print_r($komponenten, true)."</pre>";
	//echo "<pre>".print_r(count($komponenten), true)."</pre>";
	//echo "<pre>".print_r($komponentenArten, true)."</pre>";
    //echo "<pre>".print_r($raeume, true)."</pre>";
	//echo "<pre>".print_r($lieferanten, true)."</pre>";
	//echo "<pre>".print_r(count($komponenten[0]["raeume"]), true)."</pre>";
	
	$rows = array();
	
	if(isset($_POST["btnSave"])) {
		$hinzufuegen = array("k_name"=>"54");
	}
	
	foreach($komponenten as $komp){
		
		$mask = "<div><form method=\"POST\">";
		
		$mask .= '<div class="card card-block" id="komp' . $komp['k_id'] . '">
			<input type="hidden" name="k_id" value="'.$komp['k_id'].'"/>
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
							<input type="text" name="komp[k_name]" value="'.$komp["k_name"].'" id="Name" disabled class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
						<label>Komponentenart:</label>'.$komp["ka_komponentenart"].'
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
foreach($komp["komponentenattribute"] as $att) {
	$mask .= '	<tr>
								<td>'.$att["kat_bezeichnung"].'</td>
									<input name="kat['.(string)$att['kat_id'].'][k_id]" value="'.$att["k_id"].'" type="hidden" />
									<input name="kat['.(string)$att['kat_id'].'][kat_id]" value="'.$att["kat_id"].'" type="hidden" />
								<td><input name="kat['.(string)$att['kat_id'].'][khkat_wert]" value="'.$att["khkat_wert"].'" size="10px" id="durchnummerieren" class="feldAktivieren" disabled /></td>
								<td>'.$att["kat_einheit"].'</td>
							</tr>';
}


	$mask .= '</tbody>
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
	for($k = 0; $k < count($komp["raeume"]); $k++) {	
		if($raeume[$j]["r_id"] == $komp["raeume"][$k]["r_id"]) {
			$vorhanden = true;
		 }
	}
		if($vorhanden) {
		$mask .= '<option selected value="'.$raeume[$j]["r_id"].'"> Raum '.$raeume[$j]["r_nr"].'</option>';
		}
		else {
			$mask .= '<option value="'.$raeume[$j]["r_id"].'"> Raum'.$raeume[$j]["r_nr"].'</option>';
		}
}
	
	
	
		
	$mask .= '</select>
									</td>
								</tr>
								<tr>
									<td><label>Lieferant:</label></td>
									<td><select class="chosen-select feldAktivieren Lieferant" disabled name="komp[l_id]">';
	
	for($k = 0; $k < count($lieferanten); $k++) {
		if(	$komp["l_id"] == $lieferanten[$k]["l_id"]) {
			$mask .= '<option selected value="'.$lieferanten[$k]["l_id"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
			}
		else {
			$mask .= '<option value="'.$lieferanten[$k]["l_id"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
		}
	}
	
	$mask .= '</select></td>
								</tr>
								<tr>
								<td><label>Gew&auml;hrleistungende:</label></td>
								<td><input name="komp[k_gewaehrleistung_bis]" type="text" value="'.$komp["k_gewaehrleistung_bis"].'" id="gewaehrDauer" disabled class="feldAktivieren"/></td>
								</tr>
								<tr>
								<td><label>Hersteller:</label></td>
								<td><input name="komp[k_hersteller]" type="text" value="'.$komp["k_hersteller"].'" id="Hersteller" disabled class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Einkaufsdatum:</label></td>
								<td><input name="komp[k_einkaufsdatum]" type="text" class="feldAktivieren datepicker" value="'.$komp["k_einkaufsdatum"].'" id="datepicker" id="Einkaufsdatum" disabled /></td>
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

	
	
	$rows[] = array("cols" => array($komp["k_name"], $komp["k_id"]), "content" => $mask);
	}
	
	
	
	
		$britney = "<div><form method=\"POST\">";
		
	$britney .=	'<div class="card card-block" id="card-shadow">
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
							<input name ="komp[k_name]" type="text" placeholder="Name" id="Name" class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
							<label>Komponentenart:</label>
							<select class="chosen-select feldAktivieren kompArt" name="komp[ka_id]" id="kompArt" >';
							
	for($j =0; $j < count($komponentenArten); $j++) {
		$britney .= '<option value="'.$komponentenArten[$j]["ka_id"].'">'.$komponentenArten[$j]["ka_komponentenart"].'</option>';
	}
			$britney .=	'</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
						<div class="short-div">
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
	


	foreach($komponentenArten as $art) {
		foreach($art["ka_spalten"] as $att) {
		//if($komponentenArten[$j]["ka_komponentenart"] == ) {
		//	$britney .= $komponentenArten[$j]["ka_komponentenart"];
//		}

			$britney .=  '<tr style="display:none;" class="ka_'.$art['ka_id'].' displayNone">
							<td>'.$att["kat_bezeichnung"].'</td>
								<input name="kat['.(string)$att['kat_id'].'][kat_id]" value="'.$att["kat_id"].'" type="hidden" />
							<td><input name="kat['.(string)$att['kat_id'].'][khkat_wert]" size="10px" class="feldAktivieren" /></td>
							<td>'.$att["kat_einheit"].'</td>
						</tr>';
		}
	}
									
						$britney .=		'</tbody>
							</table>
							</div>
						</div>
						<div class="col-md-1">
						</div>	
						<div class="col-md-4">
							<table class="table table-hover">
								<tr>
								<td><label>R&auml;ume:</label></td>
								<td><select multiple class="chosen-select feldAktivieren Raeume" id="Raeume"  >';
for($j =0; $j < count($raeume); $j++) {
	$britney .= '<option value="'.$raeume[$j]["r_nr"].'"> Raum'.$raeume[$j]["r_nr"].'</option>';
}
				$britney .=				'</select></td>
							</tr>
							<tr>
								<td><label>Lieferant:</label></td>
								<td><select class="chosen-select feldAktivieren Lieferant" name="komp[l_id]"  >';
	
	for($k = 0; $k < count($lieferanten); $k++) {
		$britney .= '<option value="'.$lieferanten[$k]["l_id"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
	}
	
	$britney .= '</select></td>
							</tr>
							<tr>
								<td><label>Gew&auml;hrleistungsende:</label></td>
								<td><input name="komp[k_gewaehrleistung_bis]" type="text" placeholder="Gew&auml;hrleistungsende" id="gewaehrDauer"  class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Hersteller:</label></td>
								<td><input name="komp[k_hersteller]" type="text" placeholder="Hersteller" id="Hersteller"  class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Einkaufsdatum:</label></td>
								<td><input name="komp[k_einkaufsdatum]" type="text" class="feldAktivieren datepicker" id="datepicker" id="Einkaufsdatum"  /></td>
							</tr>
						</table>
					</div>
					</div>
					<!--div class="row" id="popUpTable" style="display:none">
						<div class="col-md-1">
						</div>						
						<div class="col-md-6">
							<table class="table table-hover" >
								<thead>
									<tr>
										<th>Seriennummer</th>
										<th>Hersteller</th>
										<th>Gew&auml;hrleistungsende</th>
										<th>Lieferant</th>
										<th>Einkaufsdatum</th>
									</tr>
								</thead>
								<tbody >
									<tr>
										<td><input  type="text" placeholder="Seriennummer"/></td>
										<td><input type="text" placeholder="Hersteller"/></td>
										<td><input type="text" placeholder="Gewaehrleistungsende" id="gewaehrDauer"  class="feldAktivieren"/></td>
										<td>
											<select class="chosen-select feldAktivieren Lieferant" id="Lieferant"  >
												<option value="1">Select 1</option>
												<option value="2">Select 2</option>
												<option value="3">Select 3</option>
												<option value="4">Select 4</option>
												<option value="5">Select 5</option>
												<option value="6">Select 6</option>
												<option value="7">Select 7</option>
												<option value="8">Select 8</option>
												<option value="9">Select 9</option>
											</select>
										</td>	
										<td><input type="text" class="feldAktivieren datepicker" id="datepicker" id="Einkaufsdatum"  /></td>											
									</tr>
									<tr>
										<td rowspan="5"><input type="button" class="btn btn-primary" ></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-1">
						</div>
					</div-->
					<div class="row">
						<div class="col-md-1">
						</div>						
						<div class="col-md-2">
							<input name="btnHinzu" type="submit" class="btn btn-primary" value="Registrieren" onclick="clickRegistrieren();" id="registrieren"/>
						</div>
						<!--div class="col-md-2">
							<input name="btnSave" type="submit" class="btn btn-primary" value="Gruppen regestrieren" onclick="clickGrRegestrieren();"  id="gruppenregestrieren"/>
						</div-->
						<div class="col-md-1">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form></div>';
	
	$content .= table_render(array("Name" => "string", "ID" => "int"),
			$rows,
			array("header" => "HINZUFÜGEN", "content" => $britney));
			
	
	$content .= '<!-- zum initialisieren der chosen selects muss $(".chosen-select").chosen(); aufgerfen werden -->
    <script type="text/javascript">

        $(".chosen-select").chosen();		
			$( function() {
				$( ".datepicker" ).datepicker();
			} );
			
		
		  $("#kompArt").change(function(){
			var kompArtAuswahl = $("#kompArt", this.parentNode).chosen().val();
			console.log(kompArtAuswahl);
			var zuruecksetzen = document.getElementsByClassName("displayNone");
			for (let element of zuruecksetzen) {
				$("input", element).each(function(i, e) { e.setAttribute("disabled", "disabled"); });
				element.setAttribute("style", "display:none");
			}
			var anzeigen = document.getElementsByClassName("ka_" + kompArtAuswahl);
			for (let element of anzeigen) {
				$("input", element).each(function(i, e) { e.removeAttribute("disabled"); });
				element.setAttribute("style", "display:visible");
			}
		  });		

		
	
		
	</script>';

	page_render($content);
	return true;
}

page_add_menu("Komponenten", "/komponenten");

mast_register_path("#^komponenten$#", "komponenten_show");
mast_register_path("#^\$#", "komponenten_show");

return true;
?>

