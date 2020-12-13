<?php


/* untersucht, ob ein Wert einen leeren String enthaelt, und wenn ja,
   setzt den Wert auf die Zeichenkette NULL und gibt den veraenderten 
   Wert zurueck (&$value ist Referenz auf Wert)
*/
function teste_auf_null(&$value)
{
    if (preg_match("/^\s*$/", $value)) {
        $value = 'NULL';
    }
}


/* Initiiert im Browser das Laden der durch den Parameter angegebenen Seite
   ($zielseite). Wird keine Seite angegeben, so erfolgt das laden der 
   zuletzt im Browser angezeigten Seite.
   Befindet sich das System im Debugmode ($debug=1), so erfolgt kein
   automatisches laden der Seite, sondern der Benutzer muss einen Link,
   der die URL der zu ladenden Seite traegt, anklicken (das ist nur bei der 
   Fehlersuche sinnvoll).
   Um das System in den Debugmode zu versetzen, muss innerhalb des letzten 
   Formulars ein Hidden Field mit dem Namen debug, den Wert 1 aufweisen.
*/
function weiterleitung($zielseite)
{
    GLOBAL $debug;
    GLOBAL $HTTP_REFERER;

    if (empty($zielseite))
        $zielseite = $HTTP_REFERER;
    if ($debug)
        print "weiter nach <a href=\"$zielseite\">$zielseite</a>";
    else
        header("location: $zielseite");
}

/* Zeigt, sofern sich das System im Debugmodus befindet, alle an diese 
   Seite uebergebenen Parameter an.
*/
function debug()
{

    GLOBAL $HTTP_POST_VARS;
    GLOBAL $_GET;
    GLOBAL $debug;

    if ($debug) {
        print "<b>&Uuml;bergebene Parameter:<p></b>\n";
        foreach ($HTTP_POST_VARS as $k => $v) {
            print "POST ";
            if (is_array($v)) {
                foreach ($v as $ek => $ev)
                    print "&nbsp; &nbsp;$k [$ek] : $ev<br>";
                print "<br>\n";
            } else {
                print "$k : $v<br>\n";
            }
        }

        foreach ($_GET as $k => $v) {
            print "GET ";
            if (is_array($v)) {
                foreach ($v as $ek => $ev)
                    print "&nbsp; &nbsp;$k [$ek] : $ev<br>";
                print "<br>\n";
            } else {
                print "$k : $v<br>\n";
            }
        }
    }
}

function check_eintrag($trampstelle)
{
    global $fehler;
    $valid = true;

    if (trim($trampstelle['startort']) == "" || strlen(trim($trampstelle['startort'])) < 2) {
        $valid = false;
        $fehler['startort'] = false;
    }
    if (trim($trampstelle['land']) == "-1") {
        $valid = false;
        $fehler['land'] = false;
    }
    if (trim($trampstelle['zielorte']) == "" && !isset($trampstelle['hr'])) {
        $valid = false;
        $fehler['zielorte'] = false;
    }
    if (trim($trampstelle['beschreibung']) == "") {
        $valid = false;
        $fehler['beschreibung'] = false;
    }
    if (!isset($trampstelle['bewertung'])) {
        $valid = false;
        $fehler['bewertung'] = false;
    }
    $fehler['alles'] = $valid;
    return $valid;
}

function check_kommentar($trampstelle)
{
    global $fehler;
    $valid = true;

    /*if (trim($trampstelle['beschreibung']) =="")
    {
        $valid = false;
        $fehler['beschreibung'] = false;
    }*/
    if (!isset($trampstelle['bewertung'])) {
        $valid = false;
        $fehler['bewertung'] = false;
    }
    $fehler['alles'] = $valid;
    return $valid;
}

function filterArray($zielorte)
{
    $zielorte_string = Array();
    $zielorte_array = Array();
    for ($x = 0; $x < sizeof($zielorte); $x++) {
        if (!empty($zielorte[$x]['ort'])) {
            $zielorte_string[] = $zielorte[$x]['ort'] . "," . $zielorte[$x]['land'];

        }
    }
    if (count($zielorte_string) > 0)
        $zielorte_string = array_unique($zielorte_string);

    for ($x = 0; $x < count($zielorte_string); $x++) {
        $zielorte_array[] = explode(",", $zielorte_string[$x]);
    }
    return $zielorte_array;

}

function showBewertung($bewertung, $_bewertung_0, $_bewertung_1, $_bewertung_2, $_bewertung_3)
{

    switch ($bewertung) {
        case "0":
            echo $_bewertung_0 . " ";
            break;
        case "1":
            echo $_bewertung_1 . " ";
            break;
        case "2":
            echo $_bewertung_2 . " ";
            break;
        case "3":
            echo $_bewertung_3 . " ";
            break;
    }

    if ($bewertung == "0") {
        echo "<img src=\"bilder/hand2.gif\" width=\"10\" height=\"14\" hspace=\"1\" vspace=\"1\">";
    } else {
        for ($i = 1; $i <= $bewertung; $i++)
            echo "<img src=\"bilder/hand.gif\" width=\"10\" height=\"14\" hspace=\"1\" vspace=\"1\">";
    }


}

function cutAtEnd($name, $pos = 15)
{
    $count = strlen($name);
    if ($count < $pos)
        $name_neu = $name;
    else
        $name_neu = substr($name, 0, $pos) . "...";
    return $name_neu;


}

function getLanguageStil($Lang, $activeLang)
{
    if ($Lang == $activeLang){
        return "LanguageLinkAktiv";
    }
    else {
        return "LanguageLink";
    }
}

function isValidEntry($trampstelle)
{
    return true;
}

function getTrampstelleAsHTML($trampstelle)
{

    $message = "<html><style type=\"text/css\">
.FormularFehler {
	color: #FF0000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Stil2 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
}
.Stil5 {	font-size: 12px;
	font-weight: normal;
	font-family: Arial, Helvetica, sans-serif;
}
.Stil6 {	font-size: 12px;
	font-style: italic;
	font-family: Arial, Helvetica, sans-serif;
}.header_title {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	font-variant: normal;
	color: #FFFFFF;
	text-decoration: none;
}
.header_title2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	color: #F7E773;
	text-decoration: none;
}
.Stil8 
{
	font-size: 10px
}
.LanguageLink {
font-size: 10px; font-variant: normal; color: #FFFFFF; text-decoration: none; font-family: Arial, Helvetica, sans-serif;
}
.Stil7 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
}
.Stil12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
}
.LanguageLinkAktiv {
	font-size: 10px;
	font-variant: normal;
	color: #FFFF00;
	text-decoration: none;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.header_link1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	text-decoration: none;
	padding: 1px;
}
.ergebnisseAbfahrtsort {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
.backgroundcolor1 {
	background-color: #F5F5F5;
	font-weight: normal;
}
.backgroundcolor2 {

	background-color: #EEEEEE;
	font-weight: normal;
}
.backgroundcolor3 {


	background-color: #666666;
	font-weight: normal;
}
.ergebnisseLink {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
}
.neuerEintragTitle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
}
.header_link2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #1E528C;
	text-decoration: none;
	padding: 1px;
	font-weight: bold;
}
.ergebnisseLinkRot {

	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
	text-decoration: none;
}
.pages {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #003399;
	text-decoration: underline;
	font-weight: bold;
}
.pageAktiv {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
	text-decoration: none;
}
.ergebnisseAnzahl {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #0066CC;
	text-decoration: none;
	padding-bottom: 2px;
}
.copyright {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #CCCCCC;
	text-decoration: none;
}

</style>";
    $message .= "<body>
<a href=\"http://www.hitchbase.com/ergebnisse.php?t_id=" . $trampstelle->t_id . "\">http://www.odb.trampstop.de/ergebnisse.php?t_id=" . $trampstelle->t_id . "</a> <br><br>
<table width=\"450\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" class=\"backgroundcolor3\">
	  <tr>
		<td bgcolor=\"#FFFFFF\">    <table width=\"450\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\" class=\"backgroundcolor2\">
		  <tr align=\"right\" valign=\"top\">
			<td align=\"left\" nowrap >
			  <table width=\"450\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\">
				<tr align=\"left\" valign=\"baseline\">
				  <td width=\"7%\" nowrap class=\"ergebnisseAbfahrtsort\" >";
    $startort = $trampstelle->getStartort();
    $message .= $startort->name;
    $message .= "  <span class=\"ergebniss_startland\"> </span></td>
				  <td width=\"93%\" class=\"Stil7\" >					" . $startort->land . "				  </td>
				</tr>
			  </table>          </td>
		  </tr>
		  <tr align=\"right\" valign=\"top\">
			<td align=\"left\" nowrap ><table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\">
			  <tr align=\"left\">
				<td nowrap class=\"Stil2\" >" . $trampstelle->bezeichnung . "</td>
				<td align=\"right\" nowrap ><span class=\"ergebniss_startland\"><span class=\"Stil2\">";

    $message .= " Bewertung: " . $trampstelle->getBewertung();
    $message .= "</span></span></td>
			  </tr>
			</table></td>
		  </tr>
		</table>      </td>
	  </tr>
	  <tr>
		<td bgcolor=\"#FFFFFF\"><table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" class=\"backgroundcolor2\">
			<tr align=\"right\">
			  <td width=\"5%\" align=\"left\" nowrap class=\"Stil2\" >Richtung: </td>
			  <td align=\"left\" class=\"Stil2\"> &nbsp;&nbsp;";

    $zielorte = $trampstelle->getZielorte();
    $orte = array();
    $hr = array();
    foreach ($zielorte as $ort) {
        if ($ort->land == "-") {
            $hr[] = $ort->name;
        } else {
            $orte[] = $ort->name; //." (\".$ort->land.")";
        }
    }
    $countorte = count($orte);
    if ($countorte > 0) {
        for ($x = 0; $x < $countorte; $x++) {
            if ($x > 0 && $countorte > 1)
                $message .= ", ";
            $message .= $orte[$x];
        }
    }
    $counthr = count($hr);
    if ($counthr > 0) {
        if ($countorte > 0) $message .= " (";
        for ($z = 0; $z < $counthr; $z++) {
            if ($z > 0 && $counthr > 1)
                $message .= ", ";
            $message .= $hr[$z];

        }
        if ($countorte > 0) $message .= ") ";
    }

    $message .= $trampstelle->strassennamen;
    $message .= " </td>   </tr>	  </table></td>  </tr>	  <tr>		<td align=\"left\" bgcolor=\"#FFFFFF\">      <SPAN class=\"Stil5\" >    </SPAN>
		  <table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" class=\"backgroundcolor1\">";
    $kommentare = $trampstelle->getKommentare();
    $count = count($kommentare);
    if ($count == 0) $message .= "<tr><td>---</td></tr>";
    else {
        for ($a = 0; $a < $count; $a++) {
            $message .= "<tr> <td> <span class=\"Stil2\" >" .
                $kommentare[$a]->beschreibung . "
<br> </span> 
								<span class=\"Stil6\">" . $kommentare[$a]->absender . " " . $kommentare[$a]->datum . "
							</span>
						</td>
						</tr>";
        }
    }
    $message .= "
		  </table>      </td>
	  </tr>
	  <tr>
		<td align=\"right\" bgcolor=\"#FFFFFF\" class=\"Stil2\"><table width=\"100%\"  border=\"0\" cellpadding=\"3\" cellspacing=\"0\" class=\"backgroundcolor2\">
          <tr>
            <td align=\"right\">&nbsp;			
						</td>
          </tr>
        </table>		  </td>
	  </tr>
  </table></body></html>";
    return $message;
}

function showHeaderTable($Mode, $Title)
{
    echo "<table width=\"100%\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin-top:10px;margin-bottom:10px;\">";
    echo "<tr>";
    echo "<td width=\"30\" align=\"center\" valign=\"top\" ";
    if ($Mode == "Suche")
        echo "class=\"bgColor9\"><img src=\"bilder/suche.gif\" width=\"30\" height=\"50\"></td>";
    else
        echo "class=\"backgroundcolor3\"><img src=\"bilder/eintrag.gif\" width=\"30\" height=\"50\"></td>";

    echo "<td align=\"center\" valign=\"middle\" ";
    if ($Mode == "Suche") {
        echo "class=\"rahmenSuche\">";
        echo "<span class=\"textSearchTitle\">";
    } else {
        echo "class=\"rahmenEintrag\">";
        echo "<span class=\"textEintrag\">";
    }
    echo "$Title";
    echo "</span></td>";
    echo "<td width=\"30\" align=\"center\" valign=\"middle\" ";
    if ($Mode == "Suche")
        echo "class=\"bgColor9\"   ><img src=\"bilder/suche2.gif\" ";
    else
        echo "class=\"backgroundcolor3\"   ><img src=\"bilder/eintrag2.gif\" ";
    echo "width=\"30\" height=\"50\"></td>";
    echo "</tr>";
    echo "</table>";
}

function utlShowLand($land, $LANG)
{
    echo "<link href=\"ortsdatenbank.css\" rel=\"stylesheet\" type=\"text/css\">";

    echo "<td width=\"33%\" bgcolor=\"#F1FEE7\">";
    if ($land != "") {
        echo"<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
					  <tr>
					<td width=\"100%\">";
        echo "<a href=\"orte.php?LANG=" . @$LANG . "&l_id=" . $land->l_id . "\" class=\"KommentarLink\">" . $land->name . "</a>";
        echo "</td>
					<td align=\"left\" class=\"KommentarLink\">";
        echo $land->anzahltrampstellen;
        echo "</td> </tr></table>";
    }
    echo "</td>";
}

function utlShowOrt($ort, $LANG)
{
    echo "<link href=\"ortsdatenbank.css\" rel=\"stylesheet\" type=\"text/css\">
	<td width=\"33%\" bgcolor=\"#F1FEE7\">";
    if ($ort != "") {
        echo "<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\" bgcolor=\"#F1FEE7\">
					  <tr>
					<td width=\"100%\">
						<a href=\"ergebnisse.php?LANG=" . @$LANG . "&abfrage%5Bstartort%5D=" . $ort->o_id . "\" class=\"KommentarLink\">";
        echo stripslashes($ort->name);
        echo "</a>";
        echo "</td>
					<td align=\"left\" class=\"KommentarLink\">";
        echo $ort->anzahltrampstellen;
        echo "</td> </tr></table>";
    }
    echo "</td>";
}

?>