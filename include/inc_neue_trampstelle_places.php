<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="form2" id="form2" style="text-align: center">
    <input type="hidden" name="form_secret" id="form_secret" value="<?php echo $form_secret;?>" />
    <table width="100%;" align="center" border="0" cellpadding="5" cellspacing="1" class="backgroundcolor3">

        <?php

        if (strstr($trampstelle['zielorte'], ',')){
            $zielorte = explode(",", $trampstelle['zielorte']);
        }
        else {
            $zielorte[] = $trampstelle['zielorte'];
        }

        $laender = Land::alle(array('order' => 'name'));
        for ($i = 0; $i < count($zielorte); $i++) {
            //	$zielorte[$i]=ucfirst(trim($zielorte[$i]));
            ?>
            <tr valign="top" bgcolor="#FFFFFF" class="Stil2">
                <td align="right" nowrap class="backgroundcolor1">
                    <input name="trampstelle[zielorte][<?=$i?>][ort]" type="text"
                           value="<?=trim(stripslashes($zielorte[$i]))?>"/>
                    </td>
                <td  align="left" nowrap class="backgroundcolor1">
                    <select name="trampstelle[zielorte][<?=$i?>][land]">
                        <option value="-1" <? if ($trampstelle == false) echo "selected"; ?>><?=$_land?></option>
                        <? foreach ($laender as $land) { ?>
                        <option value="<?= $land->l_id?>"
                            <? if ($trampstelle['land'] != "-1" && $land->l_id == $trampstelle['land']) echo " selected ";?>
                                >
                            <? echo ucwords(strtolower($land->name)) ?>
                        </option>
                        <?
                    } ?>
                    </select>
                </td>
            </tr>

            <?
        }
        ?>
        <tr>
            <td align="right" nowrap class="backgroundcolor1"><input name="zurueck" type="button" id="zurueck" value="<?=$_zurueck?>"
                       onClick="window.location.href='neue_trampstelle.php'"/></td>
            <td align="left" nowrap class="backgroundcolor1"><input type="submit" name="Submit2" value="<?= @$_weiter ?>"/></td>
        </tr>


    </table>
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
           value="<?=trim(htmlentities(stripslashes($trampstelle['startort'])))?>">
    <input name="trampstelle[bewertung]" type="hidden" value="<?=$trampstelle['bewertung']?>">
    <input name="trampstelle[land]" type="hidden" value="<?=$trampstelle['land']?>">
    <input name="trampstelle[absender]" type="hidden"
           value="<?=htmlentities(stripslashes($trampstelle['absender']))?>">
    <input name="LANG" type="hidden" value="<?=$LANG?>">
    <input name="zielseite" type="hidden" value="index.php">
</form>
