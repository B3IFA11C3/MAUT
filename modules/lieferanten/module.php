<?php

require_once("code/table.php");
require_once("edit.php");

function lieferanten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Lieferanten</h1></div>';

	$rows = array();
    
    $content_header_add = edit_show();
	
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_header_add."</div>");
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_header_add."</div>");
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_header_add."</div>");
	$rows[] = array("cols" => array("BigMacBook", 0), "content" => "<div>".$content_header_add."</div>");
	
    
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
