<?php

require_once("code/table.php");
require_once("form_add.php");
require_once("form_edit.php");

function raeume_show()
{
	$content = '<div class="w3-container w3-teal"><h1>R&auml;ume</h1></div>';

	$rows = array();
    
    $content_header_add = add_raum_show();
	$content_edit = edit_raum_show();
    
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_edit."</div>");
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_edit."</div>");
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_edit."</div>");
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_edit."</div>");
	
    
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
