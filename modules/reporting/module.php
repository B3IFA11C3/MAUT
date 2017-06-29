<?php

require_once("komponenten/module.php");
require_once("lieferanten/module.php");
require_once("raeume/module.php");

page_add_menu("Reporting", array(
  "Komponenten" => "/reporting/komponenten",
  "Lieferanten" => "/reporting/lieferanten",
  "Räume" => "/reporting/raeume"
));
