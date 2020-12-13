<?php

class Kommentar 
{
	var $k_id;
	var $t_id_fk;
	var $absender;
	var $beschreibung;
	var $datum;
	var $bewertung;
		
	function Kommentar ($dic)
	{
		$this->k_id 				= $dic['k_id'];
		$this->t_id_fk				= $dic['t_id_fk'];
		$this->beschreibung			= $dic['beschreibung'];
		$this->bewertung			= $dic['bewertung'];
		$this->absender				= $dic['absender'];
		$this->datum				= $dic['datum'];
	}
	
	function create($dic) 
	{         
			$new_dic['t_id_fk']			= $dic['t_id_fk'];
			$new_dic['beschreibung']	= empty($dic['beschreibung'])?"NULL":"'".$dic['beschreibung']."'";
			$new_dic['bewertung']		= $dic['bewertung'];
			$new_dic['absender']		= empty($dic['absender'])?"NULL":"'".$dic['absender']."'";
			$new_dic['datum']			= "'".db::getSysdate()."'"; 			
			
			$sql = "INSERT INTO odb_kommentar (t_id_fk, beschreibung,bewertung,absender,datum)
                       VALUES ($new_dic[t_id_fk],$new_dic[beschreibung],$new_dic[bewertung],$new_dic[absender],$new_dic[datum])";
			
			DB::do_sql($sql);

			
			$new_dic['k_id'] = DB::get_LastID();					
			
			return new Kommentar ($new_dic);		
	}
	
	function getKommentar($k_id) {
			$sql ="SELECT k_id,t_id_fk,beschreibung,bewertung,absender,datum
				FROM odb_kommentar
				WHERE k_id = '$k_id'";
							
			$l = DB::query("$sql", "Kommentar",0,-1,true);
			
			return $l;
		}
		
	function updateKommentar($dic) 
	{            
			DB::do_sql("UPDATE odb_kommentar SET beschreibung='$dic[beschreibung]', bewertung='$dic[bewertung]', absender='$dic[absender]', datum='$dic[datum]' WHERE k_id = '$dic[k_id]'");
			
			return $dic['k_id'];
		
	}
	
	function delKommentar($k_id) 
	{            
						
			DB::do_sql("DELETE FROM odb_kommentar WHERE k_id = '$k_id'");		
	}
	
	
	
	
	
	}
	
			?>