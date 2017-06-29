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
    public static function list($cols = ["*"]) {
         $result = sqlselect("komponentenarten", $cols);
		 $result = addtoarray($result,'ka_spalten','select ka.* from wird_beschrieben_durch b, komponentenattribute ka where b.ka_id = ? and b.kat_id = ka.kat_id ','ka_id');
		 return $result;
	}
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
    public static function list($cols = ["*"]) {
        $result = sqlselect("komponenten", $cols);
		
		$result = addtoarray($result,'liefeant','select * from lieferanten where l_id = ?','l_id');
		$result = addtoarray($result,'komponentenattribute','select ka.* , h.* from wird_beschrieben_durch b, komponentenattribute ka (left join komponenten_hat_attribute h on h.kat_id = ka.kat_id and h.k_id = ?)where b.ka_id = ? and b.kat_id = ka.kat_id ',array('k_id','ka_id'));
		$result = addtoarray($result,'raeume','select * from raeume r , komponente_in_raum i where r.r_id = i.r_id and i.k_id = ?','k_id');
        return $result;
    }
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