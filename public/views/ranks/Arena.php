<?php page_header('Arena Rank'); ?>
                        <section id="statistics_wrapper">
                            <link type="text/css" rel="stylesheet"
                                  href="<?php echo $app->BASE_URL('public/modules/pvp_statistics/css/style.css'); ?>"/>
                            <section id="checkout"></section>
                            <div id="search_sections" style="text-align: center;">
                                <?php ranks(); ?>
                            </div>
                            <section id="statistics">
                                <section id="statistics_title" style="margin-top: 40px; margin-bottom: 10px;">
                                    <div><h3>Top Arena</h3></div>
                                </section>

                                <section class="statistics_top_hk" style="display:block;">

                                    <table class="nice_table" cellspacing="0" cellpadding="0">
                                        <tbody><tr>
                                            <td width="10%" align="center">Rank</td>
                                            <td width="30%" align="center">Character</td>
                                            <td width="30%" align="center">Guild</td>
                                            <td width="15%" align="center">Class</td>
                                            <td width="15%" align="center">Wins</td>
                                            <td width="15%" align="center">Losses</td>
                                            <td width="15%" align="center">Points</td>
                                        </tr>
                                        <?php
                                        $i = 1;
                                        $get = $app->get_arena($app->rows);
                                        foreach ($get as $row) {
                                            $name = $row['EntityName'];
                                            $char = $app->get_chars_by_name($name);
                                            $Wins = $row['TodayWin'];
                                            $Loses = $row['TodayBattles'] - $Wins;
                                            $points = $row['ArenaPoints'];
                                            $class = $app->Classes($char['Class']);
                                            $guildname = $app->get_char_guild_name($char['GuildID']);
                                                    echo '<tr>';
                                                    echo '<td width="10%" align="center">' . $i . '</td>';
                                                    echo '<td width="30%" align="center"><a data-tip="View character profile" href="' . $app->BASE_URL('Profile/' . $char['Name']) . '" data-hasevent="1">' . $name . '</a></td>';
                                                    echo '<td width="30%" align="center">' . $guildname . '</td>';
                                                    echo '<td width="15%" align="center">' . $class . '</td>';
                                                    echo '<td width="15%" align="center">' . $Wins . '</td>';
                                                    echo '<td width="15%" align="center">' . $Loses . '</td>';
                                                    echo '<td width="15%" align="center">' . number_format($points) . '</td>';
                                                    echo "</tr>";
                                                $i++;
                                            }
                                        ?>

                                        </tbody></table>

                                </section>

                                <!-- End.If we have realms -->

                            </section>
                        </section>
<?php page_footer(); ?>
