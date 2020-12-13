<?php

class Ort {

	var $o_id;
	var $name;
	var $land;
	var $anzahltrampstellen;

#	Konstruktor
	function Ort ($dic) {
			$this->o_id	=	$dic['o_id'];
			$this->name	=	$dic['name'];
			$this->land	=	$dic['land'];
			$this->anzahltrampstellen	=	@$dic['anzahltrampstellen'];
			
	
	}
# 	Klassenmethoden
	function create ($ortsname,$land) {
		$new_dic['land'] 		= 	empty($land)?"NULL":"'".addslashes($land)."'";
		$new_dic['name'] 		= 	empty($ortsname)?"NULL":"'".addslashes($ortsname)."'";
		DB::do_sql("INSERT INTO odb_orte (name, l_id_fk)
                     VALUES ($new_dic[name],$new_dic[land])");
		$new_dic['o_id'] = DB::get_LastID();
		
		return new Ort ($new_dic);
	
	}
	function alleStartorte($options=array()){
		 $sql = "	select distinct ts.startort_id_fk as o_id, so.name, so.l_id_fk as land 
					from odb_trampstelle ts, odb_orte so, odb_ts_zielorte tz, odb_orte zo
					where ts.startort_id_fk = so.o_id
					and ts.t_id = tz.t_id_fk
					and tz.zielort_id_fk = zo.o_id";
         if (isset($options['condition_zielort']) && $options['condition_zielort'] != "-1")
                $sql .= " and tz.zielort_id_fk =".$options["condition_zielort"];
          if (isset($options['condition_zielland']) && $options['condition_zielland'] != "-1" )
                $sql .= " and (zo.l_id_fk = ".$options["condition_zielland"]." or zo.l_id_fk = 267 )";
		 if (isset($options['condition_startland']) && $options['condition_startland'] != "-1" )
                $sql .= " and so.l_id_fk = ".$options["condition_startland"];
		 if (isset($options['order']))
               $sql .= " ORDER BY ".$options["order"];
         return DB::query("$sql", "Ort");
    
	}
	
	function alleStartorteSimple($options=array())
	{
		 $sql = "	select ts.startort_id_fk as o_id, so.name, so.l_id_fk as land,count(ts.t_id) as anzahltrampstellen 
					from odb_trampstelle ts, odb_orte so
					where ts.startort_id_fk = so.o_id";
       		 if (isset($options['condition_startland']) && $options['condition_startland'] != "-1" )
                $sql .= " and so.l_id_fk = ".$options["condition_startland"];
	     $sql .= " Group by ts.startort_id_fk ";
		 if (isset($options['order']))
               $sql .= " ORDER BY ".$options["order"];
         return DB::query("$sql", "Ort");
    
	}

	function alleZielorte($options=array()){
		 $sql = "	select distinct tz.zielort_id_fk as o_id, zo.name, zo.l_id_fk as land
					from odb_ts_zielorte tz, odb_orte zo, odb_trampstelle ts, odb_orte so
					where tz.zielort_id_fk = zo.o_id
					and ts.startort_id_fk = so.o_id
					and tz.t_id_fk = ts.t_id";

         if (isset($options['condition_startort']) && $options['condition_startort'] != "-1" )
                $sql .= " and ts.startort_id_fk = ".$options["condition_startort"];
         if (isset($options['condition_zielland']) && $options['condition_zielland'] != "-1" )
                $sql .= " and (zo.l_id_fk = ".$options["condition_zielland"]." or zo.l_id_fk = 267)";
		if (isset($options['condition_startland']) && $options['condition_startland'] != "-1" )
                $sql .= " and so.l_id_fk = ".$options["condition_startland"];
		 if (isset($options['order']))
               $sql .= " ORDER BY ".$options["order"];
         return DB::query("$sql", "Ort");
    
	}
	function get_byName($ortsname,$land) {
	//echo "Land:".$land;
		$sql = "select o_id, name, l_id_fk as land from odb_orte where l_id_fk = $land and name = '".addslashes($ortsname)."'";
		return DB::query("$sql","Ort",0,1);
	}
	
# 	Instanzmethoden

	
	function get($o_id) {
            // liefert die durch den Parameter $o_id eindeutig
            // spezifizierte Instanz zurueck
            //
            $l = DB::query("SELECT oo.o_id, oo.name, ol.name as land
                              FROM odb_orte oo, odb_laender ol
                             WHERE oo.l_id_fk = ol.l_id
							 AND oo.o_id = $o_id","Ort",1,1);
            return $l;
       }
	   function get2($o_id) {
            // liefert die durch den Parameter $o_id eindeutig
            // spezifizierte Instanz zurueck
            //
            $l = DB::query("SELECT oo.o_id, oo.name, oo.l_id_fk as land
                              FROM odb_orte oo
							 WHERE oo.o_id = $o_id","Ort",1,1);
            return $l;
       }
	   
	function get_land($l_id) {
            // liefert die durch den Parameter $o_id eindeutig
            // spezifizierte Instanz zurueck
            //
            $land = DB::query("SELECT name FROM odb_laender
                             WHERE l_id = $l_id","Ort",1,1);
            return $land;
       }
	   
	function delOrt($startort_id_fk) 
	{            
	
			DB::do_sql("DELETE FROM odb_orte WHERE o_id = '$startort_id_fk'");
		
	}
	
	
	
}


?>
