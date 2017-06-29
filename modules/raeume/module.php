<?php

require_once("code/table.php");
require_once("form_add.php");
require_once("form_edit.php");

function raeume_show()
{
	$content = '<div class="w3-container w3-teal"><h1>R&auml;ume</h1></div>';

	$rows = array();
    
    $content_header_add = add_raum_show();
    
     $komponenten = array(
        0 => array(
            "name" => "Test1",
            "art" => "Storage"
        ),
        1 => array(
            "name" => "Test2",
            "art" => "Server"
        ),
        2 => array(
            "name" => "Test3",
            "art" => "Switch"
        ),
        3 => array(
            "name" => "Test4",
            "art" => "Client-PC"
        )
    );
    
    
    for($x=1; $x<5; $x++) {
        $content_edit = edit_raum_show($x, $komponenten);
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
