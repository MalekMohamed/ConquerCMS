<?php if (isset($user_logged)) {
    header("Location: ../Account/Settings");
} else { ?>
    <?php page_header('Log In','page_register'); ?>
                            <form action="#" class="page_form login-form" method="post" accept-charset="utf-8">
                                <table style="width:80%">
                                    <tbody>

                                    <tr>
                                        <td><label for="login_username">Username</label></td>
                                        <td>
                                            <input type="text" name="Username" id="login_username" value="">
                                            <span id="username_error"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="login_password">Password</label></td>
                                        <td>
                                            <input type="password" name="Password" id="login_password" value="">
                                            <span id="password_error"></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <center style="margin-bottom:10px;">
                                    <input type="submit" name="register" value="Log In!">
                                    <section id="forgot"><a href="<?php echo $app->BASE_URL('Account/RecoverPassword');?>" data-hasevent="1">Have you lost your password?</a></section>
                                </center>
                            </form>
                       <?php page_footer();?>
<?php } ?>