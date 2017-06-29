<?php

require_once("code/table.php");
require_once("code/tablefunctions.php");

function komponenten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponenten</h1></div>';
	
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

	
	for($i =0; $i < count($komponenten); $i++) {
		
		$mask = "<div><form method=\"POST\">";
		
		$mask .= '<div class="card card-block" id="card-shadow">
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
							<input type="text" name="komp[k_name]" value="'.$komponenten[$i]["k_name"].'" id="Name" disabled class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
						<label>Komponentenart:</label>';
								
	for($j =0; $j < count($komponentenArten); $j++) {
		if($komponentenArten[$j]["ka_id"] == $komponenten[$i]["ka_id"]) {
			$mask .= $komponentenArten[$j]["ka_komponentenart"];
		}
	}
								
	$mask .= '
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
	$mask .= '	<tr>
								<td>'.$komponenten[$i]["komponentenattribute"][$j]["kat_bezeichnung"].'</td>
								<td><input name="kat[]" value="'.$komponenten[$i]["komponentenattribute"][$j]["khkat_wert"].'" size="10px" id="durchnummerieren" class="feldAktivieren" disabled /></td>
								<td>'.$komponenten[$i]["komponentenattribute"][$j]["kat_einheit"].'</td>
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
	for($k = 0; $k < count($komponenten[$i]["raeume"]); $k++) {	
		if($raeume[$j]["r_id"] == $komponenten[$i]["raeume"][$k]["r_id"]) {
			$vorhanden = true;
		 }
	}
		if($vorhanden) {
		$mask .= '<option selected value="'.$raeume[$j]["r_nr"].'"> Raum '.$raeume[$j]["r_nr"].'</option>';
		}
		else {
			$mask .= '<option value="'.$raeume[$j]["r_nr"].'"> Raum'.$raeume[$j]["r_nr"].'</option>';
		}
}
	
	
	
		
	$mask .= '</select>
									</td>
								</tr>
								<tr>
									<td><label>Lieferant:</label></td>
									<td><select class="chosen-select feldAktivieren Lieferant" disabled id="Lieferant">';
	
	for($k = 0; $k < count($lieferanten); $k++) {
		if(	$komponenten[$i]["l_id"] == $lieferanten[$k]["l_id"]) {
			$mask .= '<option selected value="'.$lieferanten[$k]["l_firmenname"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
			}
		else {
			$mask .= '<option value="'.$lieferanten[$k]["l_firmenname"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
		}
	}
	
	$mask .= '</select></td>
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

	
	
	$rows[] = array("cols" => array($komponenten[$i]["k_name"], 0), "content" => $mask);
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
							<input type="text" placeholder="Name" id="Name" class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
							<label>Komponentenart:</label>
							<select class="chosen-select feldAktivieren kompArt" id="kompArt"  >';
							
	for($j =0; $j < count($komponentenArten); $j++) {
		$britney .= '<option value="'.$komponentenArten[$j]["ka_komponentenart"].'">'.$komponentenArten[$j]["ka_komponentenart"].'</option>';
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
	


	for($j =0; $j < count($komponentenArten); $j++) {
		for($k =0; $k < count($komponentenArten[$j]["ka_spalten"]); $k++) {
		//if($komponentenArten[$j]["ka_komponentenart"] == ) {
		//	$britney .= $komponentenArten[$j]["ka_komponentenart"];
//		}
			$britney .=  '<tr style="display:none;" class="'.$komponentenArten[$j]["ka_komponentenart"].' displayNone">
							<td>'.$komponentenArten[$j]["ka_spalten"][$k]["kat_bezeichnung"].'</td>
										 <td><input name="beispiel1wert" size="10px" class="feldAktivieren" /></td>
										 <td>'.$komponentenArten[$j]["ka_spalten"][$k]["kat_einheit"].'</td>
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
								<td><select class="chosen-select feldAktivieren Lieferant" id="Lieferant"  >';
	
	for($k = 0; $k < count($lieferanten); $k++) {
		$britney .= '<option value="'.$lieferanten[$k]["l_firmenname"].'">'.$lieferanten[$k]["l_firmenname"].'</option>';
	}
	
	$britney .= '</select></td>
							</tr>
							<tr>
								<td><label>Gew&auml;hrleistungsdauer:</label></td>
								<td><input type="text" placeholder="Gew&auml;hrleistungsdauer" id="gewaehrDauer"  class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Hersteller:</label></td>
								<td><input type="text" placeholder="Hersteller" id="Hersteller"  class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Einkaufsdatum:</label></td>
								<td><input type="text" class="feldAktivieren datepicker" id="datepicker" id="Einkaufsdatum"  /></td>
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
										<th>Gew&auml;hrleistungsdauer</th>
										<th>Lieferant</th>
										<th>Einkaufsdatum</th>
									</tr>
								</thead>
								<tbody >
									<tr>
										<td><input  type="text" placeholder="Seriennummer"/></td>
										<td><input type="text" placeholder="Hersteller"/></td>
										<td><input type="text" placeholder="Gewaehrleistungsdauer" id="gewaehrDauer"  class="feldAktivieren"/></td>
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
			
		
		  $("#kompArt_chosen").click(function(){
			var kompArtAuswahl = $("#kompArt").chosen().val();
			var zuruecksetzen = document.getElementsByClassName("displayNone");
			for (let element of zuruecksetzen) {
				element.setAttribute("style", "display:none");
			}
			var anzeigen = document.getElementsByClassName(kompArtAuswahl);
			for (let element of anzeigen) {
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

