<?php
require("code/config.inc.php");

class MySQLiCurry {
    public function __construct($str) {
        $this->str = $str;
        $this->typestr = "";
        $this->vars = array();
        $this->stmt = NULL;
        $this->res = NULL;
    }
    
    public function __destruct() {
        if ($this->stmt != NULL)
            mysqli_stmt_close($this->stmt);
    }
    
    public function int(&$var) {
        return $this->set("i", $var);
    }
    
    public function str(&$var) {
        return $this->set("s", $var);
    }
    
    public function set($type, &$var) {
        $this->typestr .= $type;
        $this->vars[] = &$var;
        
        return $this;
    }
    
    public function execute() {
        $this->stmt = MastDB::mysqliPrepare($this->str);
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
    
    public static function mysqliQuery($str) {
        if (!self::$mysqli_connected && !self::mysqliConnect())
            return false;
        
        return mysqli_query(self::$mysqli_link, $str);
    }
    
    public static function mysqliPrepare($str) {
        if (!self::$mysqli_connected && !self::mysqliConnect())
            return false;
        
        return mysqli_prepare(self::$mysqli_link, $str);
    }
    
    public static function mysqliCurry($str) {
        return new MySQLiCurry($str);
    }
    
    public static function mysqliError() {
        return mysqli_error(self::$mysqli_link);
    }
    
    public static function mysqliLink() {
        return self::$mysqli_link;
    }
}

function checklogin($user, $passw) {
    global $CONFIG;
    if (!isset($user) || !isset($passw))
        return false;
    $result = sqldoitarr($CONFIG["SQLUserDB"], "SELECT `U_Passwort` FROM `user` WHERE `U_Benutzername` = '".sqlmask($user)."'");
    if (!$result || $result[0][0] !== crypt($passw, $result[0][0]))
        return false;
    return true;
}

function changepw($user, $oldpw, $newpw, $newpwwdh) {
    global $CONFIG;
    if (!isset($oldpw) || !isset($newpw) || !isset($newpwwdh))
        return false;
    if ($newpw !== $newpwwdh)
        return false;
    $result = sqldoitarr($CONFIG["SQLUserDB"], "SELECT `U_Passwort` FROM `user` WHERE `U_Benutzername` = '".sqlmask($user)."'");
    if ($result && $result[0][0] !== crypt($oldpw, $result[0][0]))
        return false;
    if (sqldoit($CONFIG["SQLUserDB"], "UPDATE `user` SET `U_Passwort` = '".crypt($newpw)."' WHERE `U_Benutzername` = '".sqlmask($user)."'"))
        return true;
    return false;
}

function sqlinsert($sqltable, $sqlfields, $sqlvalues) {
    global $CONFIG;
    if (count($sqlfields) != count($sqlvalues))
        return false;
    $sqlstr = "INSERT INTO `".$sqltable."`('".join("', '", array_map("sqlmask", $sqlfields))."') VALUES ('".join("', '", array_map("sqlmask", $sqlvalues))."')";
    if (sqldoit($CONFIG["SQLMautDB"], $sqlstr))
        return true;
    return false;
}

function sqldelete($sqltable, $sqlfilter) {
    global $CONFIG;
    $sqlwhere = join(" AND ", array_map(function($vergleich){
        return "`".$vergleich[0]."` = '".$vergleich[1]."'";
    }, $sqlfilter));
    $sqlstr = "DELETE FROM '".$sqltable."' WHERE ".$sqlwhere;
    if (sqldoit($CONFIG["SQLMautDB"], $sqlstr))
        return true;
    return false;
}

function sqldoit($sqldb, $sqlstr) {
    global $CONFIG;
    if (!isset($sqlstr) || !$sqlstr)
        return false;
    
    $connect = mysqli_connect($CONFIG["SQLConn"], $CONFIG["SQLUser"], $CONFIG["SQLPass"]);
    mysqli_select_db($connect, $sqldb);
    
    $result = mysqli_query($connect, $sqlstr);
    mysqli_close($connect);
    
    return $result;
}

function sqldoitarr($sqldb, $sqlstr) {
    $result = sqldoit($sqldb, $sqlstr);
    if (!$result)
        return false;
    if (is_bool($result))
        return $result;
    $arr = array();
    while ($row = mysqli_fetch_row($result)) {
        $arr[] = $row;
    }
    return $arr;
}

function sqlmask($sqlstring) {
    return str_replace("'", "\\'", str_replace("\\", "\\\\", $sqlstring));
}
?>