<?php
page_header('Account Create', 'page_register');
?>
    <form action="#" class="page_form reg-form" method="post" accept-charset="utf-8">

        <table style="width:80%">
            <tbody>

            <tr>
                <td><label for="register_username">Username</label></td>
                <td>
                    <input type="text" name="Username" id="register_username" value="">
                    <span id="username_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_email">Email</label></td>
                <td>
                    <input type="email" name="Email" id="register_email" value=""
                           onchange="Validate.checkEmail()">
                    <span id="email_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_password">Password</label></td>
                <td>
                    <input type="password" name="Password" id="register_password" value="">
                    <span id="password_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_password_confirm">Confirm password</label></td>
                <td>
                    <input type="password" name="ConfirmPassword" id="register_password_confirm"
                           value="" onchange="Validate.checkPasswordConfirm()">
                    <span id="password_confirm_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_question">Question</label></td>
                <td>
                    <select onchange="Validate.checkquestion()" id="register_question" name="Question">
                        <option value="">Select question</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is your father's middle name?">What is your father's middle name?</option>
                        <option value="What was your first pet's name?">What was your first pet's name?</option>
                        <option value="In what city were you born?">In what city were you born?</option>
                        <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                        <option value="What street did you grow up on?">What street did you grow up on?</option>
                    </select>
                    <span id="question_error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="register_answer">Answer</label></td>
                <td>
                    <input type="password" name="Answer" id="register_answer" value=""
                           onchange="Validate.checkanswer()">
                    <span id="answer_error"></span>
                </td>
            </tr>
            <?php
            if ($app->reCaptcha['enable'] == true) { ?>
                <tr>
                <td><label for="register_answer">Captcha</label></td>
                <script src='https://www.google.com/recaptcha/api.js'></script>
                <td>
                <div class="g-recaptcha" style="margin-left: 5px;"
                     id="register_captcha" data-recaptcha="google" data-theme="<?php echo $app->reCaptcha['theme'];?>"
                     data-sitekey="<?php echo $app->reCaptcha['public_key'];?> "></div>
                </td>
                <span id="captcha_error"></span>
                </tr>
            <?php } else { ?>
            <script type="application/javascript">
            function ChangeCaptcha() {
            $('#captcha_img').attr('src', $('#captcha_img')
                       .attr('src') + '?' + Math.random() );
            }
            </script>
            <tr>
                <td><label class="captcha-text" for="register_captcha">
                  <img id='captcha_img' src="<?php echo $app->BASE_URL('public/modules/register/models/captcha.php');?>"></label>
                  <a style="color:#fcb70f;" href="javascript:void(0)" onclick="ChangeCaptcha();">Get a new code</a>

                </td>
                <td>
                    <input type="text" data-recaptcha="cms" name="register_captcha" id="register_captcha">
                    <span id="captcha_error"></span>

                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <center style="margin-bottom:10px;">
            <input type="submit" name="login_submit" value="Create account!">
        </center>
    </form>
<?php page_footer(); ?>
