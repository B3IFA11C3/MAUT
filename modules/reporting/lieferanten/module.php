<?php
require_once("templates/details.php");

function vendor() {
  $result = mast_query_array("SELECT r_id, r_nr, r_bezeichnung, r_notiz
                              FROM raeume
                              WHERE r_geloescht != 1;");
  return $result;
}

function reporting_vendor_show() {
  $html = '<div class="w3-container w3-teal"><h1>Reporting — Lieferanten</h1></div>';
  page_render($html);
  return true;
}

mast_register_path("#^reporting/lieferanten$#", "reporting_vendor_show");
