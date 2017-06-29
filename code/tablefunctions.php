<?php
require_once("code/utils.php");

class Componentattributes {
    public static function list($cols = ["*"]) {
        return sqlselect("komponentenattribute", $cols);
    }
    public static function add($vals) {
        return sqlassoinsert("komponentenattribute", $vals);
    }
    public static function change($id, $vals) {
        return sqlassoupdate("komponentenattribute", $vals, [["kat_id", $id]]);
    }
    public static function delete($id) {
        return sqldelete("komponentenattribute", [["kat_id", $id]]);
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
    public static function addattribute($ka_id, $kat_id) {
        return sqlinsert("wird_beschrieben_durch", ["ka_id", "kat_id"], [$ka_id, $kat_id] );
    }
    public static function deleteattribute($ka_id, $kat_id) {
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
    public static function change($id, $vals) {
        return sqlassoupdate("komponenten", $vals, [["kat_id", $id]]);
    }
    public static function delete($id) {
        return sqldelete("komponenten", [["kat_id", $id]]);
    }
    /*public static function changeattr($id) {
        return sqldelete("komponentenattribute", [["kat_id", $id]]);
    }*/
    /*public static function compinroom($id) {
        return sqldelete("komponenten", [["kat_id", $id]]);
    }*/
}
class Rooms {
    /*public static function list($cols = ["*"]) {
        return sqlselect("raeume", $cols);
    }*/
    public static function add($vals) {
        return sqlassoinsert("raeume", $vals);
    }
    public static function change($id, $vals) {
        return sqlassoupdate("raeume", $vals, [["kat_id", $id]]);
    }
    public static function delete($id) {
        return sqldelete("raeume", [["kat_id", $id]]);
    }
    /*public static function compinroom($id) {
        return sqldelete("komponenten", [["kat_id", $id]]);
    }*/
}



?>