<?php
    session_start();

    if (!isset($_POST['t_id'])){
        die("missing parameter");
    } else {
        $t_id = $_POST['t_id'];
    }

    if (!isset($_SESSION['kommentar'.'_'.$t_id])){
        die ("<br>Fehler: Es wurden keine Parameter übergeben.<br>");
    }
    $kommentar = $_SESSION['kommentar'.'_'.$t_id];
    // check the captcha
    include("securimage/securimage.php");
    $securimage = new Securimage();
    if ($securimage->check($_POST['captcha_code']) == false) {
        $redirect = "neuer_kommentar_check.php?invalidCaptchaCode=true&t_id=".$t_id;
        header("Location: ".$redirect);
    } else {
        include ("or-ortsdatenbank.php");
        $db = new DB();

        $k = Kommentar::create($kommentar);
        if (is_object($k)){
            $_SESSION['kommentar'.'_'.$t_id] = null;
            header("Location: ergebnisse.php?t_id=".$k->t_id_fk."&success=1&type=Kommentar");
        } else {
            header("Location: ergebnisse.php?t_id=".$k->t_id_fk."&success=0");
        }
    }

?>