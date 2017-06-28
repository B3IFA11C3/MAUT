<?php
isset($_SESSION) || session_start();

isset($_GET["path"]) || $_GET["path"] = "/";

$paths = array();

function mast_register_path($pattern, $callback)
{
	global $paths;
	
	$paths[] = array($pattern, $callback);
}

$modules = array_diff(scandir("modules/", SCANDIR_SORT_ASCENDING), array(".", ".."));

foreach($modules as $module_name)
{
        if(filetype("modules/" . $module_name) != "dir")
                continue;

        if(!include_once(__DIR__ . "/modules/" . $module_name . "/module.php"))
        {
                echo "Modul " . $module_name . " konnte nicht geladen werden!";
                continue;
        }
}

function not_found()
{
	readfile("404.html");
	return true;
}

function render_path($path)
{
	global $paths;
	
	if($path == "/")
		$path = "";

	foreach($paths as $pathp)
	{
		if(preg_match($pathp[0], $path))
		{
			if($pathp[1]($path))
				return true;
		}
	}
	return false;
}

$paths[] = array("#.*#", "not_found");

if(!render_path($_GET["path"]))
	die("WTF");
?>
