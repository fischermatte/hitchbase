<?php
/* funktioniert nur, wenn man keine ausgaben vorher macht! also nie echo und co!*/
session_start();
	include('or-ortsdatenbank.php'); 
	$db = new DB();
	if (isset($_GET['abfrage']))
		$abfrage = $_GET['abfrage'];
	else
	{
		$abfrage['startort'] = -1;
		$abfrage['zielort'] = -1;
		$abfrage['startland'] = -1;
		$abfrage['zielland'] = -1;
	}
		$trampstellen = Trampstelle::getTrampstellen(array(	'order'=>'oos.name',
													'condition_startort'=>$abfrage['startort'],
 													'condition_zielort'=>$abfrage['zielort'],
													'condition_zielland'=>$abfrage['zielland'],
														'condition_startland'=>$abfrage['startland'],
													'limit'=>$limit));
													
													/*	
		foreach ($trampstellen as $trampstelle)
			{	
			$startort = $trampstelle->getStartort();
			
			
		
			echo "<br>";
			echo "land: $startort->land";
			echo "<br>";
			echo "bezeichnung: $trampstelle->bezeichnung";
			echo "<br>";
			echo "Bewertung: ";
			echo showBewertung($trampstelle->getBewertung(),$_bewertung_0,$_bewertung_1,$_bewertung_2,$_bewertung_3 );
			echo "<br>";
			echo "Zielorte: ";
			 
			 //zielorte auslesen anfang
			 
			$zielorte = $trampstelle->getZielorte();
		$orte = array();
		$hr = array();
		foreach($zielorte as $ort) 
		{
			if ($ort->land =="-")
			{
				$hr[] = $ort->name;
			}
			else
			{
				$orte[] = $ort->name;  //." (".$ort->land.")";
			}
		}
		$countorte = count($orte);
		if ($countorte > 0) 
		{
			for ($x=0;$x<$countorte;$x++) 
			{
				if ($x > 0 && $countorte > 1)
					echo ", ";
				echo $orte[$x];
			}
		}
		$counthr = count($hr);
		if ($counthr > 0) 
		{
			if ($countorte > 0) echo " (";
			for ($z=0;$z<$counthr;$z++) 
			{
				if ($z > 0 && $counthr > 1)
				 echo ", ";
				$s = "echo \$_"."$hr[$z];";
				eval($s);	
			}
			if ($countorte > 0) echo ")";
		}
		//zielorte auslesen ende
		
			echo "<br>";
			echo "strassenname: $trampstelle->strassennamen";
			echo "<br>";
			
			//kommentare auslesen anfang
			
			
				$kommentare = $trampstelle->getKommentare();
				$count = count($kommentare);
				if ($count==0) echo "<tr><td>---</td></tr>";
				else
				{
					for ($a=0;$a<$count;$a++)
					{?>
						<tr>
						 <td>						   <span class="Stil2" >
<?= nl2br($kommentare[$a]->beschreibung)?>								
<br> </span> 
								<span class="Stil6">
									<?= $kommentare[$a]->absender;?>
									<?= $kommentare[$a]->datum;?><p>								
							</span>
						</td>
						</tr>
							<?
					}
				}
					 ?><?
							//kommentare auslesen ende

			echo "<p><hr>";
			
			} 
*/



define('FPDF_FONTPATH','font/');
include("fpdf/fpdf.php");

$pdf=new FPDF('P','mm','A5');
foreach ($trampstellen as $trampstelle)
			{	
			$startort = $trampstelle->getStartort();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',14);
			$bewertung=$trampstelle->getBewertung();
			$pdf->Cell(150,10,$startort->name,1,1);
			$pdf->SetFont('Arial','I',12);
			$pdf->Cell(40,10,$startort->land,0,1);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(40,10,$trampstelle->bezeichnung,0,1);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(40,10,$trampstelle->getBewertung(),0,1);
			
			$zielorte = $trampstelle->getZielorte();
			$orte = array();
			$hr = array();
			foreach($zielorte as $ort) 
			{
				if ($ort->land =="-")
				{
					$hr[] = $ort->name;
				}
			else
				{
					$orte[] = $ort->name;  //." (".$ort->land.")";
				}
			}
			$countorte = count($orte);
			if ($countorte > 0) 
				{
					for ($x=0;$x<$countorte;$x++) 
					{
						if ($x > 0 && $countorte > 1)
					$zielorte = ", ";
				$zielorte .= $orte[$x];
			}
		}
		$counthr = count($hr);
		if ($counthr > 0) 
		{
			if ($countorte > 0) 
				{
				$zielorte .= " (";
				}
			for ($z=0;$z<$counthr;$z++) 
			{
				if ($z > 0 && $counthr > 1)
				 $zielorte .= ", ";
				
				$zielorte .= $hr[$z];
					
			}
			if ($countorte > 0)
			{
			$zielorte .= ")";
			} 
		}
		//zielorte auslesen ende
			
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(40,10,$zielorte,0,1);
			
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(40,10,$trampstelle->strassennamen,0,1);
			
			
			//kommentare auslesen anfang
			
			
				$kommentare = $trampstelle->getKommentare();
				$count = count($kommentare);
				
					for ($a=0;$a<$count;$a++)
					{
						 
						 $kommentar = nl2br($kommentare[$a]->beschreibung);
							$kommentar .= "<br>";								
							
									
									$kommentar .= $kommentare[$a]->absender;
									
									
									$kommentar .= $kommentare[$a]->datum;
									$kommentar .= "<p>";
									$pdf->SetFont('Arial','',10);
									$pdf->MultiCell(150,5,$kommentar);
																
							
							
					}
				
					 
							//kommentare auslesen ende
			
			
			
			
			
			
			
			}

$pdf->Output();

?>