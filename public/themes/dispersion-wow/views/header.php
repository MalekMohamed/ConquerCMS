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
     Config.Theme.next = '';
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
<section id="wrapper">

    <div id="header">

        <div class="top_container">
            <?php if ($route['account'] != 'LogIn') { ?>
                <div class="login_box_top">
                    <div class="actions_cont">
                        <?php if (isset($user_logged)) {
                            $user = $app->get_user_by_name($user_logged)[0];
                            $character = $app->get_char_by_owner($user_logged);
                            ?>
                            <div class="account_info">
                                <!-- Avatar -->
                                <div class="avatar_top">
                                    <img src="<? echo $app->BASE_URL('public/img/faces/' . $character['Face']); ?>.jpg"
                                         width="44" height="44"/>
                                    <span></span>
                                </div>
                                <!-- Avatar . End -->
                                <!-- Welcome & VP/DP -->
                                <div class="left">
                                    <p>Welcome back, <span><?php echo $character['Name']; ?></span>!</p>
                                    <div class="vpdp">
                                        <div class="vp">
                                            <img src="<? echo $app->BASE_URL('public/img/icons/lightning.png'); ?>"
                                                 align="absmiddle" width="12" height="12"/> Gold
                                            <span><?php echo number_format($character['Money']); ?></span>
                                        </div>
                                        <div class="dp">
                                            <img src="<? echo $app->BASE_URL('public/img/icons/coins.png'); ?>"
                                                 align="absmiddle" width="12" height="12"/> CPS
                                            <span><?php echo number_format($character['ConquerPoints']) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Welcome & VP/DP . End-->
                                <div class="right">
                                    <a href="<?php echo $app->BASE_URL('Account/Settings'); ?>" class="nice_button">User
                                        panel</a>
                                    <a href="<?php echo $app->BASE_URL('Account/Vote'); ?>" class="nice_button">Vote</a>
                                    <a href="<?php echo $app->BASE_URL('Account/LogOut'); ?>" class="nice_button">Log
                                        out</a>
                                </div>
                                <!-- Account Panel & Logout -->
                            </div>
                        <?php } else { ?>
                            <div class="login_form_top">
                                <form action="" method="post" class="login-form" align="center">
                                    <input type="text" name="Username" value="" id="register_username"
                                           placeholder="Username...">
                                    <span id="username_error"></span>
                                    <input type="password" name="Password" value="" id="register_password"
                                           placeholder="Password...">
                                    <span id="password_error"></span>
                                    <input type="submit" value="Login" class="nice_button"/>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="top_menu">
                <ul id="top_menu">
                    <?php
                    foreach ($menu as $link) {
                        ?>
                        <li><a href="<?php echo $link['href']; ?>" direct="0"><?php echo $link['text']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>


    </div>


    <div class="sword"></div>

    <div class="top_border"></div>
    <div id="main">
        <!-- Sidebar -->
        <?php require 'public/themes/' . $app->theme . '/views/side.php'; ?>
        <!-- Sidebar.End -->
        <aside id="right">
            <?php if (empty($route['account']) && empty($route['ranks'])) { ?>
            <section id="slider_bg" style="display:block;">
                <div id="slider">
                    <?php
                    foreach ($slider as $slide) {
                        ?>
                        <a><img src="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/images/slides/' . $slide['image'] . ''); ?>"
                                width="1357" height="443" title="<?php echo $slide['text']; ?> "/></a>
                    <?php } ?>

                </div>
                <h1 id="news_title"><p>Latest News</p></h1>
            </section>
<?php } ?>