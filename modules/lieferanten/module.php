<?php





require_once("code/table.php");
require_once("code/tablefunctions.php");
require_once("form_edit.php");
require_once("form_add.php");

function lieferanten_show()
{

	var_dump($_POST);

	if(isset($_POST['lief'])){
		var_dump($_POST['lief']);
		if(isset($_POST['l_id']))
			supplier::change($_POST['l_id'],$_POST['lief']);
		else
			supplier::add($_POST['lief']);
	}

	$content = '<div class="w3-container w3-teal"><h1>Lieferanten</h1></div>';

	$rows = supplier::list_all();
	
    $content_header_add = add_lieferant_show();#add_lieferant_show();
	
	
	
	foreach($rows as $row){
	
		
		$content_edit = edit_lieferant_show($row);
	
		$rows[] = array("cols" => array($row['l_firmenname'],$row['l_id']), "content" => "<div>".$content_edit."</div>");
	
	}
    
	$content .= table_render(array("Name" => "string", "ID" => "int"),
			$rows,
			array("header" => "<b>+</b>", "content" => "<div>".$content_header_add."</div>"));

	page_render($content);
	return true;
}

page_add_menu("Lieferanten", "/lieferanten");

mast_register_path("#^lieferanten$#", "lieferanten_show");
mast_register_path("#^\$#", "lieferanten_show");

return true;
?>