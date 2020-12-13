<?php
include("or-ortsdatenbank.php");
include("languages/language.php");
include("utils/utils.php");

$abfrage = false;
if (isset($_GET['abfrage'])) {
    $abfrage = $_GET['abfrage'];
}

$db = new DB();

include ("include/inc_oben.php");
include ("include/inc_header.php");
?>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="get" name="myform" id="myform" onSubmit="send(true)">
    <br>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="50%" align="center" valign="middle">
                            <table width="220" border="0" cellpadding="0" cellspacing="0" bgcolor="#0677BD">
                                <tr>
                                    <td width="5" height="5" align="left" valign="top"><img src="bilder/corner2.gif"
                                                                                            width="3" height="3"/></td>
                                    <td width="150" height="5"></td>
                                    <td width="5" height="5" align="right" valign="top"><img src="bilder/corner.gif"
                                                                                             alt="" width="3"
                                                                                             height="3"/></td>
                                </tr>
                                <tr>
                                    <td height="40" colspan="3" bgcolor="#0677BD">
                                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellpadding="4" cellspacing="0">
                                                        <tr>
                                                            <td height="50" align="center" bgcolor="#E1F3FD"
                                                                class="textEintrag"><?=@$_titel_neu?>                  </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="50" align="center" bgcolor="#E1F3FD"><a
                                                                    href="neue_trampstelle.php?LANG=<?=@$LANG?>"
                                                                    class="KommentarLink">
                                                                <?=@$_link_index_neu_sub?>
                                                            </a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5" height="5" align="left" valign="bottom"><img src="bilder/corner3.gif"
                                                                                               alt="" width="3"
                                                                                               height="3"/></td>
                                    <td width="150" height="5"></td>
                                    <td width="5" height="5" align="right" valign="bottom"><img src="bilder/corner4.gif"
                                                                                                alt="" width="3"
                                                                                                height="3"/></td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%" align="center" valign="middle">
                            <table width="220" border="0" cellpadding="0" cellspacing="0" bgcolor="#aad037">
                                <tr>
                                    <td width="5" height="5" align="left" valign="top"><img src="bilder/corner2.gif"
                                                                                            width="3" height="3"/></td>
                                    <td width="150" height="5"></td>
                                    <td width="5" height="5" align="right" valign="top"><img src="bilder/corner.gif"
                                                                                             alt="" width="3"
                                                                                             height="3"/></td>
                                </tr>
                                <tr>
                                    <td height="40" colspan="3" bgcolor="#AAD037">
                                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellpadding="4" cellspacing="0">
                                                        <tr>
                                                            <td height="50" align="center" bgcolor="#F1FEE7"><span
                                                                    class="textSearchTitle">
                      <?=@$_ortssuche?>
                    </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="50" align="center" bgcolor="#F1FEE7"><a
                                                                    href="suche.php?LANG=<?=@$LANG?>"
                                                                    class="KommentarLink">
                                                                <?=@$_titel_suche?>
                                                            </a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5" height="5" align="left" valign="bottom"><img src="bilder/corner3.gif"
                                                                                               alt="" width="3"
                                                                                               height="3"/></td>
                                    <td width="150" height="5"></td>
                                    <td width="5" height="5" align="right" valign="bottom"><img src="bilder/corner4.gif"
                                                                                                alt="" width="3"
                                                                                                height="3"/></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
                <br>
                <?php
                    include("include/inc_suche_laender.php");
                ?>
                <span class="unvisible"><?=$_what_is_hitchbase_desc ?></span> <br>

</form>
<?php
include("include/inc_copyright.php");
include ("include/inc_unten.php");
?>