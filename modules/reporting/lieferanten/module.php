<?php
require_once("templates/details.php");

function vendors() {
  $result = mast_query_array("SELECT l.l_id, l.l_firmennamen, l.l_strasse,
                                     l.l_plz, l.l_ort, l.l_tel,  l.l_mobil,
                                     l.l_fax, l.l_email, l.l_erstellt, 
                                     l.l_geaendert
                              FROM lieferanten l
                              WHERE l_geloescht != 1;");
  return $result;
}

function reporting_vendor_show() {
  $html = '<div class="w3-container w3-teal"><h1>Reporting — Lieferanten</h1></div>';
  page_render($html);
  return true;
}

mast_register_path("#^reporting/lieferanten$#", "reporting_vendor_show");
