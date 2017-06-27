<?php
    require("config.inc.php");
    function checklogin ($user, $passw) {
        if (!isset($user) || !isset($passw))
            return array(false, "Bitte Benutzername und Passwort angeben!");
        $result = sqldoit("SELECT password FROM benutzer WHERE user = '".sqlmask($user)."'");
        if ($result && mysqli_fetch_assoc($result)[0] !== $passw)
            return array(false, "Benutzername oder Passwort falsch!");
        return array(true, $user);
    }

    function changepw ($user, $oldpw, $newpw, $newpwwdh) {
        if (!isset($oldpw) || !isset($newpw) || !isset($newpwwdh))
            return "Bitte altes Passwort, neues Passwort und neues Passwort wiederholen füllen!";
        if ($newpw !== $newpwwdh)
            return "Das neue Passwort stimmt nicht mit der Wiederholung überein!";
        $result = sqldoit("SELECT password FROM benutzer WHERE user = '".sqlmask($user)."'");
        if ($result && mysqli_fetch_assoc($result)[0] !== $oldpw)
            return "Das eingegebene Passwort ist nicht korrekt!";
        if (sqldoit("UPDATE benutzer SET password = '".sqlmask($newpw)."' WHERE user = '".sqlmask($user)."'"))
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