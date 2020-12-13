<?
    session_start();
    include ("or-ortsdatenbank.php");
    $db = new DB();
	$trampstelle = $_SESSION['trampstelle'];


    //Retrieve the value of the hidden field
    $form_secret = isset($_POST["form_secret"])?$_POST["form_secret"]:'';

    if(isset($trampstelle) && isset($_SESSION["FORM_SECRET"])) {
        if(strcasecmp($form_secret, $_SESSION["FORM_SECRET"]) === 0) {
            $ts = Trampstelle::create($trampstelle);
            if (is_object($ts)) {
                $zielseite = $_POST['zielseite']."&t_id=$ts->t_id&success=1&type=Trampstelle";
            }
            else {
                $zielseite = $_POST['zielseite']."&t_id=$ts->t_id&success=0";
            }
            unset($_SESSION['trampstelle']);
            unset($_SESSION["FORM_SECRET"]);
            header("Location: ".$zielseite);

        }else {
            //Invalid secret key
        }
    } else {
        // Falls der Eitnrag schon mal erledigt worden ist
        $zielseite = $_POST['zielseite']."&t_id=&success=0";
        header("Location: ".$zielseite);
    }

?>