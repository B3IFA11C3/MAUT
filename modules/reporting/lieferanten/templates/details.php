<?php

function components_by_vendor($vendor_id) {
  $components = mast_query_array("SELECT k.k_name, ka.ka_komponentenart,
                                         k.k_einkaufsdatum
                                  FROM komponenten k
                                  JOIN komponentenarten ka ON k.ka_id = ka.ka_id
                                  WHERE k.l_id = ". $vendor_id .";");
  return array_map("array_values", $components);
}

function render_vendor_details($vendor) {
  $description = map_keys($vendor, array(
    "l_strasse"   => "Straße",
    "l_plz"       => "PLZ",
    "l_ort"       => "Ort",
    "l_tel"       => "Telefon",
    "l_mobil"     => "Mobil-Telefon",
    "l_fax"       => "Fax",
    "l_email"     => "E-Mail",
    "l_erstellt"  => "Hinzugefügt",
    "l_geaendert" => "Zuletzt geändert"));

  $html = '<div class="row">'
    . '<div class="col-md-6">'
    . generic_table(array("Eigenschaft", "Wert"), $description)
    . '</div>'
    . '<div class="col-md-6">'
    . generic_table(array("Name", "Art", "Einkaufsdatum"), components_by_vendor($vendor["l_id"]))
    . '</div>';

  return $html;
}
