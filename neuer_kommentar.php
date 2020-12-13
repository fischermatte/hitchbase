<?php
session_start();
$fehler = Array("beschreibung" => true, "bewertung" => true);


if (!isset($tid) && isset($_GET['t_id'])) {
    $tid = $_GET['t_id'];
} elseif (!isset($tid) && isset($_POST['t_id'])) {
    $tid = $_POST['t_id'];

}

include ('utils/utils.php');
if (isset($_POST['kommentar'])) {
    $valid = check_kommentar($_POST['kommentar']);
    if ($valid) {
        $_SESSION['kommentar'.'_'.$tid] = $_POST['kommentar'];
        header("Location: neuer_kommentar_check.php?"."t_id=".$tid);
    } else {
        $kommentar = $_POST['kommentar'];
        $tid = $kommentar['t_id_fk'];
    }
} else {
    if (isset($_SESSION['kommentar'.'_'.$tid])){
        $kommentar = $_SESSION['kommentar'.'_'.$tid];
    } else {
        $kommentar = null;
    }
}
if (!isset($valid) || $valid == false ){
    include("include/inc_neuer_kommentar.php");
}