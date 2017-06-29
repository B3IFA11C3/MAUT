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
}
class Components {
}



?>