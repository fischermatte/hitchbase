<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgColor8">
    <tr>
        <td bgcolor="#FFFFFF">
            <table width="100%" border="0" cellpadding="1" cellspacing="0" class="bgColor9">
                <tr align="right" valign="top">
                    <td align="left" nowrap>
                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                            <tr align="left" valign="baseline">
                                <td width="7%" nowrap class="ergebnisseAbfahrtsort">                    <?
                                    $startort = $trampstelle->getStartort();
                                    echo stripslashes($startort->name);?>                   <span class="ergebniss_startland"> </span></td>
                                <td width="93%" class="Stil7">                    <?=$startort->land;?>                  </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr align="right" valign="top">
                    <td align="left" nowrap>
                        <table width="100%" border="0" cellpadding="1" cellspacing="0">
                            <tr align="left">
                                <td nowrap class="Stil2"><? echo stripslashes($trampstelle->bezeichnung);?></td>
                                <td align="right" nowrap><span class="ergebniss_startland"><span class="Stil2">
				  <?
                                    echo showBewertung($trampstelle->getBewertung(), $_bewertung_0, $_bewertung_1, $_bewertung_2, $_bewertung_3)?>
				</span></span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF">
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="bgColor9">
                <tr align="right">
                    <td width="5%" align="left" nowrap class="Stil2"><?=@$_richtung?>:</td>
                    <td align="left" class="Stil2"> &nbsp;&nbsp;<?php
                        $zielorte = $trampstelle->getZielorte();
                        $orte = array();
                        $hr = array();
                        foreach ($zielorte as $ort) {
                            if ($ort->land == "-") {
                                $hr[] = $ort->name;
                            } else {
                                $orte[] = $ort->name; //." (".$ort->land.")";
                            }
                        }
                        $countorte = count($orte);
                        if ($countorte > 0) {
                            for ($x = 0; $x < $countorte; $x++) {
                                if ($x > 0 && $countorte > 1)
                                    echo ", ";
                                echo stripslashes($orte[$x]);
                            }
                        }
                        $counthr = count($hr);
                        if ($counthr > 0) {
                            if ($countorte > 0) echo " (";
                            for ($z = 0; $z < $counthr; $z++) {
                                if ($z > 0 && $counthr > 1)
                                    echo ", ";
                                $s = "echo \$_" . "$hr[$z];";
                                eval($s);
                            }
                            if ($countorte > 0) echo ")";
                        }


                        ?>                <?=stripslashes($trampstelle->strassennamen)?>                </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" bgcolor="#FFFFFF"><SPAN class="Stil5">    </SPAN>
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="bgColor6">

                <?php
                $kommentare = $trampstelle->getKommentare();
                $count = count($kommentare);
                if ($count == 0) echo "<tr><td>---</td></tr>";
                else {
                    for ($a = 0; $a < $count; $a++) {
                        ?>
                        <tr>
                            <td>						   <span class="Stil2">
<?= nl2br(stripslashes($kommentare[$a]->beschreibung))?>
                                <br> </span>
								<span class="Stil6">
									<?= stripslashes($kommentare[$a]->absender);?>
                                    <?= $kommentare[$a]->datum;?>
							</span>
                            </td>
                        </tr>
                        <?
                    }
                }
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td align="right" bgcolor="#FFFFFF" class="Stil2">
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="bgColor7">
                <tr>
                    <td align="right" class="bgColor6">&nbsp;
                        <span class="KommentarLink">
                            <a href="neuer_kommentar.php?LANG=<?=@$LANG?>&amp;t_id=<?=$trampstelle->t_id?>" class="ergebnisseLink">
                            </a>
                        </span>
                        <a href="neuer_kommentar.php?LANG=<?=@$LANG?>&amp;t_id=<?=$trampstelle->t_id?>" class="KommentarLink">
                            <?=@$_uhDeinKommentar?>
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table><br>