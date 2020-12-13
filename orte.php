<?
include('or-ortsdatenbank.php');
include ("languages/language.php");
include('utils/utils.php');
$db = new DB();

include("include/inc_oben.php");
include("include/inc_header.php");

$l_id = $_GET['l_id'];

?>

<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="10">
        </td>
    </tr>
    <tr>
        <td><a href="suche.php?LANG=<?=$LANG?>" class="KommentarLink"><?=$_alleLaender?></a> <span class="KommentarLink">
	<?
            $land = Land::get($l_id);?>
            -> <a href="orte.php?LANG=<?=$LANG?>&l_id=<?=$land->l_id?>" class="KommentarLink"><?=$land->name?></a>
            <?
            ?>
	</span></td>
    </tr>
    <tr>
        <td height="10"></td>
    </tr>
</table>
<div style="background-color: #aad037;margin:10px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#aad037">
        <tr>
            <td align="left" valign="middle">
                <table width="100%" border="0" cellpadding="0" cellspacing="1">
                    <?
                    $orte = Ort::alleStartorteSimple(array('order' => 'name', 'condition_startland' => $l_id));
                    $count = count($orte);
                    //echo $count;
                    $eachcolumn = ceil(($count / 3));

                    //echo $rows;
                    for ($i = 0; $i < $eachcolumn; $i++) {
                        $ort1 = $orte[$i];
                        $ort2 = null;
                        if (($i + $eachcolumn) < $count)
                            $ort2 = $orte[$i + $eachcolumn];
                        $ort3 = null;
                        if (($i + (2 * $eachcolumn)) < $count)
                            $ort3 = $orte[$i + (2 * $eachcolumn)];

                        ?>
                        <tr>
                            <?
                            utlShowOrt($ort1, $LANG);
                            utlShowOrt($ort2, $LANG);
                            utlShowOrt($ort3, $LANG);
                            ?>
                        </tr>
                        <?
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>
<?php
include("include/inc_copyright.php");
include("include/inc_unten.php");
?>
