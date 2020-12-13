<?
if ($utilsincl == false)
	include ("utils.php");
include ("languages/language.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Hitchbase - <?=@$_about?></title>
<link href="../ortsdatenbank.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../utils.js"></script>
</head>

<body align ="left" leftmargin="8" topmargin="0"> 
 <? include("inc_header.php");?>
<table width="700" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40"><hr size="1"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="6" cellspacing="0">
                <tr>
                  <td width="140" align="center" valign="top"><span class="WhatIsHitchbase"><span class="WhatIsHitchbaseDesc"></span></span><a href="hitchbase_13_08_06.pdf"><img src="../bilder/PDF_icon_small.gif" alt="pdf" width="50" height="50" border="0"></a></td>
                  <td align="left" valign="top"><span class="WhatIsHitchbase"></span>
                      <table width="100%" border="0" cellpadding="4" cellspacing="0">
                        <tr>
                          <td width="52%" ><span class="WhatIsHitchbaseDesc"> </span> <a href="hitchbase_13_08_06.pdf" class="pages">hitchbase_13_08_06.pdf</a>*<br>
                              <p class="WhatIsHitchbaseSlogan">*This is compiled with LaTeX. <br>
                            You can find the compile file <a href="../data2tex.php">here</a>.</p></td>
                        </tr>
                        <tr>
                          <td><span class="WhatIsHitchbaseDesc"> </span></td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="0" align="center" valign="middle"><hr size="1"></td>
      </tr>
    </table></td>
  </tr>
</table>
<p><br>
  </td>
  </tr>
  </table>
  <br>
   <br>
   <br>
</p>
<? include("inc_copyright.php");?>
 
</body>
</html>
