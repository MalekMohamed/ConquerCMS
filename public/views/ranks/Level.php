<?php page_header('Level Rank'); ?>
                        <section id="statistics_wrapper">
                            <link type="text/css" rel="stylesheet"
                                  href="<?php echo $app->BASE_URL('public/modules/pvp_statistics/css/style.css'); ?>"/>
                            <section id="checkout"></section>
                            <div id="search_sections" style="text-align: center;">
                                <?php ranks(); ?>
                            </div>
                            <section id="statistics">
                                <section id="statistics_title" style="margin-top: 40px; margin-bottom: 10px;">
                                    <div><h3>Top Level</h3></div>
                                </section>

                                <section class="statistics_top_hk" style="display:block;">

                                    <table class="nice_table" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td width="10%" align="center">Rank</td>
                                            <td width="30%" align="center">Character</td>
                                            <td width="30%" align="center">Guild</td>
                                            <td width="15%" align="center">Class</td>
                                            <td width="15%" align="center">Level</td>
                                        </tr>
                                        <?php
                                        $i = 1;
                                        $get = $app->get_level();
                                        foreach ($get as $row) {
                                            $class = $app->Classes($row['Class']);
                                            $guildname = $app->get_char_guild_name($row['GuildID']);
                                                    echo '<tr>';
                                                    echo '<td width="10%" align="center">' . $i . '</td>';
                                                    echo '<td width="30%" align="center"><a data-tip="View character profile" href="' . $app->BASE_URL('Profile/' . $row['Name']) . '" data-hasevent="1">' . $row['Name'] . '</a></td>';
                                                    echo '<td width="30%" align="center">' . $guildname . '</td>';
                                                    echo '<td width="15%" align="center">' . $class . '</td>';
                                                    echo '<td width="15%" align="center">' . number_format($row['Level']) . '</td>';
                                                    echo "</tr>";
                                                    $i++;
                                        }
                                        ?>

                                        </tbody>
                                    </table>

                                </section>

                                <!-- End.If we have realms -->

                            </section>
                        </section>
<?php page_footer(); ?>
