<?php
class DB
{
    var $name;
    var $server;
    var $user;
    var $password;
    var $status;

    function DB()
    {
        $this->name = Connection::$name;
        $this->server = Connection::$server;
        $this->user = Connection::$user;
        $this->password = Connection::$password;
        $this->connect();

    }

    function connect()
    {
        if (!MYSQL_CONNECT($this->server, $this->user, $this->password))
            die ("mysql_connect gescheitert");

        if (!MYSQL_SELECT_DB($this->name))
            die ("Datenbank  nicht gefunden");
        $status = "OPEN";
    }

    function disconnect()
    {
        MYSQL_CLOSE();
    }


    function get_LastID()
    {
        $result = MYSQL_QUERY("SELECT LAST_INSERT_ID()");
        if (!$result)
            die ("<h3>Fehler:" . mysql_error());
        if ($row = mysql_fetch_array($result))
            return $row[0];
        else
            die ("Datenbankfehler: ID konnte nicht ermittelt werden");
    }

    function do_sql($sql_stmt, $doReturn = false)
    {
        $result = MYSQL_QUERY($sql_stmt);
        if (!$result) {
            if (!$doReturn)
                die ("<h3>Fehler:</h3><pre>$sql_stmt</pre>" . mysql_error());
            else
                echo ("<h3>Fehler:</h3><pre>$sql_stmt</pre>" . mysql_error());
            return false;
        }
        if ($doReturn)
            return true;
    }

    function getSysdate()
    {
        $result = MYSQL_QUERY('select sysdate()');
        if (!$result)
            die ("<h3>Fehler:</h3><pre>$sql_stmt</pre>" . mysql_error());
        $row = mysql_fetch_array($result);
        return $row[0];

    }


    function query_hash($table)
    {
        $sql = "select * from $table";
        $result = MYSQL_QUERY($sql);
        if (!$result)
            die ("<h3>Fehler:</h3><pre>$sql_stmt</pre>" . mysql_error());
        $result_array = array();
        $first = 1;
        $hash = array();
        while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
            if ($first) {
                $first = 0;
                $keys = array_keys($row);
                if ($row[0] == $row['id']) {
                    $key_pos = 0;
                    $value_pos = 1;
                } else {
                    $key_pos = 1;
                    $value_pos = 0;
                }
            }
            $hash[$row[$key_pos]] = $row[$value_pos];
        }
        return $hash;
    }

    function num_results($fatal = 1)
    {
        if (!isset($_SESSION['LAST_RESULT_CARD'])) {
            if ($fatal == 1)
                die("keine Information �ber die Anzahl der Ergebnisse verf�gbar");
            return -1;
        }
        return $_SESSION['LAST_RESULT_CARD'];
    }

    function num_results_sql()
    {
        return $_SESSION['LAST_RESULT_SQL_NUM'];
    }


    function check($sql, $num = 1, $msg = "")
    {
        $results = DB::query($sql, "ARRAY");
        $num_results = count($results);
        if (!$msg)
            $msg = "Falsches Ergebnis bei DB::check(...). Das Statement <pre>$sql</pre> haette $num Ergebnisdatensaetzte zur�ckliefern sollen, hat aber $$num_results Datensaetze zur�ckgeliefert";
        if ($num_results != $num)
            die("Fehler: $msg");
    }

    function query($sql_stmt, $class, $min = 0, $max = -1,
                   $count_all_results = NULL)
    {
        if ($count_all_results) {
            $sql_num = preg_replace('/(^\s*select)(.*?)(from.*?)(limit.*)?$/is', "\\1 \\2 \\3", $sql_stmt);

            $result = MYSQL_QUERY($sql_num);
            $num = mysql_num_rows($result);
            if (!isset($num))
                die("Anzahl kann nicht ermittelt werden<pre>$sql_num</pre>Fehlermeldung: " . mysql_error());
            $_SESSION['LAST_RESULT_CARD'] = $num;
            $_SESSION['LAST_RESULT_SQL_NUM'] = $sql_num;
#                die("sql:<br>[$sql_num]    <p>num: $num[0]");
        } else {
            # $_SESSION['LAST_RESULT_CARD'] = NULL;
            # $_SESSION['LAST_RESULT_SQL_NUM'] = NULL;
        }


        $result = MYSQL_QUERY($sql_stmt);

        if (!$result)
            die ("<h3>Fehler:</h3><pre>$sql_stmt</pre>" . mysql_error());
        $result_array = array();
       #print "<pre>$sql_stmt: (".MYSQL_NUM_ROWS($result).") </pre>";
        while ($row = mysql_fetch_array($result)) {
#                $cols = mysql_num_fields($result);
            if ($class != "ARRAY") {
                $s = "\$obj = new $class(\$row);";
                eval($s);
            } else {
                $obj = $row;
            }
#             echo "[$s]<br>\n";
            $result_array[] = $obj;

        }
        if ($min > 0 && count($result_array) <= 0)
            die ("Es muss mindestens ein Datensatz zur&uuml;ckgeliefert werden, es wurde aber kein Datensatz gefunden (<pre>$sql_stmt</pre>)");
        if ($max == 1 && count($result_array) > 1)
            die ("Es darf h&ouml;chstens ein Datensatz zur&uuml;ckgeliefert werden, es wurde aber " . count($result_array) . "  Datens&auml;tze gefunden (<pre>$sql_stmt</pre>)");
        if ($max == 1 && count($result_array) == 1) {
            return $result_array[0];
        } else {
            return $result_array;
        }
    }
}


?>