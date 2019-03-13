<?php if (!isset($user_logged)) {
    header("Location: ../Account/LogIn");
} else {
    ?>
    <section id="ucp_characters">
    <h1>Change Password</h1>
    <form action="#" class="page_form change-password" method="post" accept-charset="utf-8">
        <table style="width:80%">
            <tbody>
            <tr>
                <td><label for="register_password">Old Password</label></td>
                <td>
                    <input type="password" name="Password" id="register_password" value="">
                    <span id="password_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_new_password">New password</label></td>
                <td>
                    <input type="password" name="NewPassword" id="register_new_password"
                           value="">
                    <span id="new_password_error"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <center style="margin-bottom:10px;">
            <input type="submit" value="Change!">
        </center>
    </form>
    </section>
<?php } ?>