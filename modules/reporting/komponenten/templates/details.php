<?php

function component_attrs($component_id) {
  $result = array();
  $attrs = mast_query_array("SELECT kha.khkat_wert, ko.kat_bezeichnung, ko.kat_einheit
                               FROM komponente_hat_attribute kha
                               JOIN komponentenattribute ko ON kha.kat_id = ko.kat_id
                               WHERE kha.khkat_geloescht != 1
                               AND kha.k_id = ". $component_id .";");

  foreach ($attrs as $attr) {
    $result[] = array(
      $attr["kat_bezeichnung"],
      $attr["khkat_wert"] . " " . $attr["kat_einheit"]);
  }
  return $result;
}

function render_component_details($component) {
  $description = map_keys($component, array(
    "k_einkaufsdatum"       => "Einkaufsdatum",
    "k_gewaehrleistung_bis" => "Gefwaehrleistung",
    "k_hersteller"          => "Hersteller",
    "l_firmenname"          => "Lieferant",
    "k_notiz"               => "Notiz",
    "ka_komponentenart"     => "Komponentenart",
    "k_erstellt"            => "Erstellt",
    "k_geaendert"           => "Geaendert"));

  $html = '<div class="row">'
    . '<div class="col-md-6">'
    . generic_table(array("Eigenschaft", "Wert"), $description)
    . '</div>'
    . '<div class="col-md-6">'
    . generic_table(array("Eigenschaft", "Wert"), component_attrs($component["k_id"]))
    . '</div>';

  return $html;
}
