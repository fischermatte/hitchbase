<?php
class Administrator
{
	var $a_id;
	var $name;
	var $email;
	
	
	function Administrator ($dic)
	{
		$this->a_id 				= $dic['a_id'];
		$this->name					= $dic['name'];
		$this->email				= $dic['email'];
	}
		
	function alleAdmins()
	{		
		$sql ="Select a_id, name, email from odb_admin where name = 'masteradmin'";
		return DB::query("$sql", "Administrator");
	}
	
	function getMasterAdmin()
	{		
		$sql ="Select a_id, name, email from odb_admin where name='masteradmin'";
		return DB::query("$sql", "Administrator");
	}
		
	function get_admin($user,$pass) 
	{
		$sql_stmt = "SELECT user, pass FROM odb_admin WHERE user = '$user'";
		$user_daten = DB::query($sql_stmt, "ARRAY", $min=0, $max=-1, 
                       $count_all_results=NULL);
		return $user_daten;
		
	}
	
	
	//Instanzen-Methoden
	function SendNewEntry($message, $type="Trampstelle") 
	{
	 	$to ="$this->name <$this->email>";
		
		//specify MIME version 1.0 
		$headers = "MIME-Version: 1.0\n"; 
		
		//tell e-mail client this e-mail contains//alternate versions 
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From: Ortsdatenbank<seitenmeister@trampstop.de>\r\n"; 
		//HTML 
		
		
		@mail($to, "$type eingetragen", $message, $headers); 

	}


	function login_admin($user, $pass) {
		$user_daten = Administrator::get_admin($user,$pass);
			/*georg noch mal anhauen warum man keinen row erzeugen kann. �ber array ging es und so hab ich das auch erst mal schnell gelassen! m�sste man nachvollziehen was f�r einen array der da erzeugt, jetzt keinen bock, ich glaub man muss das objekt auslesen ->user... bringt auch einen fehler beim nicht existierenden benutzernamen!*/
		if (empty($user_daten[0][0]))
		{
						$status['Login']=0;
						$status['text']= "Der Benutzername existiert nicht!";					
		}
		if (isset($user_daten[0][0]))
		{
		if ($user_daten[0][0] == $user && $user_daten[0][1] == $pass)
			{
						$status['Login']=1;
						$status['rechte']=15;
						$status['text']= "Du bist als Admin eingelogt!";
						$status['user']= $user;
						$status['time']= time();

			}
		else 
			{
						$status['Login']=0;
						$status['text']= "Das Passwort war Falsch!";
			}
		}
		
		return $status;
		 
	}
}



?>