<?php

class Trampstelle
{
    var $t_id;
    var $startort_id_fk;
    var $zielorte;
    var $bezeichnung;
    var $strassennamen;

    function Trampstelle($dic)
    {
        $this->t_id = $dic['t_id'];
        $this->startort_id_fk = $dic['startort_id_fk'];
        if (!isset($dic['zielorte']))
            $this->zielorte = "";
        else
            $this->zielorte = $dic['zielorte'];
        $this->bezeichnung = $dic['bezeichnung'];
        $this->strassennamen = $dic['strassennamen'];
    }

    function get_t_id($o_id)
    {

        $sql_stmt = "SELECT t_id FROM odb_trampstelle WHERE startort_id_fk = '$o_id'";
        return DB::query($sql_stmt, "ARRAY", $min = 0, $max = -1,
            $count_all_results = NULL);
        ;

    }


    function create($dic)
    {

        if (!$startort = Ort::get_byName($dic['startort'], $dic['land'])) {
            $startort = Ort::create($dic['startort'], $dic['land']);
        }

        if (isset($dic['zielorte']) && is_array($dic['zielorte'])) {
            for ($x = 0; $x < sizeof($dic['zielorte']); $x++) {
                if (trim($dic['zielorte'][$x]['ort']) != "") {
                    if (!$zielort = Ort::get_byName($dic['zielorte'][$x]['ort'], $dic['zielorte'][$x]['land'])) {
                        $zielort = Ort::create($dic['zielorte'][$x]['ort'], $dic['zielorte'][$x]['land']);
                    }
                    $neue_zielorte[$x] = $zielort->o_id;
                }
            }
        }
        foreach ($dic['hr'] as $hr) {
            if ($hr != "0")
                $neue_zielorte[] = $hr;
        }


        $new_dic['startort_id_fk'] = $startort->o_id;
        $new_dic['zielorte'] = $neue_zielorte;
        $new_dic['bezeichnung'] = empty($dic['bezeichnung']) ? "NULL" : "'" . addslashes($dic['bezeichnung']) . "'";
        $new_dic['strassennamen'] = empty($dic['strassennamen']) ? "NULL" : "'" . addslashes($dic['strassennamen']) . "'";


        DB::do_sql("INSERT INTO odb_trampstelle (startort_id_fk, bezeichnung,strassennamen)
                       VALUES ($new_dic[startort_id_fk],$new_dic[bezeichnung],$new_dic[strassennamen])");

        $new_dic['t_id'] = DB::get_LastID();

        foreach ($new_dic['zielorte'] as $zielort)
            DB::do_sql("INSERT INTO odb_ts_zielorte (t_id_fk,zielort_id_fk)
							VALUES ($new_dic[t_id],$zielort)");
        //$new_dic[t_id],$zielort)");

        //Kommentar eintragen
        $kommentar = Array();
        $kommentar['beschreibung'] = addslashes($dic['beschreibung']);
        $kommentar['absender'] = addslashes($dic['absender']);
        $kommentar['bewertung'] = $dic['bewertung'];
        $kommentar['t_id_fk'] = $new_dic['t_id'];
        Kommentar::create($kommentar);

        return new Trampstelle ($new_dic);
    }

    function getTrampstellen($options = array())
    {
        $sql = "SELECT distinct ots.t_id,ots.startort_id_fk,ots.bezeichnung,ots.strassennamen
					FROM odb_trampstelle ots, odb_ts_zielorte otz, odb_orte oos, odb_orte ooz
					WHERE ots.t_id = otz.t_id_fk
					AND ots.startort_id_fk = oos.o_id
					AND otz.zielort_id_fk = ooz.o_id";

        if (isset($options['condition_zielort']) && $options['condition_zielort'] != "-1" && $options['condition_zielort'] != null) {
            $sql .= " AND otz.zielort_id_fk =" . $options["condition_zielort"];
        }

        if (isset($options['condition_startort']) && $options['condition_startort'] != "-1" && $options['condition_startort'] != null) {
            $sql .= " AND ots.startort_id_fk =" . $options["condition_startort"];
        }

        if (isset($options['condition_zielland']) && $options['condition_zielland'] != "-1" && $options['condition_zielland'] != null && isset($options['condition_zielort']) && $options['condition_zielort'] > -1 && $options['condition_zielort'] < 5) {
            $sql .= " AND oos.l_id_fk = " . $options["condition_zielland"];
        } else if (isset($options['condition_zielland']) && $options['condition_zielland'] != "-1" && $options['condition_zielland'] != null) {
            $sql .= " AND ooz.l_id_fk = " . $options["condition_zielland"];
        }

        if (isset($options['condition_startland']) && $options['condition_startland'] != "-1" && $options['condition_startland'] != null) {
            $sql .= " AND oos.l_id_fk = " . $options["condition_startland"];
        }

        //$sql .= " group by ots.t_id";
        if (isset($options['order']))
            $sql .= " ORDER BY " . $options["order"];
        if (isset($options['limit']))
            $sql .= " LIMIT " . $options["limit"];

        return DB::query("$sql", "Trampstelle", 0, -1, true);
    }


    function GetTrampstelle($t_id)
    {
        $sql = "SELECT distinct ots.t_id,ots.startort_id_fk,ots.bezeichnung,ots.strassennamen
					FROM odb_trampstelle ots
					WHERE ots.t_id = '$t_id'";

        $l = DB::query("$sql", "Trampstelle", 1, 1);

        return $l;
    }

    function getTrampstelle_check($t_id)
    {
        $sql = "SELECT t_id,startort_id_fk,bezeichnung,strassennamen
				FROM odb_trampstelle
				WHERE t_id = '$t_id'";

        $l = DB::query("$sql", "Trampstelle", 0, -1, true);

        return $l;
    }


//-----------------------------
//		Instanzmethoden
//-----------------------------
    function getBewertung()
    {
        $sql = "select round(sum(bewertung)/count(*))
				from odb_kommentar
				where t_id_fk = $this->t_id";
        $bewertung = DB::query("$sql", "ARRAY", 1, 1);


        return $bewertung[0];
    }


    function getKommentare()
    {
        $sql = "SELECT k_id,t_id_fk,beschreibung,bewertung,absender,datum
				FROM odb_kommentar
				WHERE t_id_fk = $this->t_id
				AND NOT (beschreibung is null)
				order by 6 asc";

        $l = DB::query("$sql", "Kommentar");

        return $l;
    }

    function getStartort()
    {
        //liefert den Startort als Instanz von Ort zur�ck

        if ($this->startort_id_fk)
            return Ort::get($this->startort_id_fk);
        else
            return null;
    }

    function getZielorte()
    {
        //liefert alle Zielorte als Instanz von Ort in einem Array zur�ck

        $sql = "SELECT oo.o_id, oo.name, ol.name  as land
FROM odb_orte oo,odb_ts_zielorte otz,odb_laender ol
WHERE otz.zielort_id_fk = oo.o_id
AND otz.t_id_fk = $this->t_id
AND oo.l_id_fk = ol.l_id";
        $l = DB::query($sql, "Ort");
        return $l;
    }

    function getRichtungsorte()
    {
        // Gibt Array mit Ort-Objekten zur�ck
        /*$orteobj= DB::query("	select o.o_id,o.name,l.name as land
                            from odb_ts_richtungsorte tr, odb_orte o, odb_laender l
                            where tr.o_id_fk = o.o_id
                            and o.l_id_fk = l.l_id
                            and tr.t_id_fk = $this->t_id","Ort");

        return $orteobj;*/

    }


    function getHimmelsrichtungen($t_id)
    {

    }

    function startort()
    {
        // liefert den Startort als Instanz zurueck
        //
        if ($this->startort)
            return Ort::get($this->startort);
        else
            return null;
    }

    function delTrampstelle($t_id)
    {

        DB::do_sql("DELETE FROM odb_trampstelle WHERE t_id = '$t_id'");
        DB::do_sql("DELETE FROM odb_ts_zielorte WHERE t_id_fk = '$t_id'");
    }


}


?>