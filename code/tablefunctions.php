<?php
require_once("code/utils.php");

class Componentattributes {
    public static function list_all($cols = ["*"]) {
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
    public static function list_all($cols = ["*"]) {
         $result = sqlselect("komponentenarten", $cols, [["ka_geloescht", 0]]);
		 $result = addtoarray($result,'ka_spalten','select ka.* from wird_beschrieben_durch b, komponentenattribute ka where b.ka_id = ? and b.kat_id = ka.kat_id','ka_id');
		 return $result;
	}
    public static function add($vals) {
        return sqlassoinsert("komponentenarten", $vals);
    }
    public static function change($ka_id, $vals) {
        return sqlassoupdate("komponentenarten", $vals, [["ka_id", $ka_id]]);
    }
    public static function delete($ka_id) {
        return sqlupdate("komponentenarten", [["ka_geloescht", 1]], [["ka_id", $ka_id]]);
        //return sqldelete("komponentenarten", [["ka_id", $ka_id]]);
    }
    public static function addattr($ka_id, $kat_id) {
        return sqlinsert("wird_beschrieben_durch", ["ka_id", "kat_id"], [$ka_id, $kat_id] );
    }
    public static function deleteattr($ka_id, $kat_id) {
        return sqldelete("wird_beschrieben_durch", [["ka_id", $ka_id], ["kat_id", $kat_id]]);
    }
}
class Components {
    public static function list_all($cols = ["*"]) {
		$result = sqldoit(true,'select k.*, a.* from komponentenarten as a , komponenten as k where k.ka_id = a.ka_id');
		
		$result = addtoarray($result,'lieferant','select * from lieferanten where l_id = ?','l_id');
		$result = addtoarray($result,'komponentenattribute','select ka.* , h.* , ka.kat_id from wird_beschrieben_durch as b, komponentenattribute as ka left join komponente_hat_attribute h on h.kat_id = ka.kat_id and h.k_id = ? where b.ka_id = ? and b.kat_id = ka.kat_id ',array('k_id','ka_id'));
		$result = addtoarray($result,'raeume','select * from raeume as r , komponente_in_raum as i where r.r_id = i.r_id and i.k_id = ?','k_id');
        return $result;
    }
    public static function add($vals) {
        return sqlassoinsert("komponenten", $vals);
    }
    public static function change($k_id, $vals) {
        return sqlassoupdate("komponenten", $vals, [["k_id", $k_id]]);
    }
    public static function delete($k_id) {
        return sqlupdate("komponentenarten", [["k_geloescht", 1]], [["k_id", $k_id]]);
        //return sqldelete("komponenten", [["k_id", $k_id]]);
    }
	private static function sqlsetattr($k_id, $kat_id, $khkat_wert) {
        if (count(sqlselect("komponente_hat_attribute", ["k_id", "kat_id"], [["k_id", $k_id], ["kat_id", $kat_id]])))
            return sqlupdate("komponente_hat_attribute", [["khkat_wert", $khkat_wert]], [["k_id", $k_id], ["kat_id", $kat_id]]);
        return sqlinsert("komponente_hat_attribute", ["k_id", "kat_id", "khkat_wert"], [$k_id, $kat_id, $khkat_wert]);
    }
    public static function setattr($k_id, $kat_id, $khkat_wert) {
        if (!sqlselect("komponentenattribute", ["kat_einzigartig"], [["kat_id", $kat_id]])[0]["kat_einzigartig"])
            return self::sqlsetattr($k_id, $kat_id, $khkat_wert);
        $res = sqlselect("komponente_hat_attribute", ["k_id"], [["kat_id", $kat_id], ["khkat_wert", $khkat_wert], ["khkat_geloescht", 0]]);
        if (!count($res))
            return self::sqlsetattr($k_id, $kat_id, $khkat_wert);
        $k_ids = array();
        foreach ($res as $re)
            $k_ids[] = $re["k_id"];
        $ownkat = sqlselect("komponenten", ["ka_id"], [["k_id", $k_id]])[0]["ka_id"];
        if (count(sqldoit(true, "SELECT DISTINCT `ka_id` FROM `komponenten` WHERE (`k_id` = ".join(" OR `k_id` = ", $k_ids).") AND `ka_id` = ".$ownkat)));
            return false;
        return self::sqlsetattr($k_id, $kat_id, $khkat_wert);
        //return sqlupdate("komponente_hat_attribute", [["khkat_wert", $khkat_wert]], [["k_id", $k_id], ["kat_id", $kat_id]]);
    }
    public static function addcompinroom($k_id, $r_id) {
        $res = sqlselect("komponenten", ["ka_id"], [["k_id", $k_id]]);
        if (!count($res))
            return false;
        $ka_id = $res[0]["ka_id"];
        if (!sqlselect("komponentenarten", ["ka_einmalig"], [["ka_id", $ka_id]])[0]["ka_einmalig"])
            return sqlinsert("komponente_in_raum", ["k_id", "r_id"], [$k_id, $r_id]);
        if (count(sqlselect("komponente_in_raum", ["*"], [["k_id", $k_id]])))
            return false;
        return sqlinsert("komponente_in_raum", ["k_id", "r_id"], [$k_id, $r_id]);
    }
}
class Rooms {
    public static function list_all($cols = ["*"]) {
		$results = sqlselect("raeume", $cols);
		
		$result = addtoarray($results,'komponenten','select k.*, a.* from komponentenarten as a , komponenten as k , komponente_in_raum as i where i.r_id = ? and i.k_id = k.k_id and k.ka_id = a.ka_id','r_id');

		foreach ($result as &$rows){
		$row = &$rows['komponenten'];

			$row = addtoarray($row,'lieferant','select * from lieferanten where l_id = ?','l_id');

			$row = addtoarray($row,'komponentenattribute','select * from wird_beschrieben_durch as b, komponentenattribute as ka left join komponente_hat_attribute h on h.kat_id = ka.kat_id and h.k_id = ? where b.ka_id = ? and b.kat_id = ka.kat_id ',array('k_id','ka_id'));


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
        return sqlupdate("raeume", [["r_geloescht", 1]], [["r_id", $r_id]]);
        //return sqldelete("raeume", [["r_id", $r_id]]);
    }
    public static function addcompinroom($k_id, $r_id) {
        $res = sqlselect("komponenten", ["ka_id"], [["k_id", $k_id]]);
        if (!count($res))
            return false;
        $ka_id = $res[0]["ka_id"];
        if (!sqlselect("komponentenarten", ["ka_einmalig"], [["ka_id", $ka_id]])[0]["ka_einmalig"])
            return sqlinsert("komponente_in_raum", ["k_id", "r_id"], [$k_id, $r_id]);
        if (count(sqlselect("komponente_in_raum", ["*"], [["k_id", $k_id]])))
            return false;
        return sqlinsert("komponente_in_raum", ["k_id", "r_id"], [$k_id, $r_id]);
    }
}
class Supplier {
    public static function list_all($cols = ["*"]) {
		$results = sqlselect("lieferanten", $cols, array(array('l_geloescht', 0)));
		
		$result = addtoarray($results,'komponenten','select k.*, a.* from komponentenarten as a , komponenten as k  where k.l_id = ? and k.ka_id = a.ka_id','l_id');

		foreach ($result as &$rows){
		$row = &$rows['komponenten'];

			$row = addtoarray($row,'raeume','select * from raeume as r , komponente_in_raum as i where r.r_id = i.r_id and i.k_id = ?','k_id');

			$row = addtoarray($row,'komponentenattribute','select * from wird_beschrieben_durch as b, komponentenattribute as ka left join komponente_hat_attribute h on h.kat_id = ka.kat_id and h.k_id = ? where b.ka_id = ? and b.kat_id = ka.kat_id ',array('k_id','ka_id'));


		}
        return $result;
    }
    public static function add($vals) {
        return sqlassoinsert("lieferanten", $vals);
    }
    public static function change($l_id, $vals) {
        return sqlassoupdate("lieferanten", $vals, [["l_id", $l_id]]);
    }
    public static function delete($l_id) {
        return sqlupdate("lieferanten", [["l_geloescht", 1]], [["l_id", $l_id]]);
        //return sqldelete("lieferanten", [["l_id", $l_id]]);
    }
}
?>
