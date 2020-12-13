<?php

    session_start();

    include ("languages/language.php");
    include ("utils/utils.php");

    if (isset($_POST['trampstelle'])) {
        $trampstelle = $_POST['trampstelle'];
    } elseif (isset($_SESSION['trampstelle'])) {
        $trampstelle = $_SESSION['trampstelle'];
    } else {
        die ("<br>Fehler: Es wurden keine Parameter übergeben.<br>");
    }

    if (!isset($_SESSION['FORM_SECRET'])) {
        header("Location: neue_trampstelle.php");
    } else {
        $form_secret = $_SESSION['FORM_SECRET'];
        include('or-ortsdatenbank.php');
        $db = new DB();
        $SP_TITEL = "Hitchbase - " . @$_neuer_eintrag;

        include ("include/inc_oben.php");
        include ("include/inc_header.php");

        // wenn bspw. himmelsrichtungen  angegeben sind und keine zielorte ist auch gut
        if (!isset($_POST['zielorte_mit_laendern']) && $trampstelle['zielorte'] != "") {
            showHeaderTable("Eintrag", $_zielorte_land);
            include("include/inc_neue_trampstelle_places.php");

        } else // Wenn Länder der Zielorte ausgewählt
        {
            showHeaderTable("Eintrag", $_neuer_eintrag . " - " . $_zusammenfassung);
            include("include/inc_neue_trampstelle_summary.php");
        }
        include("include/inc_copyright.php");
        include("include/inc_unten.php");
    }

    ?>


