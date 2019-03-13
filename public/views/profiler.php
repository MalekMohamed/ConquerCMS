<?php
$user_reguested = filter_var($_GET['user'], FILTER_SANITIZE_STRING);
if (empty($user_reguested)) {
    header("Location: ../404");
} else {
    $character = $app->get_chars_by_name($user_reguested);
    $user = $app->get_user_by_name($character['Owner']);
    ?>
    <link type="text/css" rel="stylesheet"
          href="<?php echo $app->BASE_URL('public/modules/ucp/css/ucp.css'); ?>"/>
    <?php page_header($character['Name'].' Profile'); ?>
                            <section id="ucp_top">
                                <a href="#" id="ucp_avatar" data-hasevent="1">
                                    <img src="<?php echo $app->BASE_URL('public/img/faces/' . $character['Face']); ?>.jpg">
                                </a>

                                <section id="ucp_info">
                                    <aside>
                                        <table width="100%">
                                            <tbody>
                                            <tr>
                                                <td width="10%"><img
                                                            src="<?php echo $app->BASE_URL('public/img/icons/user.png'); ?>">
                                                </td>
                                                <td width="40%">Nickname</td>
                                                <td width="50%">
                                                    <a href="#"
                                                       data-tip="View profile"><?php echo $character['Name']; ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><img
                                                            src="<?php echo $app->BASE_URL('public/img/icons/award_star_bronze_1.png'); ?>">
                                                </td>
                                                <td width="40%">Account rank</td>
                                                <td width="50%"><span><?php echo $app->user_state($user['State']); ?></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="10%"><img
                                                            src="<?php echo $app->BASE_URL('public/img/icons/award_star_gold_1.png'); ?>">
                                                </td>
                                                <td width="40%">VIP Level</td>
                                                <td width="50%"><?php echo $character['VIPLevel']; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </aside>

                                    <aside>
                                        <table width="100%">
                                            <tbody>
                                            <tr data-tip="Earn voting points by voting for the server">
                                                <td width="10%"><img
                                                            src="<?php echo $app->BASE_URL('public/img/icons/lightning.png'); ?>">
                                                </td>
                                                <td width="40%">Level</td>
                                                <td width="50%"><?php echo number_format($character['Level']); ?></td>
                                            </tr>
                                            <tr data-tip="Earn donation points by donating money to the server">
                                                <td width="10%"><img
                                                            src="<?php echo $app->BASE_URL('public/img/icons/coins.png'); ?>">
                                                </td>
                                                <td width="40%">ConquerPoints</td>
                                                <td width="50%"><?php echo number_format($character['ConquerPoints']); ?></td>
                                            </tr>
                                            <tr>
                                                <td width="10%"><img
                                                            src="<?php echo $app->BASE_URL('public/img/icons/shield.png'); ?>">
                                                </td>
                                                <td width="40%">Account status</td>
                                                <?php if ($character['Online'] != 0) { ?>
                                                    <td width="50%">Online</td>
                                                <?php } else { ?>
                                                    <td width="50%">Offline</td>
                                                <?php } ?>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </aside>
                                </section>

                                <div class="clear"></div>
                            </section>
                      <?php page_footer(); ?>
<?php } ?>
