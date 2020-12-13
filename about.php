<?php

include ("utils/utils.php");
include ("languages/language.php");
$SP_TITEL = "Hitchbase - ".@$_about;
include("include/inc_oben.php");
include("include/inc_header.php");

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="40">
            <hr size="1">
        </td>
    </tr>
    <tr>
        <td>
            <table width="550" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top">
                        <table width="100%" height="100%" border="0" cellpadding="10" cellspacing="0">
                            <tr>
                                <td width="140" align="left" valign="top"><span class="WhatIsHitchbase"><span
                                        class="WhatIsHitchbaseDesc"><img src="bilder/grit_daume.gif" width="138" height="125" align="left"></span></span>
                                </td>
                                <td align="left" valign="top"><span class="WhatIsHitchbase"></span>
                                    <table width="100%" border="0" cellpadding="4" cellspacing="0">
                                        <tr>
                                            <td width="52%" colspan="2" class="WhatIsHitchbase"><span class="WhatIsHitchbaseDesc"> </span>
                                                <?=@$_what_is_hitchbase?>                      </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><span class="WhatIsHitchbaseDesc">
                        <?=@$_what_is_hitchbase_desc?>
                      </span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><span class="WhatIsHitchbaseSlogan">
                        <?=@$_what_is_hitchbase_slogan?>
                      </span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="50">
            <hr size="1">
        </td>
    </tr>
    <tr>
        <td>
            <table width="550" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="42%" align="left" valign="top"><a href="http://www.abgefahren.hitchbase.com"><img
                            src="bilder/abgefahren_ev_2.png" alt="Abgefahren e.V." width="233" height="40" border="0"/></a></td>
                    <td width="58%" align="left" valign="top" class="WhatIsHitchbaseDesc">
                        <table width="100%" border="0" cellpadding="7" cellspacing="0">
                            <tr>
                                <td width="1"></td>
                                <td><?=@$_abgefahren_1?>
                                    <a href="http://www.abgefahren.hitchbase.com" class="style1">Abgefahren e.V.</a>
                                    <?=@$_abgefahren_2?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="50">
            <hr size="1">
        </td>
    </tr>
    <tr>
        <td>
            <table width="550" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="left" valign="top">
                        <table width="466" border="0" cellpadding="0" cellspacing="0">
                            <tr align="left" valign="middle">
                                <td width="20" height="40" class="WhatIsHitchbase">&nbsp;</td>
                                <td width="257" height="40" class="WhatIsHitchbase"><?=$_contact?></td>
                                <td width="189" height="40" class="WhatIsHitchbase">&nbsp;</td>
                            </tr>
                            <tr align="left" valign="top">
                                <td width="20" height="30">&nbsp;</td>
                                <td width="257" height="30" valign="middle" nowrap><span
                                        class="Stil2">Markus Bergmann &amp; Georg Ludewig</span></td>
                                <td height="30" valign="middle">hitchbase@gmail.com</td>
                            </tr>
                            <tr align="left" valign="top">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="50">
            <hr size="1">
        </td>
    </tr>
</table>
<br>
</p>
<?php
include("include/inc_copyright.php");
include ("include/inc_unten.php");
?>

