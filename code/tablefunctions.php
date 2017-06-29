<?php
require_once("code/utils.php");

class Componentattributes {
    public static function list($cols = ["*"]) {
        return sqlselect("komponentenattribute", $cols);
    }
    public static function add($vals) {
        return sqlassoinsert("komponentenattribute", $vals);
    }
    public static function change($kat_id, $vals) {
        return sqlassoupdate("komponentenattribute", $vals, [["kat_id", $kat_id]]);
    }
    public static function delete($kat_id) {
        return sqldelete("komponentenattribute", [["kat_id", $kat_id]]);
    }
}
class Componenttypes {
    /*public static function list($cols = ["*"]) {
        return sqlselect("komponentenarten", $cols);
    }*/
    public static function add($vals) {
        return sqlassoinsert("komponentenarten", $vals);
    }
    public static function change($ka_id, $vals) {
        return sqlassoupdate("komponentenarten", $vals, [["ka_id", $ka_id]]);
    }
    public static function delete($ka_id) {
        return sqldelete("komponentenarten", [["ka_id", $ka_id]]);
    }
    public static function addattr($ka_id, $kat_id) {
        return sqlinsert("wird_beschrieben_durch", ["ka_id", "kat_id"], [$ka_id, $kat_id] );
    }
    public static function deleteattr($ka_id, $kat_id) {
        return sqldelete("wird_beschrieben_durch", [["ka_id", $ka_id], ["kat_id", $kat_id]]);
    }
}
class Components {
    /*public static function list($cols = ["*"]) {
        return sqlselect("komponenten", $cols);
    }*/
    public static function add($vals) {
        return sqlassoinsert("komponenten", $vals);
    }
    public static function change($k_id, $vals) {
        return sqlassoupdate("komponenten", $vals, [["k_id", $k_id]]);
    }
    public static function delete($k_id) {
        return sqldelete("komponenten", [["k_id", $k_id]]);
    }
    public static function changeattr($k_id, $kat_id, $khkat_wert) {
        return sqlupdate("komponente_hat_attribute", [["khkat_wert", $khkat_wert]], [["k_id", $k_id], ["kat_id", $kat_id]]);
    }
    public static function addcompinroom($k_id, $r_id) {
        return sqlinsert("komponente_in_raum", ["k_id", "r_id"], [$k_id, $r_id] );
    }
}
class Rooms {
    /*public static function list($cols = ["*"]) {
        return sqlselect("raeume", $cols);
    }*/
    public static function add($vals) {
        return sqlassoinsert("raeume", $vals);
    }
    public static function change($r_id, $vals) {
        return sqlassoupdate("raeume", $vals, [["r_id", $r_id]]);
    }
    public static function delete($r_id) {
        return sqldelete("raeume", [["r_id", $r_id]]);
    }
    public static function addcompinroom($k_id, $r_id) {
        return sqlinsert("komponente_in_raum", ["k_id", "r_id"], [$k_id, $r_id] );
    }
}
class Supplier {
    public static function list($cols = ["*"]) {
        return sqlselect("lieferant", $cols);
    }
    public static function add($vals) {
        return sqlassoinsert("lieferant", $vals);
    }
    public static function change($l_id, $vals) {
        return sqlassoupdate("lieferant", $vals, [["l_id", $l_id]]);
    }
    public static function delete($l_id) {
        return sqldelete("lieferant", [["l_id", $l_id]]);
    }
}



?>