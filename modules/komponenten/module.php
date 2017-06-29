<?php

require_once("code/table.php");

/*class Components {
	public static function list($spalten=array())
	{
		return array(
				array("k_id" => 0, "k_name" => "asdf", "l_id" => array("0"=>"1", "1"=>"5"), "k_einkaufsdatum"=>"13.06.17", "k_gewaehrleistung_bis"=>"25.10.25", "k_notiz"=>"test", "k_hersteller"=>"bla", "ka_id"=>array("Kackstift"=>array("name"=>"bla"))),
				array("id" => 1, "name" => "jklö", "komponenten" => array("="=>"2")));
	}
}*/

function komponenten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponenten</h1></div>';
	
	//$komponenten = Components::list();

	$rows = array();	
	$komponentenEdit = '<div><div class="row">
		
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
							<label>Name:</label>
							<input type="text" value="Name" id="Name" disabled class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
						<label>Komponentenart:</label>
								<select class="chosen-select feldAktivieren kompArt" disabled id="kompArt" >
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
									<tr>
										<td>Beispiel</td>
										<td><input name="beispiel1wert" value="15" size="10px" id="durchnummerieren" class="feldAktivieren" disabled /></td>
										<td>GB</td>
									</tr>
									<tr>
										<td>Beispiel</td>
										<td><input name="beispiel1wert" value="15" size="10px" id="durchnummerieren" class="feldAktivieren" disabled /></td>
										<td>GB</td>
									</tr>
									<tr>
										<td>Beispiel</td>
										<td><input name="beispiel1wert" value="15" size="10px" id="durchnummerieren" class="feldAktivieren" disabled /></td>
										<td>GB</td>
									</tr>
								</tbody>
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
										<select multiple class="chosen-select feldAktivieren Raeume" disabled id="Raeume">
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
								</tr>
								<tr>
									<td><label>Lieferant:</label></td>
									<td><select class="chosen-select feldAktivieren Lieferant" disabled id="Lieferant">
									<option value="1">Select 1</option>
									<option value="2">Select 2</option>
									<option value="3">Select 3</option>
									<option value="4">Select 4</option>
									<option value="5">Select 5</option>
									<option value="6">Select 6</option>
									<option value="7">Select 7</option>
									<option value="8">Select 8</option>
									<option value="9">Select 9</option>
									</select></td>
								</tr>
								<tr>
								<td><label>Gew&auml;hrleistungsdauer:</label></td>
								<td><input type="text" value="Gew&auml;hrleistungsdauer" id="gewaehrDauer" disabled class="feldAktivieren"/></td>
								</tr>
								<tr>
								<td><label>Hersteller:</label></td>
								<td><input type="text" value="Hersteller" id="Hersteller" disabled class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Seriennummer:</label></td>
								<td><input  type="text" value="Seriennummer" id="Seriennummer" disabled class="feldAktivieren"/></td>
							</tr>
							<tr>
								<td><label>Einkaufsdatum:</label></td>
								<td><input type="text" class="feldAktivieren datepicker" id="datepicker" id="Einkaufsdatum" disabled /></td>
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
							<input name="btnSave" type="button" class="btn feldAktivieren btn-primary" value="Speichern" onclick="clickSpeichern();" disabled id="speichern"/>
						</div>
						<div class="col-md-1">
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div></div>';
	
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => $komponentenEdit);
	$rows[] = array("cols" => array("Keine Ahnung", 1));
	$rows[] = array("cols" => array("Bearbeitbar", 0), "content" => $komponentenEdit);
	$rows[] = array("cols" => array("Apfel iMer", 0), "content" => $komponentenEdit);
	
	$content .= table_render(array("Name" => "string", "ID" => "int"),
			$rows,
			array("header" => "HINZUFÜGEN", "content" => '<div><div class="row">
		
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
							<label>Name:</label>
							<input type="text" value="Name" id="Name" disabled class="feldAktivieren"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
							<label>Komponentenart:</label>
							<select class="chosen-select feldAktivieren kompArt" id="kompArt"  >
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
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-4">	
						<script>
						var test = $(document.getElementsByClassName("kompArt"));
						for(test2 in test) {
							test2.setMaxHeight(test2.getParent().getParent().getParent().getParent().getParent().getParent().getComputedHeight()-80);
					}
					</script>
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
									<tr>
										<td>Beispiel</td>
										<td><input name="beispiel1wert" placeholder="15" size="10px" id="durchnummerieren" class="feldAktivieren"  /></td>
										<td>GB</td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
						<div class="col-md-1">
						</div>	
						<div class="col-md-4">
							<table class="table table-hover">
								<tr>
								<td><label>R&auml;ume:</label></td>
								<td><select multiple class="chosen-select feldAktivieren Raeume" id="Raeume"  >
									<option value="1">Select 1</option>
									<option value="2">Select 2</option>
									<option value="3">Select 3</option>
									<option value="4">Select 4</option>
									<option value="5">Select 5</option>
									<option value="6">Select 6</option>
									<option value="7">Select 7</option>
									<option value="8">Select 8</option>
									<option value="9">Select 9</option>
								</select></td>
							</tr>
							<tr>
								<td><label>Lieferant:</label></td>
								<td><select class="chosen-select feldAktivieren Lieferant" id="Lieferant"  >
									<option value="1">Select 1</option>
									<option value="2">Select 2</option>
									<option value="3">Select 3</option>
									<option value="4">Select 4</option>
									<option value="5">Select 5</option>
									<option value="6">Select 6</option>
									<option value="7">Select 7</option>
									<option value="8">Select 8</option>
									<option value="9">Select 9</option>
								</select></td>
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
								<td><label>Seriennummer:</label></td>
								<td><input  type="text" placeholder="Seriennummer" id="Seriennummer"  class="feldAktivieren"/></td>
							</tr>
							
							<tr>
								<td><label>Einkaufsdatum:</label></td>
								<td><input type="text" class="feldAktivieren datepicker" id="datepicker" id="Einkaufsdatum"  /></td>
							</tr>
						</table>
					</div>
					</div>
					<div class="row" id="popUpTable" style="display:none">
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
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>						
						<div class="col-md-2">
							<input name="btnHinzu" type="button" class="btn btn-primary" value="Registrieren" onclick="clickRegistrieren();" id="registrieren"/>
						</div>
						<!--div class="col-md-2">
							<input name="btnSave" type="button" class="btn btn-primary" value="Gruppen regestrieren" onclick="clickGrRegestrieren();"  id="gruppenregestrieren"/>
						</div-->
						<div class="col-md-1">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div></div>'));
	
	$content .= '<!-- zum initialisieren der chosen selects muss $(".chosen-select").chosen(); aufgerfen werden -->
    <script type="text/javascript">

        $(".chosen-select").chosen();		
			$( function() {
				$( ".datepicker" ).datepicker();
			} );			
	</script>';

	page_render($content);
	return true;
}

page_add_menu("Komponenten", "/komponenten");

mast_register_path("#^komponenten$#", "komponenten_show");
mast_register_path("#^\$#", "komponenten_show");

return true;
?>
