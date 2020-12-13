<?php

class GeoTrampstelle 
{
	var $g_id;
	var $trampstelle_id_fk;
	var $lat;
	var $long;
	
	function GeoTrampstelle ($dic)
	{
		$this->g_id 					= $dic['g_id'];
		$this->trampstelle_id_fk		= $dic['trampstelle_id_fk'];		
		$this->lat						= $dic['lat'];
		$this->long						= $dic['long'];	
	}
	
	
	function create($dic) 
	{				           			
		$new_dic['trampstelle_id_fk'] 		=	 $dic['trampstelle_id_fk'];
		$new_dic['lat'] 			= 	$dic['lat'];
		$new_dic['long'] 		= 	$dic['long'];
							
		DB::do_sql("INSERT INTO odb_geotrampstelle (trampstelle_id_fk, lat,long)
				   VALUES ($new_dic[trampstelle_id_fk],$new_dic[lat],$new_dic[long])");
		
		$new_dic['g_id'] = DB::get_LastID();	
		return new GeoTrampstelle ($new_dic);
    }	
}



?>