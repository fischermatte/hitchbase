<?php
session_start();
	include('../or-ortsdatenbank.php'); 
	include ("../languages/language.php");
	include ("../utils.php");

define('FPDF_FONTPATH','/www/htdocs/agrajag/pdf/font/');
require('fpdf.php');

class PDF extends FPDF
{
//Page header
function Header()
{
    //Logo
    //$this->Image('abgefahren_ev_3.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'hitchbase2pdf',1,0,'C');
    //Line break
    $this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}



	$db = new DB();
	if (isset($_GET['abfrage']))
		$abfrage = $_GET['abfrage'];
	else
	{
		$abfrage['startort'] = -1;
		$abfrage['zielort'] = -1;
		$abfrage['startland'] = -1;
		$abfrage['zielland'] = -1;
		$abfrage['startort_name'] = -1;
	}
	
	if(!isset($_GET['page'])){
		$page = 1; 
	} else { 
		$page = $_GET['page'];
	} 
	
	$proseite=10;
	$start = (($page * $proseite) - $proseite); 
	$limit = $start.",".$proseite;
	
	
	?>



 <?
 
 

	//Falls eine Konkrete Trampstelle ausgegeben werden soll
	if (isset($_GET['t_id']))
	{		
		if (isset($_GET['success']))
		{
			if ($_GET['success'] == true)
			{
				?><br>
					
				<?
					showHeaderTable("Eintrag", $_erfolg,"500");
				?><br>
				<?
				$trampstelle = Trampstelle::GetTrampstelle($_GET['t_id']);
				$type="Trampstelle";
				if (isset($_GET['type'])) $type = $_GET['type'];
				foreach (Administrator::alleAdmins() as $admin)
					$admin->SendNewEntry(getTrampstelleAsHTML($trampstelle),$type);
				include("inc_daten.php");
			}
			else
			{
				?><br>
				<!--<table width="500" border="0" cellpadding="3" cellspacing="0">
					  <tr><td align="center" class="ergebnisseLinkRot">
				<?
				echo $f_5;
				?>
  </td>
					  </tr></table>-->
				<br></form>
				<?
			}
		}
		else 
		{
			echo "<br>";
			$trampstelle = Trampstelle::GetTrampstelle($_GET['t_id']);
			include("inc_daten.php");
		}
	}
	elseif (isset($_GET['startort_name'])) // esr wurde nur ein Name angegeben
	{
			
		?><? 
		$trampstellen = Trampstelle::getTrampstellen(array(	'order'=>'oos.name',
													'condition_startort_name'=>$_GET['startort_name'],
 													'limit'=>$limit));
		
		$tcount = DB::num_results();
		$tcountcurrent = count($trampstellen);
		if($tcount==0) 
			echo "<br> Kein Eintrag!";
		else
		{
			?> <br><? showHeaderTable("Suche",@$_ergebnisse,"500") ?>
                   
				
				<table width="500" height="25" border="0" cellpadding="0" cellspacing="0">
  					<tr>
    					<td align="left" valign="bottom" class="ergebnisseAnzahl"><?=$start+1?>-<?=$start+$tcountcurrent?> of <?=$tcount?> Results </td>
  					</tr>
  				</table>
 
			<?
			foreach ($trampstellen as $trampstelle)
			{	
				include("inc_daten.php");
				
				?> <br><?
			} //Ende foreach schleife ?>			
                               
			<table width="500">
			  <tr>
			    <td align="left" class="pageAktiv">Result Page:&nbsp;			
				<?
					$pages = ceil($tcount/$proseite);
					for ($y=1;$y<=$pages;$y++)
					{	
						?> 
							&nbsp;
						<? 
						if ($page != $y) 
						{
							?>
								<a href="ergebnisse.php?LANG=<?= @$LANG."&startort_name=".$_GET['startort_name']."&page=".$y;?>"
									class="pages"><?=$y?></a>
							<?	
						}
						else
						{
							?>
								<span class="pageAktiv"><?=$y?></span>
							<?
						}					
					} 
				?>
			  </td>
			  </tr>
  </table>
			  <?
  			}
	}
	else //alle Suchergebnisse anzeigen 	
	{
	
		?><?
		$limit = 100000;
		$trampstellen = Trampstelle::getTrampstellen(array(	'order'=>'oos.name',
													'condition_startort'=>$abfrage['startort'],
 													'condition_zielort'=>$abfrage['zielort'],
													'condition_zielland'=>$abfrage['zielland'],
													'condition_startland'=>$abfrage['startland'],
													'limit'=>$limit));
		
		$tcount = DB::num_results();
		$tcountcurrent = count($trampstellen);
		if($tcount==0) 
			echo "<br> Kein Eintrag!";
		else
		{
			?> <br><? //showHeaderTable("Suche",@$_ergebnisse,"500") ?>
                   
				
			
 
			<?
			foreach ($trampstellen as $trampstelle)
			{	
				$startort = $trampstelle->getStartort();
				$name= $startort->name;
				
				
				echo "test";
				
				//Instanciation of inherited class
				$pdf=new PDF();
				$pdf->AliasNbPages();
				$pdf->AddPage();
				$pdf->SetFont('Times','',12);
 				$pdf->Cell(0,10,$name);
				$pdf->Output();

				?> <br><?
			} //Ende foreach schleife ?>			
                               
			
			  <?
  			}//Ende else (mehr als ein Eintrag)
		}//Ende else 2

	?>


	
	



