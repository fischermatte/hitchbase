<?php
class Land
{
	var $l_id;
	var $name;
	var $anzahltrampstellen;
	
	function Land ($dic) {
		$this->l_id 					= $dic['l_id'];
		$this->name						= ucwords(strtolower($dic['name']));
		$this->anzahltrampstellen	    = @$dic['anzahltrampstellen'];
	}
	
	function get ($l_id) {
		$sql = "select l_id, name from odb_laender where l_id = $l_id";
		return DB::query("$sql", "Land",1,1);
	}
	
	
	// Klassenmethode, liefert alle L�nder als Objekte zurueck
	function alle($options=array()) {
                  
            $sql = "SELECT l_id,name 
					FROM odb_laender";
            if (isset($options['condition']))
                $sql .= " WHERE ".$options["condition"];
            if (isset($options['order']))
                $sql .= " ORDER BY ".$options["order"];
            return DB::query("$sql", "Land");
    }
	
	function alleStartLaender($options=array()) {

            $sql = "select o.l_id_fk as l_id, l.name,count(ts.t_id) as anzahltrampstellen
					from odb_orte o, odb_laender l,odb_trampstelle ts
					where o.l_id_fk = l.l_id
					and o.o_id = ts.startort_id_fk
					group by o.l_id_fk
					order by l.name ";
			
			//if (isset($options['condition_startort']) && $options['condition_startort'] != "-1" )
            //    $sql .= " AND o.o_id =".$options["condition_startort"];
            if (isset($options['order']))
            return DB::query("$sql", "Land");
    }
	
	function alleZielLaender($options=array()) {
            $sql = "select distinct o.l_id_fk as l_id, l.name
					from odb_orte o, odb_laender l,odb_ts_zielorte otz,odb_orte o2,odb_trampstelle ts
					where o.l_id_fk = l.l_id
					and o.o_id = otz.zielort_id_fk
					and ts.t_id = otz.t_id_fk
					and o2.o_id = ts.startort_id_fk";							
			if (isset($options['condition_zielort']) && $options['condition_zielort'] != "-1"  && $options["condition_zielort"] > 4)
                $sql .= " AND o.o_id =".$options["condition_zielort"];
			if (isset($options['condition_startort']) && $options['condition_startort'] != "-1")
                $sql .= " AND ts.startort_id_fk =".$options["condition_startort"];
		 	if (isset($options['condition_startland']) && $options['condition_startland'] != "-1" )
                $sql .= " AND o2.l_id_fk = ".$options["condition_startland"];
            if (isset($options['order']))
                $sql .= " ORDER BY ".$options["order"];
            return DB::query("$sql", "Land");
    }
}
	
	/*function getAsList($land){
    	$list ="";
		
		$result = mysql_query( "SELECT id,name FROM odb_laender ORDER BY name ASC");
		if (!$result)
                die ("Fehler beim Laden .<br>".mysql_error());
		   		
		$row = mysql_fetch_assoc($result);
		do {  
			$list .="<option value=\"".$row['id']."\"";
			if ($land != "null" && $land = $row['id']) 
				$list .= " selected ";
			$list .=" >".$row['name']."</option>";
    	} while ($row = mysql_fetch_assoc($result));
  
		return $list;
  }*/
?>
