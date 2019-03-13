/**
 * Validation object for the registration page
 * @package FusionCMS
 * @author Jesper Lindström
 */
var Validate = {
    /**
     * Mark the field as valid
     * @param String field
     */
    valid: function (field, error) {
        var field = $(field.replace("register_", "") + "_error");

        field.html('<img src="' + Config.image_path + 'icons/accept.png" data-tip="' + error + '" />');
    },

    /**
     * Mark the field as invalid
     * @param String field
     * @param String error
     */
    invalid: function (field, error) {
        var field = $(field.replace("register_", "") + "_error");

        if (error.length > 0) {
            field.html('<img src="' + Config.image_path + 'icons/exclamation.png" data-tip="' + error + '" />');
            Tooltip.refresh();
            field.show();
            setTimeout(function () {
                field.fadeOut(1800);
            }, 2000);
        }
        else {
            field.html('<img src="' + Config.image_path + 'icons/exclamation.png" />');
        }
    },

    /**
     * Show loading image
     * @param String field
     */
    ajax: function (field, error) {
        var field = $(field.replace("register_", "") + "_error");

        field.html('<img src="' + Config.image_path + 'ajax_small.gif" />');

    },

    /**
     * Validate username
     */
    checkUsername: function () {
        var field_name = "#register_username",
            field = $(field_name),
            value = field.val();

        // Length check
        if (value.length < 4 || value.length > 32) {
            this.invalid(field_name, "Username must be between 4 and 32 characters long");
        }

        // Alpha-numeric check
        else if (!/^[a-z0-9]+$/i.test(value)) {
            this.invalid(field_name, "Username may only contain alphabetical and numerical characters");
        }

    },

    /**
     * Validate email
     */
    checkEmail: function () {
        var field_name = "#register_email",
            field = $(field_name),
            value = field.val();

        // Email check
        if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(value)) {
            this.invalid(field_name, "Email must be a valid email");
        }
        else {
            this.valid(field_name, "Email is available");
        }
        if (value.length < 4) {
            this.invalid(field_name, "Email must be More Than 4 characters long");
        }

    },

    /**
     * Validate password
     */
    checkPassword: function () {
        var field_name = "#register_password",
            field = $(field_name),
            value = field.val();

        if (value.length < 6) {
            this.invalid(field_name, "Password must be longer than 6 characters");
        }
        else {
            this.valid(field_name);
        }
    },
    /**
     * Validate answer
     */
    checkanswer: function () {
        var field_name = "#register_answer",
            field = $(field_name),
            value = field.val();

        if (value.length < 1 || value.length > 50) {
            this.invalid(field_name, "This field can\`t be empty");
        }
        else {
            this.valid(field_name, "Field is ok");
        }
    },/*
    checkCaptcha: function () {
        var field_name = "#register_captcha",
            field = $(field_name),
            value = field.val();
        if (value != $('#captcha_value').val()) {
            this.invalid(field_name, "Wrong Captcha");
        } else {
            this.valid(field_name, "Field is ok");
        }
    },*/
    checkquestion: function () {
        var field_name = "#register_question",
            field = $(field_name),
            value = field.val();

        if (value.length < 1 || value.length > 50) {
            this.invalid(field_name, "This field can\`t be empty");
        }
        else {
            this.valid(field_name, "Field is ok");
        }
    },
    /**
     * Validate password confirm
     */
    checkPasswordConfirm: function () {
        var field_name = "#register_password_confirm",
            field = $(field_name),
            value = field.val();

        if (value !== $("#register_password").val()) {
            this.invalid(field_name, "Passwords doesn't match");
        }
        else {
            this.valid(field_name);
        }
    },


}
var Login_Validate = {
    /**
     * Mark the field as valid
     * @param String field
     */
    valid: function (field, error) {
        var field = $(field.replace("login_", "") + "_error");

        field.html('<img src="' + Config.image_path + 'icons/accept.png" data-tip="' + error + '" />');
    },

    /**
     * Mark the field as invalid
     * @param String field
     * @param String error
     */
    invalid: function (field, error) {
        var field = $(field.replace("login_", "") + "_error");

        if (error.length > 0) {
            field.html('<img src="' + Config.image_path + 'icons/exclamation.png" data-tip="' + error + '" />');
            Tooltip.refresh();
            field.show();
            setTimeout(function () {
                field.fadeOut(1800);
            }, 2000);
        }
        else {
            field.html('<img src="' + Config.image_path + 'icons/exclamation.png" />');
        }
    },

    /**
     * Show loading image
     * @param String field
     */
    ajax: function (field, error) {
        var field = $(field.replace("login_", "") + "_error");

        field.html('<img src="' + Config.image_path + 'ajax_small.gif" />');

    },

}