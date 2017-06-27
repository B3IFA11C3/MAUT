<?php
function page_render($maincontent, $full=true)
{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>MAUT</title>
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/maut.css" />
		<link rel="stylesheet" type="text/css" href="css/w3.css" />
	
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/maut.js"></script>
	</head>
<body>
<?php
if($full) {
?>
<!-- Sidebar --> 
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%;">
  <h3 class="w3-bar-item" style="font-size: 40px">
	<img src="img/logo.png" style="vertical-align: middle; height: 50px"/>
        <span style="margin-left:10px; vertical-align: middle;">Men&uuml;</span>
  </h3>
  <a href="#" class="w3-bar-item w3-button w3-active-item">Komponenten</a>
  <button class="w3-button w3-block w3-left-align" onclick="myAccFunc()">
  R&auml;ume <i class="fa fa-caret-down"></i>
  </button>
  <div id="demoAcc" class="w3-hide w3-white w3-card-2">
    <a href="#" class="w3-bar-item w3-button">Link</a>
    <a href="#" class="w3-bar-item w3-button">Link</a>
  </div>
  <a href="#" class="w3-bar-item w3-button">Lieferanten</a>
  <button class="w3-button w3-block w3-left-align" onclick="myAccFunc()">
  Reporting <i class="fa fa-caret-down"></i>
  </button>
  <div id="demoAcc" class="w3-hide w3-white w3-card-2">
    <a href="#" class="w3-bar-item w3-button">R&auml;ume</a>
    <a href="#" class="w3-bar-item w3-button">Komponenten</a>
	<a href="#" class="w3-bar-item w3-button">Bestellungen</a>
  </div>
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
