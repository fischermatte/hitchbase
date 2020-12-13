<?php
session_start();
include ("or-ortsdatenbank.php");
include ("languages/language.php");
include ("utils/utils.php");

if (!isset($_GET['t_id'])){
    die("missing parameter");
} else {
    $t_id = $_GET['t_id'];
}

if (!isset($_SESSION['kommentar'.'_'.$t_id])) {
    die ("<br>Fehler: Es wurden keine Parameter übergeben.<br>");
} else {
    $kommentar =$_SESSION['kommentar'.'_'.$t_id];
}
$db = new DB();
$SP_TITEL = "Hitchbase - " . $_headline_kommentar;
include("include/inc_oben.php");
include("include/inc_header.php");
?>
<br xmlns="http://www.w3.org/1999/html">
<? showHeaderTable("Eintrag", $_kommentar . " - " . $_zusammenfassung, "500"); ?><br>
<form action="neuer_kommentar_controller.php" method="post" name="form1">
    <input name="t_id" type="hidden" id="t_id" value="<?=$t_id?>"></td>
    <table width="650px" align="center" border="0" cellspacing="0" cellpadding="1">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
                    <tr bgcolor="#FFFFFF">
                        <td colspan="2" align="right" valign="top" nowrap class="bgColor9">&nbsp;</td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                        <td align="left" valign="top" nowrap class="bgColor6" style="width:20%;padding-right:10px;">
                            <span class="neuerEintragTitle">
                                <?=@$_deinKommentar?>
                            </span>
                        </td>
                        <td align="left" class="bgColor6">
                            <span class="Stil2">
                                <?=nl2br(stripslashes(htmlentities($kommentar['beschreibung'])))?>
                            </span>
                        </td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                        <td align="left" nowrap class="bgColor6" style="width:20%;padding-right:10px;">
                            <span class="neuerEintragTitle">
                                <?=@$_deineBewertung?>
                            </span>
                        </td>
                        <td align="left" class="bgColor6">
                            <span class="Stil2">
                            <?
                                showBewertung($kommentar['bewertung'], $_bewertung_0, $_bewertung_1, $_bewertung_2, $_bewertung_3);
                            ?>
                            </span>
                        </td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                        <td align="left" nowrap class="bgColor6" style="width:20%;padding-right:10px;">
                            <span class="neuerEintragTitle">
                              <?=@$_deineEmail?>
                            </span>
                        </td>
                        <td align="left" class="bgColor6">
                            <span class="Stil2">
                                <?=stripslashes($kommentar['absender'])?>
                            </span>
                        </td>
                    </tr>
                    <!--captcha begin-->

                    <tr bgcolor="#FFFFFF">
                        <td align="left" class="bgColor6" style="width:20%;padding-right:10px;">
                            <img id="captcha" src="securimage/securimage_show_example.php" alt="CAPTCHA Image" />
                            <a style="text-decoration: none;color: #003366; font-size: 12px;" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show_example.php?' + Math.random(); return false">[ Reload ]</a>
                        </td>
                        <td align="left" nowrap class="bgColor6">
                            <?php
                                if (isset($_GET['invalidCaptchaCode'])){
                                    ?>
                                    <span class="FormularFehler" style="display:block"> wrong code</span>
                                    <?php
                                }
                            ?>
                                <input type="text" id="captcha_code" name="captcha_code"> </input>
                        </td>
                    </tr>

                    <!--captcha end-->


                    <tr align="center" valign="middle" bgcolor="#FFFFFF" class="bgColor9">
                        <td colspan="2" nowrap><input name="reset2" type="button" id="reset2" value=" <?= @$_zurueck ?>"
                                                      onClick="history.back();"> <input name="submit" type="submit" id="submit"
                                                                                        value="<?= @$_weiter ?>"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<?php
include("include/inc_copyright.php");
include("include/inc_unten.php");
?>
