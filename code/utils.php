<?php
    require("code/config.inc.php");

    function checklogin ($user, $passw) {
        global $CONFIG;
        if (!isset($user) || !isset($passw))
            return false;
        $result = sqldoitarr($CONFIG["SQLUserDB"], "SELECT `U_Passwort` FROM `User` WHERE `U_Benutzername` = '".sqlmask($user)."'");
        if (!$result || $result[0][0] !== crypt($passw, $result[0][0]))
            return false;
        return true;
    }

    function changepw ($user, $oldpw, $newpw, $newpwwdh) {
        global $CONFIG;
        if (!isset($oldpw) || !isset($newpw) || !isset($newpwwdh))
            return "Bitte altes Passwort, neues Passwort und neues Passwort wiederholen füllen!";
        if ($newpw !== $newpwwdh)
            return "Das neue Passwort stimmt nicht mit der Wiederholung überein!";
        $result = sqldoitarr($CONFIG["SQLUserDB"], "SELECT `U_Passwort` FROM `User` WHERE `U_Benutzername` = '".sqlmask($user)."'");
        if ($result && $result[0][0] !== crypt($oldpw, $result[0][0]))
            return "Das eingegebene Passwort ist nicht korrekt!";
        if (sqldoit($CONFIG["SQLUserDB"], "UPDATE `User` SET `U_Passwort` = '".crypt($newpw)."' WHERE `U_Benutzername` = '".sqlmask($user)."'"))
            return "Passwort geändert!";
        return "Interner Fehler bei der Datenbankkommunikation";
    }

    function sqlinsert ($sqltable, $sqlfields, $sqlvalues) {
        global $CONFIG;
        if (count($sqlfields) != count($sqlvalues))
            return "Interner Fehler (".count($sqlvalues)." Values für ".count($sqlfields)." Felder)";
        $sqlstr = "INSERT INTO `".$sqltable."`('".join("', '", array_map("sqlmask", $sqlfields))."') VALUES ('".join("', '", array_map("sqlmask", $sqlvalues))."')";
        if (sqldoit($CONFIG["SQLMautDB"], $sqlstr))
            return true;
        return false;
    }

    /* 
     * $sqlfilter: [[filename, vergleichswert], ...]
     */
    function sqldelete ($sqltable, $sqlfilter) {
        global $CONFIG;
        $sqlwhere = join(" AND ", array_map(function ($vergleich) {return "`".$vergleich[0]."` = '".$vergleich[1]."'";}, $sqlfilter));
        $sqlstr = "DELETE FROM '".$sqltable."' WHERE ".$sqlwhere;
        if (sqldoit($CONFIG["SQLMautDB"], $sqlstr))
            return true;
        return false;
    }

    function sqldoit ($sqldb, $sqlstr) {
        global $CONFIG;
        if (!isset($sqlstr) || !$sqlstr)
            return false;
        
        $connect = mysqli_connect($CONFIG["SQLConn"], $CONFIG["SQLUser"], $CONFIG["SQLPass"]);
        mysqli_select_db($connect, $sqldb);

        $result = mysqli_query($connect, $sqlstr);
        mysqli_close($connect);

        return $result;
    }

    function sqldoitarr ($sqldb, $sqlstr) {
        $result = sqldoit($sqldb, $sqlstr);
        if (!$result)
            return false;
        if (is_bool($result))
            return $result;
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
        return $arr;
    }

    function sqlmask ($sqlstring) {
        return str_replace("'", "\\'", str_replace("\\", "\\\\", $sqlstring));
    }
?>