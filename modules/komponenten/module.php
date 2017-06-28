<?php

require_once("code/table.php");

function komponenten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponenten</h1></div>';

	$rows = array();
	
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>HIER STEHT ZEUG</div>");
	$rows[] = array("cols" => array("Keine Ahnung", 1));
	$rows[] = array("cols" => array("Bearbeitbar", 0), "content" => '<div class="divslider">
						<div>
							<label>Hersteller: Wahwei</label>
							<label>Beschreibung: Ändreud</label>
							<label>Garantie: 34.15.1337</label>
							<br>
							<label>Hersteller: Wahwei</label>
							<label>Beschreibung: Ändreud</label>
							<label>Garantie: 34.15.1337</label>
							<button class="switch" onClick="divSliderShowRight(this.parentNode.parentNode)">Bearbeiten</button>
						</div>
						<div>
							<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
							<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
							<label>Garantie: <input type="date" name="guar"/></label>
							<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
							<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
							<label>Garantie: <input type="date" name="guar"/></label>

							<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
							<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
							<button class="switch" onClick="divSliderShowLeft(this.parentNode.parentNode)">Zurück</button>
						</div>
					</div>');
	$rows[] = array("cols" => array("Apfel iMer", 0), "content" => "<div>HIER STEHT ZEUG</div>");
	
	$content .= table_render(array("Name" => "string", "ID" => "int"),
			$rows,
			array("header" => "HINZUFÜGEN", "content" => "<div>HINZUFÜGENCONTENT</div>"));

	page_render($content);
	return true;
}

page_add_menu("Komponenten", "/komponenten");

mast_register_path("#komponenten$#", "komponenten_show");
mast_register_path("#^\$#", "komponenten_show");

return true;
?>
