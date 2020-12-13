<?
session_start();
include('or-ortsdatenbank.php');
include ("languages/language.php");
include ("utils/utils.php");
$db = new DB();
if (isset($_GET['abfrage']))
    $abfrage = $_GET['abfrage'];
else {
    $abfrage['startort'] = -1;
    $abfrage['zielort'] = -1;
    $abfrage['startland'] = -1;
    $abfrage['zielland'] = -1;
}

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$proseite = 10;
$start = (($page * $proseite) - $proseite);
$limit = $start . "," . $proseite;

include("include/inc_oben.php");
include("include/inc_header.php");
?>

<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="10">
        </td>
    </tr>
    <tr>
        <td>
            <a href="suche.php?LANG=<?=$LANG?>" class="KommentarLink"><?=$_alleLaender?></a> <span class="KommentarLink">
		<?
            if ($abfrage['startort'] != "-1") {
                $ort = Ort::get2($abfrage['startort']);
                $land = Land::get($ort->land);
                ?>
                -> <a href="orte.php?LANG=<?=$LANG?>&l_id=<?=$land->l_id?>" class="KommentarLink"><?=$land->name?></a>
                -> <a href="ergebnisse.php?LANG=<?=$LANG?>&abfrage%5Bstartort%5D=<?=$ort->o_id?>&abfrage%5Bstartland%5D=<?=$ort->land?>"
                      class="KommentarLink"><?=stripslashes($ort->name)?></a>
                <?

            } else if ($abfrage['startland'] != "-1") {
                $land = Land::get($abfrage['startland']);
                ?>
                -> <a href="orte.php?LANG=<?=$LANG?>&l_id=<?=$land->l_id?>" class="KommentarLink"><?=$land->name?></a>
                <?
            }
            ?>
	</span></td>
    </tr>
    <tr>
        <td height="10"></td>
    </tr>
</table>

<?
//Falls eine Konkrete Trampstelle ausgegeben werden soll
if (isset($_GET['t_id'])) {
    if (isset($_GET['success'])) {
        if ($_GET['success'] == true) {

            $trampstelle = Trampstelle::GetTrampstelle($_GET['t_id']);
            $type = "Trampstelle";
            if (isset($_GET['type'])) $type = $_GET['type'];
            foreach (Administrator::alleAdmins() as $admin)
                $admin->SendNewEntry(getTrampstelleAsHTML($trampstelle), $type);
            include("include/inc_trampstelle.php");
        } else {
            ?>
        <table width="500" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td align="center" class="ergebnisseLinkRot">
                    <?
                    echo $f_5;
                    ?>
                </td>
            </tr>
        </table>

        <?
        }
    } else {
        $trampstelle = Trampstelle::GetTrampstelle($_GET['t_id']);
        include("include/inc_trampstelle.php");
    }
} else //alle Suchergebnisse anzeigen
{
    ?>
<?
    $trampstellen = Trampstelle::getTrampstellen(array('order' => 'oos.name',
        'condition_startort' => $abfrage['startort'],
        'condition_zielort' => @$abfrage['zielort'],
        'condition_zielland' => @$abfrage['zielland'],
        'condition_startland' => @$abfrage['startland'],
        'limit' => $limit));

    $tcount = DB::num_results();
    $tcountcurrent = count($trampstellen);

    if ($tcount == 0) {
        echo "<br> Kein Eintrag!";
    } else {
        ?>
    <table width="500" height="31" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="left" valign="middle" class="ergebnisseAnzahl">
                <?=$start + 1?>-<?=$start + $tcountcurrent?> of <?=$tcount?> Results
            </td>
        </tr>
    </table>

    <?
        //echo $trampstellen->t_id;
        foreach ($trampstellen as $trampstelle) {
            include("include/inc_trampstelle.php");
        } //Ende foreach schleife
        ?>


    <table width="500">
        <tr>
            <td align="left" class="pageAktiv">Result Page:&nbsp;
                <?
                $pages = ceil($tcount / $proseite);
                for ($y = 1; $y <= $pages; $y++) {
                    ?>
                    &nbsp;
                    <?
                    if ($page != $y) {
                        ?>
                        <a href="ergebnisse.php?LANG=<?= @$LANG . "&abfrage[startort]=" . @$abfrage['startort'] . "&abfrage[zielort]=" . @$abfrage['zielort'] . "&abfrage[startland]=" . @$abfrage['startland'] . "&abfrage[zielland]=" . @$abfrage['zielland'] . "&page=" . $y;?>"
                           class="pages"><?=$y?></a>
                        <?
                    } else {
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
    //Ende else (mehr als ein Eintrag)
}//Ende else 2


?>
<br>
<? include("include/inc_copyright.php"); ?>
<br>
<?php
include("include/inc_unten.php");
?>
