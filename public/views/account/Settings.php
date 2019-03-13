<?php if (!isset($user_logged)) {
    header("Location: ../Account/LogIn");
} else {
    $user = $app->get_user_by_name($user_logged);
    $character = $app->get_char_by_owner($user_logged);
    ?>
    <link type="text/css" rel="stylesheet"
          href="<?php echo $app->BASE_URL('public/modules/ucp/css/ucp.css'); ?>"/>
    <?php page_header('User Panel'); ?>
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
                            <a href="<?php echo $app->BASE_URL('Profile/' . $user_logged); ?>"
                               data-tip="View profile"><?php echo $user_logged; ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%"><img
                                    src="<?php echo $app->BASE_URL('public/img/icons/award_star_bronze_1.png'); ?>">
                        </td>
                        <td width="40%">Account rank</td>
                        <td width="50%">
                            <span><?php echo $app->user_state($user['State']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%"><img
                                    src="<?php echo $app->BASE_URL('public/img/icons/award_star_gold_1.png'); ?>">
                        </td>
                        <td width="40%">VIP Level</td>
                        <td width="50%"><?php echo $character['VIPLevel']; ?></td>
                    </tr>
                    <tr>
                        <td width="10%"><img
                                    src="<?php echo $app->BASE_URL('public/img/icons/shield.png'); ?>">
                        </td>
                        <td width="40%">Vote Points</td>
                        <td width="50%"><?php echo number_format($user['VotePoint']); ?></td>
                    </tr>
                    </tbody>
                </table>
            </aside>

            <aside>
                <table width="100%">
                    <tbody>
                    <tr>
                        <td width="10%"><img
                                    src="<?php echo $app->BASE_URL('public/img/icons/user_gray.png'); ?>">
                        </td>
                        <td width="40%">Character Name</td>
                        <td width="50%"><?php echo $character['Name']; ?></td>
                    </tr>
                    <tr>
                        <td width="10%"><img
                                    src="<?php echo $app->BASE_URL('public/img/icons/lightning.png'); ?>">
                        </td>
                        <td width="40%">Level</td>
                        <td width="50%"><?php echo number_format($character['Level']); ?></td>
                    </tr>
                    <tr>
                        <td width="10%"><img
                                    src="<?php echo $app->BASE_URL('public/img/icons/coins.png'); ?>">
                        </td>
                        <td width="40%">ConquerPoints</td>
                        <td width="50%"><?php echo number_format($character['ConquerPoints']); ?></td>
                    </tr>


                    </tbody>
                </table>
            </aside>
        </section>

        <div class="clear"></div>
    </section>

    <div class="ucp_divider"></div>

    <section id="ucp_buttons">
        <a href="<?php echo $app->BASE_URL('Account/Vote'); ?>"
           style="background-image:url(<?php echo $app->BASE_URL('public/modules/ucp/images/vote_panel.jpg'); ?>)"
           data-hasevent="1"></a>

        <a href="<?php echo $app->BASE_URL('Store'); ?>"
           style="background-image:url(<?php echo $app->BASE_URL('public/modules/ucp/images/item_store.jpg'); ?>)"
           data-hasevent="1"></a>

        <a href="<?php echo $app->BASE_URL('Account/Edit'); ?>"
           style="background-image:url(<?php echo $app->BASE_URL('public/modules/ucp/images/account_settings.jpg'); ?>)"
           data-hasevent="1"></a>
        <a href="<?php echo $app->BASE_URL('Support/Tickets/All/'); ?>"
           style="background-image:url(<?php echo $app->BASE_URL('public/modules/ucp/images/reward.jpg'); ?>)"
           data-hasevent="1"></a>
        <div class="clear"></div>
    </section>

    <?php page_footer(); ?>
<?php } ?>
