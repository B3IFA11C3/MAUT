<?php

require_once("code/table.php");
require_once("form_add.php");
require_once("form_edit.php");
require_once("code/tablefunctions.php");

function raeume_show()
{
	$content = '<div class="w3-container w3-teal"><h1>R&auml;ume</h1></div>';

	$rows = array();
    
    $rooms = Rooms::list_all();   
    $components = Components::list_all();   
    $components_art = Componenttypes::list_all();
    
    
    $content_header_add = add_raum_show();
    
   
    for($x=0; $x<count($rooms); $x++){
        $content_edit = edit_raum_show($rooms[$x], $components,$components_art);
        $rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_edit."</div>");   
    }
       
	$content .= table_render(array("Name" => "string", "ID" => "int"),
			$rows,
			array("header" => "<b>+</b>", "content" => "<div>".$content_header_add."</div>"));

	page_render($content);
	return true;
}

page_add_menu("Räume", "/raeume");

mast_register_path("#^raeume$#", "raeume_show");
mast_register_path("#^\$#", "raeume_show");

return true;
?>
