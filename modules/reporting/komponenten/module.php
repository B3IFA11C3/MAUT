<?php
require_once("templates/details.php");

function components() {
  $result = mast_query_array("SELECT k.k_id, k.k_name, l.l_firmenname, k.k_einkaufsdatum,
                                      k.k_gewaehrleistung_bis, k.k_notiz, k.k_hersteller,
                                      ka.ka_komponentenart, k.k_erstellt, k.k_geaendert
                              FROM komponenten k
                              JOIN lieferanten l ON l.l_id = k.l_id
                              JOIN komponentenarten ka ON ka.ka_id = k.ka_id
                              WHERE k.k_geloescht != 1;");
  return $result;
}

function reporting_komponenten_show() {
  $html = '<div class="w3-container w3-teal"><h1>Reporting — Komponenten</h1></div>';
  $columns = array("ID" => "int", "Art" => "string", "Name" => "string");
  $rows = array();

  foreach (components() as $cmpnt) {
    $rows[] = array(
      "cols"    => array(
        $cmpnt['k_id'],
        $cmpnt["ka_komponentenart"],
        $cmpnt['k_name']),
      "content" => render_component_details($cmpnt));
  }
  $html .= table_render($columns, $rows);

  page_render($html);
  return true;
}

mast_register_path("#^reporting/komponenten$#", "reporting_komponenten_show");
