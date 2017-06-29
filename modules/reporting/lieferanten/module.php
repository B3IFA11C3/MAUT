<?php
require_once("templates/details.php");

function vendors() {
  $result = mast_query_array("SELECT l.l_id, l.l_firmenname, l.l_strasse,
                                     l.l_plz, l.l_ort, l.l_tel,  l.l_mobil,
                                     l.l_fax, l.l_email, l.l_erstellt, 
                                     l.l_geaendert
                              FROM lieferanten l
                              WHERE l_geloescht != 1;");
  return $result;
}

function reporting_vendor_show() {
  $rows = array();
  $columns = array("ID" => "int", "Firmenname" => "string");
  $html = '<div class="w3-container w3-teal"><h1>Reporting — Lieferanten</h1></div>';

  foreach (vendors() as $vendor) {
    $rows[] = array(
      "cols" => array(
        $vendor['l_id'],
        $vendor['l_firmenname']),
      "content" => render_vendor_details($vendor));
  }

  $html .= table_render($columns, $rows);
  page_render($html);
  return true;
}

mast_register_path("#^reporting/lieferanten$#", "reporting_vendor_show");
