<?php
    require("config.inc.php");
    function checklogin ($user, $passw) {
        if (!isset($user) || !isset($passw))
            return false;
        $result = sqldoit("SELECT U_Passwort FROM User WHERE U_Benutzername = '".sqlmask($user)."'");
        if ($result && mysqli_fetch_assoc($result)[0] !== $passw)
            return false;
        return true;
    }

    function changepw ($user, $oldpw, $newpw, $newpwwdh) {
        if (!isset($oldpw) || !isset($newpw) || !isset($newpwwdh))
            return "Bitte altes Passwort, neues Passwort und neues Passwort wiederholen füllen!";
        if ($newpw !== $newpwwdh)
            return "Das neue Passwort stimmt nicht mit der Wiederholung überein!";
        $result = sqldoit("SELECT U_Passwort FROM User WHERE U_Benutzername = '".sqlmask($user)."'");
        if ($result && mysqli_fetch_assoc($result)[0] !== $oldpw)
            return "Das eingegebene Passwort ist nicht korrekt!";
        if (sqldoit("UPDATE User SET U_Passwort = '".sqlmask($newpw)."' WHERE U_Benutzername = '".sqlmask($user)."'"))
            return "Passwort geändert!";
        return "Interner Fehler bei der Datenbankkommunikation";
    }

    function sqlinsert ($sqltable, $sqlfields, $sqlvalues) {
        if (count($sqlfields) != count($sqlvalues))
            return "Interner Fehler (".count($sqlvalues)." Values für ".count($sqlfields)." Felder)";
        $sqlstr = "INSERT INTO ".$sqltable."('".join("', '", array_map("sqlmask", $sqlfields))."') VALUES ('".join("', '", array_map("sqlmask", $sqlvalues))."')";
        if (sqldoit($sqlstr))
            return "Eintrag eingefügt!";
        return "Interner Fehler bei der Datenbankkommunikation";
    }

    function sqldoit ($sqlstr) {
        if (!isset($sqlstr) || !$sqlstr)
            return false;
        
        $connect = mysqli_connect($CONFIG["SQLConn"], $CONFIG["SQLUser"], $CONFIG["SQLPass"]);
        mysqli_select_db($CONFIG["SQLDaBa"]);

        $result = mysqli_query($connect, $sqlstr);
        mysqli_close($connect);

        return $result;
    }

    function sqlmask ($sqlstring) {
        return str_replace("'", "\\'", str_replace("\\", "\\\\", $sqlstring));
    }
?>