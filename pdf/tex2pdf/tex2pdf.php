<?php

//ohne ausgabe der systemmeldungen von pdflatex
passthru( "./usr/bin/pdflatex ./texdatei.tex" );
//oder mit ausgabe
system( "./usr/bin/pdflatex ./texdatei.tex" );
//während der entwicklung sollte mit system() gearbeitet werden, damit man eventuelle fehlermeldungen sieht 

?>
