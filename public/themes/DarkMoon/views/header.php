<script type="text/javascript">
    function addComment(id) {
        var comment = $('#comment_field_' + id).val();
        console.log(comment);
        $.ajax({
            url: Config.URL + 'models/controllers/class.controller.php?request=post-comment',
            type: 'post',
            data: {id: id, comment: comment},
            success: function (res) {
                console.log(res);
                var json_res = jQuery.parseJSON(res);
                if (json_res.status == 'success') {
                    var field = '<div class="comment"><div class="comment_date">' + json_res.date + ' </div><a data-tip="View Profile" href="' + Config.URL + 'Profile/' + json_res.user + ' "><img src="' + Config.URL + 'public/img/faces/1.jpg" width="40" height="40" alt="' + json_res.user + '`s Avatar"></a><a class="comment_author" data-tip="View Profile" href="' + Config.URL + 'Profile/' + json_res.user + '" title="' + json_res.user + ' ">' + json_res.user + ' </a> ' + json_res.comment + ' </div > ';
                    $('.comments_area').append(field);
                    $('.comment_form').val('');
                    $('.comment_form').text('');
                } else {
                    if (json_res.field == 'All') {
                        UI.alert(json_res.msg);
                    } else {
                        Validate.invalid(json_res.field, json_res.msg);
                    }
                }
            }
        });
    }
     Config.Theme.next = '>';
    Config.Theme.previous = '';
</script>
<body class="<?php echo $app->theme; ?>">
<div id="popup_bg"></div>
<!-- confirm box -->
<div id="confirm" class="popup">
    <h1 class="popup_question" id="confirm_question"></h1>

    <div class="popup_links">
        <a href="javascript:void(0)" class="popup_button" id="confirm_button"></a>
        <a href="javascript:void(0)" class="popup_hide" id="confirm_hide" onClick="UI.hidePopup()">
            Cancel
        </a>
        <div style="clear:both;"></div>
    </div>
</div>
<!-- alert box -->
<div id="alert" class="popup">
    <h1 class="popup_message" id="alert_message"></h1>

    <div class="popup_links">
        <a href="javascript:void(0)" class="popup_button" id="alert_button">Okay</a>
        <div style="clear:both;"></div>
    </div>
</div>
<div id="container">
    <header>
        <h1><a class="logo-head" href="" title="Welcome to <?php echo $app->server_name; ?>"><img class="logo"
                                                                               src="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/images/logo.png'); ?>"
                                                                               width="212" height="262"/></a></h1>
        <div id="top-menu" class="menu">
            <ul>
                    <?php
                    foreach ($menu as $link) {
                        ?>
                        <li><a href="<?php echo $link['href']; ?>" direct="0"><?php echo $link['text']; ?></a></li>
                    <?php } ?>
                <li class="menu-sep"></li>
            </ul>
        </div>
    </header>


    <div id="slider_bg" style="display:block;">
        <div id="slider">
            <?php
            foreach ($slider as $slide) {
                ?>
                <a><img src="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/images/slides/' . $slide['image'] . ''); ?>"
                         title="<?php echo $slide['text']; ?> "/></a>
            <?php } ?>
        </div>
    </div>
    <div id="main">
        <div class="middle_background"></div>
        <!-- Sidebar -->
        <?php require 'public/themes/' . $app->theme . '/views/side.php'; ?>
        <!-- Sidebar.End -->
        <aside id="right">
            <div id="wlc_msg" class="welcome_to closeable" style="">
                <a href="javascript:void(0)" class="close-btn"></a>
                <div class="body"><span>Welcome to <?php echo $app->server_name; ?> community</span>
                    <p>
                        We Have Best Developers. We Give You Best Experience Of The PVP Game Server <br>
                        Best Free Game Invite Your Friends And Have Fun With Us  <br>
                        <a href="<?php echo $app->BASE_URL('Account/Register'); ?>">Register</a> Now and enjoy !
                    </p>
                </div>
            </div>