<div style="background-color: #aad037;margin: 10px 0;">
            <table width="100%" border="0" cellpadding="0" cellspacing="1">
                <?
                $laender = Land::alleStartLaender(array('order' => 'name', 'condition_startort' => $abfrage['startort']));
                $count = count($laender);
//                echo $count;
//                phpinfo();
                $eachcolumn = ceil(($count / 3));


                for ($i = 0; $i < $eachcolumn; $i++) {

                    $land1 = $laender[$i];
                    $land2 = null;
                    if (($i + $eachcolumn) < $count)
                        $land2 = $laender[$i + $eachcolumn];
                    $land3 = null;
                    if (($i + (2* $eachcolumn)) < $count)
                        $land3 = $laender[$i + (2 * $eachcolumn)];
                    ?>
                    <tr>
                        <?
                        utlShowLand($land1, $LANG);
                        utlShowLand($land2, $LANG);
                        utlShowLand($land3, $LANG);
                        ?>
                    </tr>
                    <?
                }
                ?>
            </table>
</div>