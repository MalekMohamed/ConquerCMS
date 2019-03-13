<!-- Main side -->
<?php page_header('Account Recover Password','page_register'); ?>
            <form action="#" class="page_form recover-form" method="post" accept-charset="utf-8">
                <table style="width:80%">
                    <tbody>

                    <tr>
                        <td><label for="register_username2">Username</label></td>
                        <td>
                            <input type="text" name="Username" id="register_username2" value="">
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
                        <td><label for="register_npassword">New Password</label></td>
                        <td>
                            <input type="password" name="Password" id="register_npassword" value="">
                            <span id="npassword_error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="register_npassword_confirm">Confirm New password</label></td>
                        <td>
                            <input type="password" name="ConfirmPassword" id="register_npassword_confirm"
                                   value="" onchange="Validate.checkPasswordConfirm()">
                            <span id="npassword_confirm_error"></span>
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
                    </tbody>
                </table>
                <center style="margin-bottom:10px;">
                    <input type="submit"  value="Change Password!">
                </center>
            </form>
<?php page_footer();?>