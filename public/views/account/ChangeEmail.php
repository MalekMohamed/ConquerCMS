<?php if (!isset($user_logged)) {
    header("Location: ../Account/LogIn");
} else {
    ?>
    <section id="ucp_characters">
        <h1>Change Email</h1>
    <form action="#" class="page_form change-email" method="post" accept-charset="utf-8">
        <table style="width:80%">
            <tbody>
            <tr>
                <td><label for="register_email_password">Password</label></td>
                <td>
                    <input type="password" name="Password" id="register_email_password" value="">
                    <span id="email_password_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_email">Old Email</label></td>
                <td>
                    <input type="email" name="Email" id="register_email"
                           value="">
                    <span id="email_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_email">New Email</label></td>
                <td>
                    <input type="email" name="NewEmail" id="register_new_email"
                           value="">
                    <span id="new_email_error"></span>
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