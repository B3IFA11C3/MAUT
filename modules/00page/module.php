<?php

$menus = array();

function page_add_menu($text, $menu)
{
	global $menus;
	$menus[$text] = $menu;
}

function page_render($maincontent, $full=true)
{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>MAST</title>

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/mast.css" />
		<link rel="stylesheet" type="text/css" href="css/w3.css" />

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/mast.js"></script>
	</head>
<body>
<?php
if($full) {
	global $menus;
	
	$menus["Abmelden"] = "/logout";
?>

<!-- Sidebar --> 
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%;">
  <h3 class="w3-bar-item" style="font-size: 40px"><nobr>
	<img src="img/logo.png" style="vertical-align: middle; height: 50px"/>
	<span style="margin-left:10px; vertical-align: middle;">Men&uuml;</span>
	</nobr>
  </h3>
<?php
	foreach($menus as $text => $submenu)
	{
		if(is_array($submenu))
		{
			echo '<button class="w3-button w3-block w3-left-align" onclick="myAccFunc(this)">';
			echo htmlentities($text);
			echo '<i class="fa fa-caret-down"></i></button>';
			
			echo '<div class="w3-hide w3-white w3-card-2">';

			foreach($submenu as $subtext => $link)
				echo '<a href="' . htmlentities($link) . '" class="w3-bar-item w3-button">' . htmlentities($subtext) . '</a>';
			
			echo '</div>';
		}
		else
		{
			echo '<a href="' . htmlentities($submenu) . '" class="w3-bar-item w3-button">' . htmlentities($text) . '</a>';
		}
	}
?>
</div>

<!-- Page Content -->
<div style="margin-left:15%">
<?php
}
	echo $maincontent;
	if($full) echo "</div>";
?>
</body>
</html>
<?php
}

return true;
?>
