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
    public static function change($id, $vals) {
        return sqlassoupdate("komponentenarten", $vals, [["kat_id", $id]]);
    }
    public static function delete($id) {
        return sqldelete("komponentenarten", [["kat_id", $id]]);
    }
    /*public static function addattr($id) {
        return sqldelete("komponentenattribute", [["kat_id", $id]]);
    }*/
    /*public static function deleteattr($id) {
        return sqldelete("komponentenattribute", [["kat_id", $id]]);
    }*/
}
class Components {
    public static function list($cols = ["*"]) {
        $result = sqlselect("komponenten", $cols);
		
		
		$result = addtoarray($result,'liefeant','select * from lieferanten where l_id = ?','l_id');
		$result = addtoarray($result,'komponentenattribute','select * from wird_beschrieben_durch b, komponentenattribute ka (left join komponenten_hat_attribute h on h.kat_id = ka.kat_id and h.k_id = ?)where b.ka_id = ? and b.kat_id = ka.kat_id ',array('k_id','ka_id'));
		$result = addtoarray($result,'raeume','select * from raeume r , komponente_in_raum i where r.r_id = i.r_id and i.k_id = ?','k_id');
        return $result;
    }
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
    public static function list($cols = ["*"]) {
		$result = sqlselect("raeume", $cols);
		
		$result = addtoarray($result,'komponenten','select k.*, a.* from komponentenarten a , komponenten k , komponente_in_raum i where i.r_id = ? and i.k_id = k.k_id and k.ka_id = a.ka_id','r_id');
		foreach ($result as &$row){
			$row = addtoarray($row,'liefeant','select * from lieferanten where l_id = ?','l_id');
			$row = addtoarray($row,'komponentenattribute','select * from wird_beschrieben_durch b, komponentenattribute ka (left join komponenten_hat_attribute h on h.kat_id = ka.kat_id and h.k_id = ?)where b.ka_id = ? and b.kat_id = ka.kat_id ',array('k_id','ka_id'));
		}
        return $result;
    }
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