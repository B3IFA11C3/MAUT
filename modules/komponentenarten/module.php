<?php

require_once("code/table.php");
require_once("code/tablefunctions.php");

//wird beschrieben durch
//gibt zurück, ob die Komponentenart das Attribut enthält
function wbs($ka, $kat) {
	foreach($ka['ka_spalten'] as $ka_kat) {
		if($ka_kat['kat_id'] == $kat['kat_id']) return true;
	}
	return false;
}

function komponentenarten_render_row($komponentenart)
{
	$content = '<div style="margin-left: 15px;">
					<form method="POST" style="display: table; width: 100%;">
						<input type="hidden" name="ka[ka_id]" value="' . htmlentities($komponentenart["ka_id"]) . '"/>
						<table class="editable_edit_table"><tbody>
							<tr>
								<td>Name:&nbsp;</td> 
								<td><input class="edit_' . $komponentenart['ka_id'] . '" type="text" name="ka[ka_komponentenart]" disabled="true" value="' . htmlentities($komponentenart["ka_komponentenart"]) . '"/></td>
							</tr>
							<tr>
								<td>Attribute:&nbsp;</td> 
								<td> 
									<select name="ka[attribute][]" disabled="true" class="chosen-select edit_' . $komponentenart['ka_id'] . '" id="edit_attributes_' . $komponentenart['ka_id'] . '" multiple data-placeholder="keine Attribute vorhanden">';
										foreach(Componentattributes::list_all() as $attr) {
											$content .= '<option value="' . $attr['kat_id'] . '" ' . (wbs($komponentenart, $attr)?'selected':'') . ' >' . htmlentities($attr['kat_bezeichnung']) . ' (' . htmlentities($attr['kat_typ']) . ')</option>';
										}
										$content .= '
									</select>
								</td>
							</tr>
							<tr>
								<td>Einmalig:&nbsp;</td> 
								<td><input name="ka[ka_einmalig]" type="checkbox" class="edit_' . $komponentenart['ka_id'] . '" disabled="true" ' . ($komponentenart["ka_einmalig"]?"checked":"") . '/></td>
							</tr>
						</tbody></table>
						<div>
							<button type="submit" class="btn btn-primary" name="action" value="delete">L&ouml;schen</button>
							<button type="button" class="btn btn-primary" onclick="toggleEditing(' . $komponentenart['ka_id'] . ');">Bearbeiten</button>
							<button type="submit" class="btn btn-primary edit_' . $komponentenart['ka_id'] . '" disabled="true" name="action" value="save">Speichern</button>
						</div>
					</form>
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
            sqldelete("wird_beschrieben_durch", [["ka_id", (int)$_POST["ka"]["ka_id"]]]);			
			foreach($_POST["ka"]["attribute"] as $attr) { 
				Componenttypes::addattr((int)$_POST["ka"]["ka_id"], $attr);
			}
			$success = Componenttypes::change((int)$_POST["ka"]["ka_id"], $value);
		}
		else if($_POST["action"] == "insert")
		{
            if($_POST["ka"]["ka_komponentenart"] != '') {
                $value = array("ka_komponentenart" => $_POST["ka"]["ka_komponentenart"],
                            "ka_einmalig" => (isset($_POST["ka"]["ka_einmalig"]) ? 1 : 0));

                $added = Componenttypes::add($value);
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
					<form method="POST" style="display: table; width: 100%; padding: 15px;">
						<table class="editable_edit_table">
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
						<div>
							<button type="submit" class="btn btn-primary" name="action" value="insert">Speichern</button>
						</div>
					</form>
				</div></div>';

	$content .= table_render(array("ID" => "int", "Name" => "string"),
			array_map("komponentenarten_render_row", Componenttypes::list_all()),
			array("header" => "Komponentenart hinzuf&uuml;gen", "content" => $insert));
    $content .= '<script type="text/javascript">
					$(".chosen-select").chosen();
					function toggleEditing(id) {
						$(".edit_"+id).each(
							function(i,e){
								if(e.disabled==true){
									e.disabled=false; 
									$("#edit_attributes_"+id).trigger("chosen:updated");
								}
								else{
									e.disabled=true;
									$("#edit_attributes_"+id).trigger("chosen:updated");
								} 
							} );
					}
				</script>
				<style>
					.editable_edit_table {
						border: none;
					}

					.editable_edit_table > tbody > tr {
						border: none;
						border-top: 1px solid grey;
					}

					.editable_edit_table > tbody > tr:first-child {
						border-top: none;
					}

					.editable_edit_table > tbody > tr > td {
						border: none;
						border-left: 1px solid grey;
						padding: 5px;
					}

					.editable_edit_table > tbody > tr > td:first-child {
						border-left: none;
						border-right: 2px solid grey;	
						text-align: right;					
					}				

					
				</style>';

	page_render($content);
	return true;
}

page_add_menu("Komponentenarten", "/komponentenarten");

mast_register_path("#^komponentenarten$#", "komponentenarten_show");

return true;
?>
