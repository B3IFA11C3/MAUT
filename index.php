<?php
isset($_SESSION) || session_start();

isset($_GET["path"]) || $_GET["path"] = "/";

function load_module($module_name)
{
	if(!file_exists(__DIR__ . "/modules/" . $module_name . "/module.php"))
		return false;

	include_once(__DIR__ . "/modules/" . $module_name . "/module.php");

	return true;
}

$paths = array();

function maut_register_path($pattern, $callback)
{
	global $paths;
	
	$paths[] = array($pattern, $callback);
}

$modules = array_diff(scandir("modules/", SCANDIR_SORT_ASCENDING), array(".", ".."));

foreach($modules as $module_name)
{
        if(filetype("modules/" . $module_name) != "dir")
                continue;

        if(!load_module($module_name))
        {
                echo "Modul " . $module_name . " konnte nicht geladen werden!";
                continue;
        }
}

function not_found()
{
	readfile("404.html");
}

function render_path($path)
{
	global $paths;
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
