<?php

require_once("code/table.php");
require_once("code/tablefunctions.php");

function komponentenattribute_render_row($komponente)
{
	$content = '<div class="divslider">';
	$content .= '<div>
					<div>
					<form method="POST" style="display: table; width: 100%;">
						<input type="hidden" name="kat[kat_id]" value="' . htmlentities($komponente["kat_id"]) . '"/>
						<label style="display: table-cell">Einzigartig: ' . ($komponente["kat_einzigartig"] ? "Ja" : "Nein") . '</label>
						<label style="display: table-cell">Einheit: ' . ($komponente["kat_einheit"] === NULL ? "<i>Keine</i>" : htmlentities($komponente["kat_einheit"])) . '</label>
						<div class="switch">
							<button type="submit" name="action" value="delete">L&ouml;schen</button>
							<button type="button" onClick="divSliderShowRight(this.parentNode.parentNode.parentNode.parentNode.parentNode)">Bearbeiten</button>
						</div>
					</form>
					</div>
				</div>';
	$content .= '<div>
					<div>
					<form method="POST" style="display: table; width: 100%;">
						<input type="hidden" name="kat[kat_id]" value="' . htmlentities($komponente["kat_id"]) . '"/>
						<label style="display: table-cell">Einzigartig: <input type="checkbox" ' . ($komponente["kat_einzigartig"] ? "checked" : "") . ' name="kat[kat_einzigartig]"/></label
						<label style="display: table-cell">Name: <input type="text" name="kat[kat_bezeichnung]" value="' . htmlentities($komponente["kat_bezeichnung"]) . '"/></label>
						<label style="display: table-cell">Einheit: <input type="text" name="kat[kat_einheit]" value="' . ($komponente["kat_einheit"] === NULL ? "" : htmlentities($komponente["kat_einheit"])) . '"/></label>
						<label style="display: table-cell; padding-right: 20%">Typ: <select name="kat[kat_typ]">
								<option value="int"' . ($komponente["kat_typ"] == "int" ? " selected" : "") . '>int</option>
								<option value="string"' . ($komponente["kat_typ"] == "string" ? " selected" : "") . '>string</option>
								<option value="bool"' . ($komponente["kat_typ"] == "bool" ? " selected" : "") . '>bool</option>
								<option value="date"' . ($komponente["kat_typ"] == "date" ? " selected" : "") . '>date</option>
								<option value="datetime"' . ($komponente["kat_typ"] == "datetime" ? " selected" : "") . '>datetime</option>
								<option value="float"' . ($komponente["kat_typ"] == "float" ? " selected" : "") . '>float</option>
							</select>
						</label>
						<div class="switch">
							<button type="submit" name="action" value="save">Speichern</button>
							<button type="button" onClick="divSliderShowLeft(this.parentNode.parentNode.parentNode.parentNode.parentNode)">Zur&uuml;ck</button>
						</div>
					</form>
					</div>
				</div>';
	$content .= '</div>';

	return array("cols" => array($komponente["kat_id"], $komponente["kat_bezeichnung"], $komponente["kat_typ"]),
				 "content" => $content);
}

function komponentenattribute_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponentenattribute</h1></div>';

	if(isset($_POST["action"]))
	{
		$success = false;
	
		if($_POST["action"] == "delete")
			$success = Componentattributes::delete((int)$_POST["kat"]["kat_id"]);
		else if($_POST["action"] == "save")
		{
			$value = array("kat_bezeichnung" => $_POST["kat"]["kat_bezeichnung"], "kat_typ" => $_POST["kat"]["kat_typ"],
						   "kat_einzigartig" => ($_POST["kat"]["kat_einzigartig"] == "on" ? 1 : 0));
			$success = Componentattributes::change((int)$_POST["kat"]["kat_id"], $value);
		}

		if(!$success)
			$content .= '<div class="alert alert-danger" role="alert" style="width: 90%; margin: 10px auto;"><center><b>Fehler!</b> Konnte nicht gespeichert werden.</center></div>';
		else
			$content .= '<div class="alert alert-success" role="alert" style="width: 90%; margin: 10px auto;"><center><b>Erfolgreich gespeichert!</b></center></div>';
	}

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
