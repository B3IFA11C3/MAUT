<?php
    function sqlinsert ($sqlconn, $sqluser, $sqlpass, $sqldaba, $sqltable, $sqlfields, $sqlvalues) {
        if (count($sqlfields) != count($sqlvalues))
            return "Interner Fehler (".count($sqlvalues)." Values für ".count($sqlfields)." Felder)";
        $sqlstr = "INSERT INTO ".$sqltable."('".join("', '", array_map("sqlmask", $sqlfields))."') VALUES ('".join("', '", array_map("sqlmask", $sqlvalues))."')";
        if (sqldoit($sqlconn, $sqluser, $sqlpass, $sqldaba, $sqlstr))
            return "Eintrag eingefügt!";
        return "Interner Fehler bei der Datenbankkommunikation";
    }

    function sqldoit ($sqlconn, $sqluser, $sqlpass, $sqldaba, $sqlstr) {
        if (!isset($sqlstr) || !$sqlstr)
            return false;
        
        $connect = mysqli_connect($sqlconn, $sqluser, $sqlpass);
        mysqli_select_db($sqldaba);

        $result = mysqli_query($connect, $sqlstr);
        mysqli_close($connect);

        return $result;
    }

    function sqlmask ($sqlstring) {
        return mysqli_real_escape_string($sqlstring);
        //return str_replace("'", "\\'", $sqlstring);
    }

    function changepw ($sqlconn, $sqluser, $sqlpass, $sqldaba, $user, $oldpw, $newpw, $newpwwdh) {
        if (!isset($oldpw) || !isset($newpw) || !isset($newpwwdh))
            return "Bitte altes Passwort, neues Passwort und neues Passwort wiederholen füllen!";
        if ($newpw !== $newpwwdh)
            return "Das neue Passwort stimmt nicht mit der Wiederholung überein!";
        $result = sqldoit($sqlconn, $sqluser, $sqlpass, $sqldaba, "SELECT password FROM benutzer WHERE user = '".sqlmask($user)."'");
        if (mysqli_fetch_assoc($result)[0] !== $oldpw)
            return "Das eingegebene Passwort ist nicht korrekt!";
        if (sqldoit($sqlconn, $sqluser, $sqlpass, $sqldaba, "UPDATE benutzer SET password = '".sqlmask($newpw)."' WHERE user = '".sqlmask($user)."'"))
            return "Passwort geändert!";
        return "Interner Fehler bei der Datenbankkommunikation";
    }
?>