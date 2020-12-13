// JavaScript Document
function geturl (url,query,kontrolle)
{
		
	newurl = url;
	if (query != "") {
		newurl = newurl + "?" + query;
		if (kontrolle)
			newurl = newurl + "&kontrolle=true";
	}
		
	document.location.href = newurl;
}
function formReset(url,lang){
	
	/*
	document.forms[0].elements[0].value = "";
	document.forms[0].elements[1].options[0].selected = true;
	document.forms[0].elements[2].value = "";
	
	document.forms[0].elements[3].checked= false;
	document.forms[0].elements[4].checked= false;
	document.forms[0].elements[5].checked= false;
	document.forms[0].elements[6].checked= false;
	
	document.forms[0].elements[7].value = "";
	document.forms[0].elements[8].value = "";
	document.forms[0].elements[9].value = "";
	
	document.forms[0].elements[10].checked= false;
	document.forms[0].elements[11].checked= false;
	document.forms[0].elements[12].checked= false;
	document.forms[0].elements[13].checked= false;
	
	document.forms[0].elements[14].value = ""; */
	
cleanURL = url+"?lang="+lang;
	document.location.href = cleanURL;

}

function post(vorne,hinten,css,autor) {
document.write('<a class=\''+css +' \'href=\"mailto:' + vorne + '@' + hinten +'\">');
if (autor != "") 
	document.write(autor +'</a>');
else 
	document.write(vorne+ '@' + hinten + '</a>');
}

function send(bGotoResults)
{
	if(bGotoResults)
	{
		document.forms[0].action="ergebnisse.php";
	}
	document.forms[0].submit();
}

function bfish()
{
 bfishFenster =
 window.open("bfish.php", "hitchbase.com_babbelfish", "width=600,height=500,scrollbars");
 bfishFenster.focus();
}


