<?php

function room_components($room_id) {
  $result = array();
  $components = mast_query_array("SELECT k.k_id, k.k_hersteller, k.k_notiz,
                                         ka.ka_komponentenart
                                  FROM komponente_in_raum kir
                                  JOIN komponenten k ON kir.k_id = k.k_id
                                  JOIN komponentenarten ka ON k.ka_id = ka.ka_id
                                  WHERE k.k_geloescht != 1
                                  AND kir.r_id = ". $room_id .";");

  if (count($components) == 0)
    return false;

  foreach ($components as $cmpnt) {
    $result[] = array(
      $cmpnt["k_id"],
      $cmpnt["ka_komponentenart"],
      $cmpnt["k_hersteller"],
      $cmpnt["k_notiz"]);
  }
  return $result;
}

function render_room_details($room) {
  $html = '<div class="container">';

  if ($room['r_notiz']) {
    $html .= '<div class="row">'
      . '<h3>Notiz</h3>'
      . '<p>' . $room['r_notiz'] . '</p>'
      . '</div>';
  }

  $components = room_components($room["r_id"]);
  if ($components) {
    $html .= '<div class="row">'
      . generic_table(array("ID", "Art", "Hersteller", "Notiz"), $components)
      . '</div></div>';
  }
  return $html;
}
