<script language="javascript" src="utils/utils.js"></script>
<span class="unvisible"><?=$_what_is_hitchbase_desc ?></span>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right" valign="bottom" nowrap><a href="index.php?LANG=<?=@$LANG?>"
                                                                 class="header_title"> </a><a class="header_title"
                                                                                             href="index.php?LANG=<?=@$LANG?>"> </a>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="618" align="left" valign="middle" class="header_title"><a
                                        class="header_title" href="index.php?LANG=<?=@$LANG?>"> </a>
                                    <table width="100%" border="0" cellpadding="6" cellspacing="0">
                                        <tr>
                                            <td width="153"><a href="index.php?LANG=<?=@$LANG?>"><img
                                                    src="bilder/hitchbase.png" alt="Hitchbase" width="153" height="22"
                                                    border="0"/></a></td>
                                            <td width="63%" valign="bottom" class="header_title2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?=$_titel_index_1?>

                                                <?=$_titel_index_2?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <td width="163" align="right" valign="bottom">
                                    <a href="<? echo getLanguageLink($_SERVER['QUERY_STRING'],$_SERVER['PHP_SELF']);  ?>LANG=eng" class="<?= getLanguageStil("eng",$LANG);?>">eng</a>
                                    <a href="<? echo getLanguageLink($_SERVER['QUERY_STRING'],$_SERVER['PHP_SELF']);  ?>LANG=ger" class="<?= getLanguageStil("ger",$LANG);?>">deu</a>
                                    <a href="<? echo getLanguageLink($_SERVER['QUERY_STRING'],$_SERVER['PHP_SELF']);  ?>LANG=rus" class="<?= getLanguageStil("rus",$LANG);?>">rus</a>
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="right">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="1" colspan="3" align="left"><img src="bilder/spacer.gif" width="400" height="1"></td>
                </tr>
                <tr>
                    <td width="5" height="25" align="left" valign="top" bgcolor="#0277BD" class="header_link1"><img
                            src="bilder/corner2.gif" alt="" width="3" height="3"/></td>
                    <td align="left" bgcolor="#0277BD" class="header_link1">&nbsp; | &nbsp;<a
                            href="index.php?LANG=<?=@$LANG?>" class="header_link1">
                        <?=$_home ?>
                    </a>&nbsp; | &nbsp;<a href="suche.php?LANG=<?=@$LANG?>" class="header_link1">
                        <?=$_headline_suche ?>
                    </a>&nbsp; | &nbsp;<a href="neue_trampstelle.php?LANG=<?=@$LANG?>" class="header_link1">
                        <?=$_neuer_eintrag?>
                    </a> &nbsp; | &nbsp;<a href="about.php?LANG=<?=@$LANG?>" class="header_link1">
                        <?=$_about?>
                    </a> &nbsp; |
                    </td>
                    <td align="right" valign="top" bgcolor="#0277BD" class="header_link1"><img
                            src="bilder/corner.gif" width="3" height="3"/></td>
                </tr>
                <tr>
                    <td width="5" height="25" align="left" valign="top" bgcolor="#E6E6E6" class="header_link1">
                        &nbsp;</td>
                    <td colspan="2" align="right" valign="bottom" bgcolor="#E6E6E6">
                        <table width="100" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="middle" nowrap="nowrap" class="Stil2">
                                    <?=@$_abgefahren_1?>            </td>
                                <td><a href="http://www.abgefahren.hitchbase.com"><img
                                        src="bilder/abgefahren_ev_3.png" alt="Abgefahren e.V." width="117"
                                        height="20" hspace="3" vspace="3" border="0"/></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

