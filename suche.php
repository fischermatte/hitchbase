<?
include('or-ortsdatenbank.php');
include ("languages/language.php");
include('utils/utils.php');
$db = new DB();

$SP_TITEL = "Hitchbase - ".@$_ortssuche . " - " . @$_titel_index_1 . " " . $_titel_index_2;
$abfrage = false;
if (isset($_GET['abfrage']))
    $abfrage = $_GET['abfrage'];
include("include/inc_oben.php");
include("include/inc_header.php");
?>


<form action="<?=$_SERVER['PHP_SELF'];?>" method="get" name="myform" id="myform">
    <? include("include/inc_suche.php");?>
    <? include("include/inc_suche_laender.php");?>
</form>


<?php
include("include/inc_copyright.php");
include("include/inc_unten.php");
?>
