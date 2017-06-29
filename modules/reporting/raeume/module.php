<?php
require_once("templates/details.php");

function rooms() {
  $result = mast_query_array("SELECT r_id, r_nr, r_bezeichnung, r_notiz
                              FROM raeume
                              WHERE r_geloescht != 1;");
  return $result;
}

function reporting_rooms_show() {
  $html = '<div class="w3-container w3-teal"><h1>Reporting — Räume</h1></div>';
  $columns = array("ID" => "int", "Raumnummer" => "int", "Bezeichnung" => "string");
  $rows = array();

  foreach (rooms() as $room) {
    $rows[] = array(
      "cols"    => array(
        $room['r_id'],
        $room["r_nr"],
        $room['r_bezeichnung']),
      "content" => render_room_details($room));
  }
  $html .= table_render($columns, $rows);

  page_render($html);
  return true;
}

mast_register_path("#^reporting/raeume$#", "reporting_rooms_show");
