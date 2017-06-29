<?php

require_once("code/table.php");
require_once("code/tablefunctions.php");

function komponentenarten_render_row($komponentenart)
{
	$content = '<div class="divslider">
					<div> <!-- Left side of Divslider -->
						<div>
						<form method="POST" style="display: table; width: 100%;">
							<input type="hidden" name="ka[ka_id]" value="' . htmlentities($komponentenart["ka_id"]) . '"/>
							<table class="table">
								<tr>
									<td>Einmalig:&nbsp;</td> 
									<td>' . ($komponentenart["ka_einmalig"] ? "Ja" : "Nein") . '</td>
								</tr>
								<tr>
									<td>Attribute:&nbsp;</td> <td>';
										foreach($komponentenart['ka_spalten'] as $attr) {
											$content .= $attr['kat_bezeichnung'] . ' (' . $attr['kat_typ'] . ') <br>'; 
										}
										$content .= '
									</td>
								</tr>
							</table>
							<div class="switch" style="position: initial;">
								<button type="submit" class="btn btn-primary" name="action" value="delete">L&ouml;schen</button>
								<button type="button" class="btn btn-primary" onClick="divSliderShowRight(this.closest(\'.divslider\'))">Bearbeiten</button>
							</div>
						</form>
						</div>
					</div>

					<div> <!-- Right side of Divslider -->
						<div>
						<form method="POST" style="display: table; width: 100%;">
							<input type="hidden" name="ka[ka_id]" value="' . htmlentities($komponentenart["ka_id"]) . '"/>
							<label style="display: table-cell">Einmalig: <input type="checkbox" ' . ($komponentenart["ka_einmalig"] ? "checked" : "") . ' name="ka[ka_einmalig]"/></label>
							<label style="display: table-cell">Name: <input type="text" name="ka[ka_komponentenart]" value="' . htmlentities($komponentenart["ka_komponentenart"]) . '"/></label>
							<div class="switch" style="position: initial;">
								<button class="btn btn-primary" type="submit" name="action" value="save">Speichern</button>
								<button class="btn btn-primary" type="button" onClick="divSliderShowLeft(this.closest(\'.divslider\'))">Zur&uuml;ck</button>
							</div>
						</form>
						</div>
					</div>
				</div>';

	return array("cols" => array($komponentenart["ka_id"], $komponentenart["ka_komponentenart"]),
				 "content" => $content);
}

function komponentenarten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponentenarten</h1></div>';

	if(isset($_POST["action"]))
	{
		$success = false;
	
		if($_POST["action"] == "delete") {
			$success = Componenttypes::delete((int)$_POST["ka"]["ka_id"]);
		} 
		else if($_POST["action"] == "save")
		{
			$value = array("ka_komponentenart" => $_POST["ka"]["ka_komponentenart"],
						   "ka_einmalig" => (isset($_POST["ka"]["ka_einmalig"]) ? 1 : 0));
			$success = Componenttypes::change((int)$_POST["ka"]["ka_id"], $value);
		}
		else if($_POST["action"] == "insert")
		{
            if($_POST["ka"]["ka_komponentenart"] != '') {
                $value = array("ka_komponentenart" => $_POST["ka"]["ka_komponentenart"],
                            "ka_einmalig" => (isset($_POST["ka"]["ka_einmalig"]) ? 1 : 0));

                $added = Componenttypes::add($value);
                var_dump($_POST["ka"]["attribute"]);
                foreach($_POST["ka"]["attribute"] as $attr) { 
                    Componenttypes::addattr($added, $attr);
                }
                $success = $added;
            } else {
                $success = false;
            }
		}

		if(!$success)
			$content .= '<div class="alert alert-danger" role="alert" style="width: 90%; margin: 10px auto;"><center><b>Fehler!</b> Konnte nicht gespeichert werden.</center></div>';
		else
			$content .= '<div class="alert alert-success" role="alert" style="width: 90%; margin: 10px auto;"><center><b>Erfolgreich gespeichert!</b></center></div>';
	}
	
	$insert = '<div><div style="padding: 10.5px">
					<form method="POST" style="display: table; width: 100%;">
						<table>
							<tr>
								<td>Name:&nbsp;</td> <td><input type="text" name="ka[ka_komponentenart]"/></td>
							</tr>
							<tr>
								<td>Attribute:&nbsp;</td> 
								<td>
									<select name="ka[attribute][]" class="chosen-select" multiple data-placeholder="W&auml;hle Attribute"> ';
										foreach(Componentattributes::list_all() as $attr) {
											$insert .= '<option value="' . $attr['kat_id'] . '">' . htmlentities($attr['kat_bezeichnung']) . ' (' . htmlentities($attr['kat_typ']) . ')</option>';
										}
										$insert .= '    
									</select>
								</td>
							</tr>
							<tr>
								<td>Einmalig:&nbsp</td>
								<td><input type="checkbox" checked name="ka[ka_einmalig]"/></td>
							</tr>
						</table>
						<div class="switch" style="position: initial;">
							<button type="submit" class="btn btn-primary" name="action" value="insert">Speichern</button>
						</div>
					</form>
				</div></div>';

	$content .= table_render(array("ID" => "int", "Name" => "string"),
			array_map("komponentenarten_render_row", Componenttypes::list_all()),
			array("header" => "Komponentenart hinzuf&uuml;gen", "content" => $insert));
    $content .= '<script type="text/javascript">$(".chosen-select").chosen();</script>';

	page_render($content);
	return true;
}

page_add_menu("Komponentenarten", "/komponentenarten");

mast_register_path("#^komponentenarten$#", "komponentenarten_show");

return true;
?>
