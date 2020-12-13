<? 	
	include('or-ortsdatenbank.php'); 
	include ("languages/language.php");
	include('utils.php');
	$db = new DB();
	
	$abfrage = false;
	if (isset($_GET['abfrage'])) $abfrage = $_GET['abfrage'];
	
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Hitchbase - <?=$_titel_index_1." ".$_titel_index_2?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="ortsdatenbank.css" rel="stylesheet" type="text/css">

</head>

<body>        <form action="<?=$_SERVER['PHP_SELF'];?>" method="get" name="myform" id="myform">
  <? include ("inc_header.php")?>
<br>
 
  <table width="450" border="0" align="center" cellpadding="2" cellspacing="1" class="backgroundcolor3">
    <tr>
      <td height="30" align="center" valign="middle" class="bgColor4"   ><span class="neuerEintragTitle"> <?=@$_welcome?></span></td>
    </tr>
    <tr>
      <td align="center" valign="middle" class="bgColor5"   >
      <p class="Stil2"> <?=@$_welcometext?></p></td>
    </tr>
  </table>
  <br>
<br>
<br>
<? include("inc_copyright.php");?>
<br>
<br>
<br>


</form> 
</body>
</html>
