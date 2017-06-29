<?php

require_once("code/table.php");
require_once("code/tablefunctions.php");

/*class Componentattributes {
	public static function list()
	{
		return array(
			array("kat_id" => 0, "kat_bezeichnung" => "Seriennummer", "kat_typ" => "int", "kat_einzigartig" => FALSE),
			array("kat_id" => 1, "kat_bezeichnung" => "Serienzahl", "kat_typ" => "int", "kat_einzigartig" => FALSE),
			array("kat_id" => 2, "kat_bezeichnung" => "Funktioniert", "kat_typ" => "bool", "kat_einzigartig" => TRUE));
	}
}*/

function komponentenattribute_render_row($komponente)
{
	$content = '<div class="divslider">';
	$content .= '<div>
					<form method="POST">
						<input type="hidden" name="kat[id]" value="' . htmlentities($komponente["kat_id"]) . '"/>
						Einzigartig: ' . ($komponente["kat_einzigartig"] ? "Ja" : "Nein") . '
						<div class="switch">
							<button type="submit" name="action" value="delete">L&ouml;schen</button>
							<button type="button" onClick="divSliderShowRight(this.parentNode.parentNode.parentNode.parentNode)">Bearbeiten</button>
						</div>
						<br><br>
					</form>
				</div>';
	$content .= '<div>
					<button type="button" onClick="divSliderShowRight(this.parentNode.parentNode)">Bearbeiten</button>
				</div>';
	$content .= '</div>';

	return array("cols" => array($komponente["kat_id"], $komponente["kat_bezeichnung"], $komponente["kat_typ"]),
				 "content" => $content);;
}

function komponentenattribute_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponentenattribute</h1></div>';
	
	$content .= table_render(array("ID" => "int", "Name" => "string", "Typ" => "string"),
			array_map("komponentenattribute_render_row", Componentattributes::list()),
			array("header" => "HINZUFÜGEN", "content" => '<div></div>'));

	page_render($content);
	return true;
}

page_add_menu("Komponentenattribute", "/komponentenattribute");

mast_register_path("#^komponentenattribute$#", "komponentenattribute_show");

return true;
?>
