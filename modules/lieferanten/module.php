<?php

require_once("code/table.php");
require_once("edit.php");

function lieferanten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Lieferanten</h1></div>';

	$rows = array();
	
	/*$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>HIER STEHT ZEUG</div>");
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
	$rows[] = array("cols" => array("Apfel iMer", 0), "content" => "<div>HIER STEHT ZEUG</div>");*/
	
    
    $content_header_add = edit_show();
    
	$content .= table_render(array("Name" => "string", "ID" => "int"),
			$rows,
			array("header" => "<b>+</b>", "content" => "<div>".$content_header_add."</div>"));

	page_render($content);
	return true;
}

page_add_menu("Lieferanten", "/lieferanten");

mast_register_path("#lieferanten$#", "lieferanten_show");
mast_register_path("#^\$#", "lieferanten_show");

return true;
?>
