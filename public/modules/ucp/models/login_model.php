<?php if (!isset($user_logged)) {
    if ($route['account'] != 'LogIn') {
    ?>
    <form action="#" class="login-form" method="post" accept-charset="utf-8">
        <table style="width:100%">
            <tbody>
            <tr>
                <td>
                    <input type="text" name="Username" id="login_username" value=""
                           placeholder="Username..">
                    <span id="username_error"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="Password" id="login_password" value=""
                           placeholder="Password..">
                    <span id="password_error"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="margin-left: 10px">
            <br>
            <input type="submit" name="register" value="Log In!">
            <section id="forgot"><a href="<?php echo $app->BASE_URL('Account/RecoverPassword'); ?>"
                                    data-hasevent="1">Have you lost your password?</a></section>
        </div>
    </form>
<?php } } else {
    $user = $app->get_user_by_name($user_logged);
    $character = $app->get_char_by_owner($user_logged);
    ?>
    <table width="100%">
        <tbody>
        <tr>
            <td width="10%">
                <img src="<?php echo $app->BASE_URL('public/img/icons/user.png'); ?>"></td>
            <td width="40%">Character :</td>
            <td width="50%">
                <a href="<?php echo $app->BASE_URL('Profile/' . $user_logged); ?>"
                   data-tip="View profile"><?php echo isset($character['Name']) ? $character['Name'] : $user_logged; ?></a>
            </td>
        </tr>

        <tr data-tip="Account Rank">
            <td width="10%"><img
                    src="<?php echo $app->BASE_URL('public/img/icons/award_star_bronze_1.png'); ?>">
            </td>
            <td width="40%">AccountRank :</td>
            <td width="50%"><span><?php echo $app->user_state($user['State']); ?></span>
            </td>
        </tr>
        <tr data-tip="CPS">
            <td width="10%"><img src="<?php echo $app->BASE_URL('public/img/icons/coins.png'); ?>"></td>
            <td width="40%">ConquerPoints :</td>
            <td width="50%">
                <?php echo number_format($character['ConquerPoints']); ?>
            </td>
        </tr>
        <tr data-tip="Money">
            <td width="10%">
                <img src="<?php echo $app->BASE_URL('public/img/icons/lightning.png'); ?>">
            </td>
            <td width="40%">Total Silver :</td>
            <td width="50%"> <?php echo number_format($character['Money']); ?></td>
        </tr>
        </tbody>
    </table>
    <div class="ucp_divider"></div>
    <div style="text-align: center;">
        <a class="nice_button" href="<?php echo $app->BASE_URL('Account/Settings'); ?>" data-hasevent="1">Account
            Panel</a>
        <a class="nice_button" href="<?php echo $app->BASE_URL('Account/LogOut'); ?>" data-hasevent="1">LogOut</a>
    </div>
<?php } ?>