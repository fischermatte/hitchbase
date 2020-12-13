<div style="margin: 10px 0;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#aad037">
      <tr>
        <td width="5" height="5" align="left" valign="top"><img src="../bilder/corner2.gif" width="3" height="3" /></td>
        <td width="150" height="5"></td>
        <td width="5" height="5" align="right" valign="top"><img src="../bilder/corner.gif" alt="" width="3" height="3" /></td>
      </tr>
      <tr>
        <td height="40" colspan="3" bgcolor="#AAD037"><table width="100%" border="0" cellpadding="1" cellspacing="0">
            <tr>
              <td><table width="100%"  border="0" cellpadding="4" cellspacing="0" bgcolor="#F1FEE7">
                  <tr>
                    <td height="30" align="center" class="textSearchTitle"><?=@$_titel_suche?>
                    </td>
                  </tr>
                  <tr>
                    <td align="center"><table width="250" border="0" cellpadding="0" cellspacing="5">
                        <tr>
                          <td align="center"><table width="100%" border="0" cellpadding="3" cellspacing="0">
                              <!--DWLayoutTable-->
                              <tr align="left" valign="bottom" >
                                <td align="right" valign="middle" nowrap="nowrap" class="Stil2"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                <td align="left" valign="middle" nowrap="nowrap" class="Stil2"><?=$_von?>
                                </td>
                                <td align="left" valign="middle" nowrap="nowrap" class="Stil2"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                <td align="left" nowrap="nowrap" class="Stil2"  ><?=$_nach?></td>
                              </tr>
                              <tr align="left" valign="bottom" >
                                <td width="25" align="right" valign="middle" nowrap="nowrap" class="Stil2"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                <td width="77" align="left" valign="middle" nowrap="nowrap"><select name="abfrage[startort]2" class="comboBreite" onchange="send(false)">
                                    <option value="-1" <? if ($abfrage==false || $abfrage['startort']== "-1") echo "selected"; ?>>
                                    <?=$_alleOrte?>
                                    </option>
                                    <? foreach (Ort::alleStartorte(array('order'=>'name','condition_zielort'=>$abfrage['zielort'],'condition_zielland'=>$abfrage['zielland'],'condition_startland'=>$abfrage['startland'])) as $ort) { ?>
                                    <option value="<?= $ort->o_id?>"
	 			<? if ($abfrage['startort'] != "-1" && $ort->o_id == $abfrage['startort']) echo " selected " ;?>> <? echo stripslashes($ort->name); ?> </option>
                                    <? } ?>
                                  </select>
                                </td>
                                <td width="33" align="left" valign="middle" nowrap="nowrap"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                <td width="77" align="left" nowrap="nowrap"  ><select name="abfrage[zielort]2" class="comboBreite"  onchange="send(false)">
                                    <option value="-1" <? if ($abfrage==false || $abfrage['zielort']== "-1") echo "selected"; ?>>
                                    <?=$_alleOrte?>
                                    </option>
                                    <? 
						$orte = Array();
						$hr = Array();
						foreach (Ort::alleZielorte(array('order'=>'name','condition_startort'=>$abfrage['startort'],'condition_zielland'=>$abfrage['zielland'],'condition_startland'=>$abfrage['startland'])) as $ort) 
						{ 
							if($ort->o_id < 5)
								array_push($hr,$ort);
							else
								array_push($orte,$ort);
						}
						foreach($hr as $ort)
						{	?>
                                    <option value="<?= $ort->o_id?>"<? 
							if ($abfrage['zielort'] != "-1" && $ort->o_id == $abfrage['zielort']) 
								echo " selected " ;	?>>
                                    <? 
							$s = "echo \$_"."$ort->name;";
							eval($s);			?>
                                    </option>
                                    <? 
						} 						
						foreach($orte as $ort)
						{	?>
                                    <option value="<?= $ort->o_id?>"<? 
							if ($abfrage['zielort'] != "-1" && $ort->o_id == $abfrage['zielort']) 
								echo " selected " ;	?>>
                                    <? 					
							echo stripslashes($ort->name); ?>
                                    </option>
                                    <?
						}	?>
                                  </select>
                                </td>
                              </tr>
                              <tr align="left" valign="bottom" >
                                <td align="right" valign="middle" nowrap="nowrap"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                <td align="left" valign="middle" nowrap="nowrap"><select name="abfrage[startland]2" class="comboBreite"  onchange="send(false)">
                                    <option value="-1" <? if ($abfrage==false || $abfrage['startland']== "-1")  echo "selected"; ?>>
                                    <?=$_land?>
                                    </option>
                                    <? foreach (Land::alleStartLaender(array('order'=>'name','condition_startort'=>$abfrage['startort'])) as $land) { 
						 //267 == Himmelsrichtung
	 if ($land->l_id != "267") {
						?>
                                    <option value="<?= $land->l_id?>"
	 	<? if ($abfrage['startland'] != "-1" && $land->l_id == $abfrage['startland']) echo " selected " ;?>> <? echo cutAtEnd($land->name,20); ?> </option>
                                    <? }} ?>
                                  </select>
                                </td>
                                <td align="left" valign="middle" nowrap="nowrap"></td>
                                <td align="left" nowrap="nowrap"  ><select name="abfrage[zielland]2" class="comboBreite"  onchange="send(false)">
                                    <option value="-1" <? if ($abfrage==false || $abfrage['zielland']== "-1")  echo "selected"; ?>>
                                    <?=$_land?>
                                    </option>
                                    <? foreach (Land::alleZielLaender(array('order'=>'name','condition_startort'=>$abfrage['startort'],'condition_startland'=>$abfrage['startland'],'condition_zielort'=>$abfrage['zielort'])) as $land) { 
						 //267 == Himmelsrichtung
	 if ($land->l_id != "267") {
						?>
                                    <option value="<?= $land->l_id?>"
	 	<? if ($abfrage['zielland'] != "-1" && $land->l_id == $abfrage['zielland']) echo " selected " ;?>> <? echo cutAtEnd($land->name,20); ?> </option>
                                    <? } }?>
                                  </select>
                                </td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="center" valign="bottom" ><input type="button" name="MySubmit2" value="<?=@$_suchen ?>" onclick="send(true)" /></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="5" height="5" align="left" valign="bottom"><img src="../bilder/corner3.gif" alt="" width="3" height="3" /></td>
        <td width="150" height="5"></td>
        <td width="5" height="5" align="right" valign="bottom"><img src="../bilder/corner4.gif" alt="" width="3" height="3" /></td>
      </tr>
    </table></td>
  </tr>
</table>

<span class="backgroundcolor1">
<input name="LANG" type="hidden" class="backgroundcolor1"  value="<?=$LANG?>">
</span>
</div>

