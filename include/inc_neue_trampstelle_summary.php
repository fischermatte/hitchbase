<form action="neue_trampstelle_controller.php" method="post" name="form1" id="form1">
    <input type="hidden" name="form_secret" id="form_secret" value="<?php echo $form_secret;?>" />
    <table width="100%;" align="center" border="0" cellpadding="5" cellspacing="1" class="backgroundcolor3">
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
        <span class="NormalFett">
        <?= @$_abfahrtsort ?>
            :
        </span></td>
            <td align="left" class="backgroundcolor1"><?=stripslashes($trampstelle['startort'])?></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1"><strong>
                <?=$_land?> :
            </strong></td>
            <td align="left" class="backgroundcolor1"><?
                $land = Land::get($trampstelle['land']);
                echo cutAtEnd($land->name, 20);
                ?></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
                <strong>
                    <?= @$_name?>
                    : </strong></td>
            <td align="left" class="backgroundcolor1"> <?=@stripslashes($trampstelle['bezeichnung'])?>&nbsp;  </td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
                <strong>
                    <?= @$_richtung?>
                    : </strong></td>
            <td align="left" class="backgroundcolor1"><?

                //Orte filtern - utils.php
                if (isset($trampstelle['zielorte'])) {
                    $filter_zielorte = filterArray($trampstelle['zielorte']);
                    for ($x = 0; $x < count($filter_zielorte); $x++) {
                        $objLand = Land::get($filter_zielorte[$x][1]);
                        echo stripslashes($filter_zielorte[$x][0]) . " ($objLand->name)<br>";
                    }
                }

                //Himmelsrichtung
                $count = 0;
                if (!empty($trampstelle['hr'])) {
                    for ($x = 0; $x < sizeof($trampstelle['hr']); $x++) {
                        if (current($trampstelle['hr']) != "0") {
                            $count++;
                            if ($count > 1) echo ", ";
                            $hr = key($trampstelle['hr']);
                            $s = "echo \$_" . "$hr;";
                            eval($s);
                        }
                        next($trampstelle['hr']);
                    }
                }


                ?></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
                <strong>
                    <?= @$_strassennummer ?>
                    : </strong></td>
            <td align="left" class="backgroundcolor1"><?=stripslashes($trampstelle['strassennamen'])?> &nbsp;</td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
                <strong>
                    <?= @$_beschreibung?>
                    : </strong></td>
            <td align="left" class="backgroundcolor1"><?=nl2br(stripslashes($trampstelle['beschreibung']))?></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
                <strong>
                    <?= @$_bewertung ?>
                    : </strong></td>
            <td align="left" class="backgroundcolor1"><?
                showBewertung($trampstelle['bewertung'], $_bewertung_0, $_bewertung_1, $_bewertung_2, $_bewertung_3);

                ?>    </td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
            <td width="160" align="left" nowrap class="backgroundcolor1">
                <strong>
                    <?= @$_absender?>
                    : </strong></td>
            <td align="left" class="backgroundcolor1"><?=stripslashes($trampstelle['absender'])?>&nbsp;</td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF" class="backgroundcolor2">
            <td width="160" align="right" nowrap><input name="reset2" type="button" id="reset2" value="<?= @$_zurueck ?>"
                                                        onClick="location.href='neue_trampstelle.php'"></td>
            <td align="left"><input name="submit" type="submit" id="submit" value="<?= @$_weiter ?>"></td>
        </tr>
    </table>
    <?
    for ($x = 0; $x < count($filter_zielorte); $x++) {
        ?>
        <input name="trampstelle[zielorte][<?=$x?>][ort]" type="hidden"
               value="<?=htmlentities(stripslashes(trim($filter_zielorte[$x][0])))?>">
        <input name="trampstelle[zielorte][<?=$x?>][land]" type="hidden"
               value="<?=htmlentities(stripslashes(trim($filter_zielorte[$x][1])))?>">

        <?
    }
    ?>
    <input name="zielorte_mit_laendern" type="hidden" value="true">
    <input name="trampstelle[bezeichnung]" type="hidden"
           value="<?=htmlentities(stripslashes($trampstelle['bezeichnung']))?>">

    <input name="trampstelle[beschreibung]" type="hidden"
           value="<?=htmlentities(stripslashes($trampstelle['beschreibung']))?>">
    <input name="trampstelle[hr][nord]" type="hidden"
           value="<?=empty($trampstelle['hr']['nord']) ? "0" : $trampstelle['hr']['nord'];?>">
    <input name="trampstelle[hr][sued]" type="hidden"
           value="<?=empty($trampstelle['hr']['sued']) ? "0" : $trampstelle['hr']['sued'];?>">
    <input name="trampstelle[hr][west]" type="hidden"
           value="<?=empty($trampstelle['hr']['west']) ? "0" : $trampstelle['hr']['west'];?>">
    <input name="trampstelle[hr][ost]" type="hidden"
           value="<?=empty($trampstelle['hr']['ost']) ? "0" : $trampstelle['hr']['ost'];?>">
    <input name="trampstelle[strassennamen]" type="hidden"
           value="<?=htmlentities(stripslashes($trampstelle['strassennamen']))?>">
    <input name="trampstelle[startort]" type="hidden"
           value="<?=htmlentities(stripslashes(trim($trampstelle['startort'])))?>">
    <input name="trampstelle[bewertung]" type="hidden" value="<?=$trampstelle['bewertung']?>">
    <input name="trampstelle[land]" type="hidden" value="<?=$trampstelle['land']?>">
    <input name="trampstelle[absender]" type="hidden"
           value="<?=htmlentities(stripslashes($trampstelle['absender']))?>">
    <input name="LANG" type="hidden" value="<?=$LANG?>">
    <input name="zielseite" type="hidden" value="ergebnisse.php?LANG=<?=@$LANG?>">
    <br>
    <br>
    <br>
</form>