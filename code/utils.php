<?php
require_once("code/config.inc.php");

class MySQLiCurry {
    public function __construct($str, $db) {
        $this->str = $str;
        $this->db = $db;
        $this->typestr = "";
        $this->vars = array();
        $this->stmt = NULL;
        $this->res = NULL;
    }
    
    public function __destruct() {
        if ($this->stmt != NULL)
            mysqli_stmt_close($this->stmt);
    }
    
    public function int($var) {
        return $this->set("i", $var);
    }
    
    public function str($var) {
        return $this->set("s", $var);
    }
    
    public function set($type, &$var) {
        $this->typestr .= $type;
        $this->vars[] = &$var;
        
        return $this;
    }
    
    public function execute() {
        $this->stmt = MastDB::mysqliPrepare($this->str, $this->db);
        if ($this->stmt === FALSE)
            return false;

        if (count($this->vars) != 0) {
            array_unshift($this->vars, $this->stmt, $this->typestr);
            
            $method = new ReflectionFunction("mysqli_stmt_bind_param");
            $method->invokeArgs($this->vars);
        }
        
        if (mysqli_stmt_execute($this->stmt) === FALSE) {
            $this->stmt = NULL;
            return false;
        } else
            return $this;
    }
    
    //Darf erst nach fetch() aufgerufen werden!
    public function numRows() {
        return $this->stmt->num_rows;
    }
    
    public function insertId() {
		return $this->stmt->insert_id;
    }
    
    public function fetch() {
        if ($this->stmt === NULL)
            return false;

        mysqli_stmt_store_result($this->stmt);
        $meta = mysqli_stmt_result_metadata($this->stmt);
        $vars = array($this->stmt);
        $results = array();
        
        while ($column = mysqli_fetch_field($meta))
            $vars[] = &$results[$column->name];
        
        $method = new ReflectionFunction("mysqli_stmt_bind_result");
        $method->invokeArgs($vars);
        
        if (mysqli_stmt_fetch($this->stmt) !== TRUE)
            return false;
        
        return $results;
    }
}


class MastDB {
    private static $mysqli_connected = false;
    private static $mysqli_link = NULL;
    
    public static function mysqliConnect() {
        if (self::$mysqli_connected)
            return true;
        
        global $CONFIG;
        
        self::$mysqli_link = mysqli_connect($CONFIG["SQLConn"], $CONFIG["SQLUser"], $CONFIG["SQLPass"]);
        if (mysqli_connect_errno() != 0)
            return false;

		mysqli_select_db(self::$mysqli_link, $CONFIG["SQLMastDB"]);
        
        self::$mysqli_connected = true;
        
        register_shutdown_function(function() {
            MastDB::mysqliDisconnect();
        });
        
        return true;
    }
    
    public static function mysqliDisconnect() {
        if (!self::$mysqli_connected)
            return;
        
        mysqli_close(self::$mysqli_link);
        
        self::$mysqli_connected = false;
    }
    
    public static function mysqliQuery($str, $db) {
        if (!self::$mysqli_connected && !self::mysqliConnect())
            return false;
        
        return mysqli_query(self::$mysqli_link, $str);
    }
    
    public static function mysqliPrepare($str, $db) {
        if (!self::$mysqli_connected && !self::mysqliConnect())
            return false;

		mysqli_select_db(self::$mysqli_link, $db);
        return mysqli_prepare(self::$mysqli_link, $str);
    }
    
    public static function mysqliCurry($str, $db) {
        return new MySQLiCurry($str, $db);
    }
    
    public static function mysqliError() {
        return mysqli_error(self::$mysqli_link);
    }
    
    public static function mysqliLink() {
        return self::$mysqli_link;
    }
}

function sqldoit($wresult, $sqlquary, $sqlparam = array(), $sqldb = "SQLMastDB") {
    global $CONFIG;
    $curr = MastDB::mysqliCurry($sqlquary, $CONFIG[$sqldb]);
    foreach ($sqlparam as $param)
        $curr = is_int($param) ? $curr->int($param) : $curr->str($param);
    if (!$wresult)
        return $curr->execute();
    $curr = $curr->execute();
    if (!$curr)
        return false;
    $resu = array();
	while ($row = $curr->fetch()){
        $resu[] = $row;
	}
    return $resu;
}


function sqlselect($sqltable, $sqlfields, $sqlfilter = null) {
    global $CONFIG;
    if (count($sqlfields) < 1)
        return false;
    $sqlselc = join(", ", $sqlfields);
    $where = isset($sqlfilter);
    if ($where)
        $sqlwhere = join(" AND ", array_map(function($vergleich){
            return "`".$vergleich[0]."` = ?";
        }, $sqlfilter));
    $curr = MastDB::mysqliCurry("SELECT ".$sqlselc." FROM `".$sqltable.($where ? ("` WHERE ".$sqlwhere) : "`"), $CONFIG["SQLMastDB"]);
    if ($where)
        foreach ($sqlfilter as $filter)
            $curr = is_int($filter[1]) ? $curr->int($filter[1]) : $curr->str($filter[1]);
    $curr = $curr->execute();
    if (!$curr)
        return false;
    $resu = array();
	while ($row = $curr->fetch()){
        $resu[] = $row;
	}
    return $resu;
}

function checklogin($user, $passw) {
    global $CONFIG;
	$resp = MastDB::mysqliCurry("SELECT `U_Passwort` FROM `user` WHERE `U_Benutzername` = ?", $CONFIG["SQLUserDB"])->str($user)->execute();
	if(!$resp)
		return false;
	$resprow = $resp->fetch();
    return $resprow && $resprow["U_Passwort"] === crypt($passw, $resprow["U_Passwort"]);
}

function changepw($user, $oldpw, $newpw, $newpwwdh) {
    global $CONFIG;
    if (!isset($oldpw) || !isset($newpw) || !isset($newpwwdh))
        return false;
    if ($newpw !== $newpwwdh)
        return false;
	$resp = MastDB::mysqliCurry("SELECT `U_Passwort` FROM `user` WHERE `U_Benutzername` = ?", $CONFIG["SQLUserDB"])->str($user)->execute();
	if(!$resp)
		return false;
	$resprow = $resp->fetch();
    if (!$resprow || $resprow["U_Passwort"] !== crypt($oldpw, $resprow["U_Passwort"]))
        return false;
	return !!MastDB::mysqliCurry("UPDATE `user` SET `U_Passwort` = '".crypt($newpw, "$2y$10$".uniqid(mt_rand(), true))."' WHERE `U_Benutzername` = ?", $CONFIG["SQLUserDB"])->str($user)->execute();
}

function sqlassoinsert($sqltable, $asso) {
    $keys = array_keys($asso);
    $sqlfields = array();
    $sqlvalues = array();
    foreach ($keys AS $key) {
        $sqlfields[] = $key;
        $sqlvalues[] = $asso[$key];
    }
    return sqlinsert($sqltable, $sqlfields, $sqlvalues);
}

function sqlinsert($sqltable, $sqlfields, $sqlvalues) {
    global $CONFIG;
    $anz = count($sqlfields);
    if ($anz < 1 || $anz != count($sqlvalues))
        return false;
    $curr = MastDB::mysqliCurry("INSERT INTO `".$sqltable."`(`".join("`, `", $sqlfields)."`) VALUES (?".str_repeat(", ?", $anz-1).")", $CONFIG["SQLMastDB"]);
    for ($i = 0; $i < $anz; $i++)
        $curr = is_int($sqlvalues[$i]) ? $curr->int($sqlvalues[$i]) : $curr->str($sqlvalues[$i]);
    /*foreach ($sqlvalues as $value)
        $curr = is_int($value) ? $curr->int($value) : $curr->str($value);*/
    $curr = $curr->execute();
    if (!$curr)
        return false;

    return $curr->insertId();
}

function sqlassoupdate($sqltable, $asso, $sqlfilter) {
    $keys = array_keys($asso);
    $sqlvals = array();
    foreach ($keys AS $key) {
        $sqlvals[] = array($key, $asso[$key]);
    }
    return sqlupdate($sqltable, $sqlvals, $sqlfilter);
}

function sqlupdate($sqltable, $sqlvals, $sqlfilter) {
    global $CONFIG;
    if (count($sqlvals) < 1 || count($sqlfilter) < 1)
        return false;
    $sqlset = join(", ", array_map(function($set){
        return "`".$set[0]."` = ?";
    }, $sqlvals));
    $sqlwhere = join(" AND ", array_map(function($vergleich){
        return "`".$vergleich[0]."` = ?";
    }, $sqlfilter));
    $curr = MastDB::mysqliCurry("UPDATE `".$sqltable."` SET ".$sqlset." WHERE ".$sqlwhere, $CONFIG["SQLMastDB"]);
    foreach ($sqlvals as $val)
        $curr = is_int($val[1]) ? $curr->int($val[1]) : $curr->str($val[1]);
    foreach ($sqlfilter as $filter)
        $curr = is_int($filter[1]) ? $curr->int($filter[1]) : $curr->str($filter[1]);
    return $curr->execute();
}

function sqldelete($sqltable, $sqlfilter) {
    global $CONFIG;
    $sqlwhere = join(" AND ", array_map(function($vergleich){
        return "`".$vergleich[0]."` = ?";
    }, $sqlfilter));
    $curr = MastDB::mysqliCurry("DELETE FROM `".$sqltable."` WHERE ".$sqlwhere, $CONFIG["SQLMastDB"]);
    foreach ($sqlfilter as $filter)
        $curr = is_int($filter[1]) ? $curr->int($filter[1]) : $curr->str($filter[1]);
    return $curr->execute();
}

function mast_query_array($stmt) {
  $result = array();
  $stmt = MastDB::mysqliCurry($stmt, $CONFIG["SQLMastDB"]);
  $resource = $stmt->execute();

  if (! $resource)
    return false;

  while ($r = $resource->fetch())
    $result[] = $r;
  return $result;
}

function map_keys($resource, $mapping) {
  $mapped = array();

  foreach ($mapping as $key => $name) {
    if (! array_key_exists($key, $resource))
      continue;
    $mapped[] = array($name, $resource[$key]);
  }
  return $mapped;
}

function generic_table($columns, $rows) {
  $html = '<table class="table table-striped">'
    . '<thead><tr>';
  foreach ($columns as $column)
    $html .= '<th>' . $column . '</th>';
  $html .= '</tr></thead><tbody>';

  foreach($rows as $row) {
    $html .='<tr>';
    foreach($row as $value)
      $html .= '<td>' .  $value . '</td>';
    $html .= '</tr>';
  }
  return $html . '</tbody></table>';
}

// $array ist das Array bei dem Subarrays hinzugefügt werden
//unter dem Wert $name
// $curry ist die Querry mit
// $column die Spalte(n) die im $array für die Querry benutzt werden
function addtoarray($array, $name, $curry, $column){
	global $CONFIG;

	foreach ($array as &$row){
		$subarray = array();
		$resp = MastDB::mysqliCurry($curry, $CONFIG["SQLMastDB"]);
		if(is_array($column))
			foreach ($column as $param)
				$resp = is_int($row[$param]) ? $resp->int($row[$param]) : $resp->str($row[$param]);
		else
			$resp = is_int($row[$column]) ? $resp->int($row[$column]) : $resp->str($row[$column]);
		$resp = $resp->execute();
		$row[$name] = array();
		while($subarray = $resp->fetch()){
					$row[$name][] = $subarray;
			}
	}
	return $array;
}
?>
