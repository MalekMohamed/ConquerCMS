<!DOCTYPE html>
<html lang="gb" class="gb">
<head>
    <title><?php echo $app->server_name; ?></title>
    <link rel="shortcut icon"
          href="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/images/favicon.ico'); ?>"/>

    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!-- Search engine related -->
    <meta name="description"
          content="<?php echo $app->server_name; ?> | Conquer Online Private Server "/>
    <meta name="keywords"
          content="conquer online, private server conquer online, conquerhub, pvp, mop, co, <?php echo $app->server_name; ?>, conquer private server, private, server"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!-- Load styles -->
    <link type="text/css" rel="stylesheet" href="<?php echo $app->BASE_URL('public/css/default.css'); ?>"/>
    <?php
    if (!empty($paths)) {
        foreach ($paths as $path) { ?>
            <link type="text/css" rel="stylesheet"
                  href="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/css/' . $path); ?>"/>
            <?php
        }
    } else {
        ?>
        <link type="text/css" rel="stylesheet"
              href="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/css/main.css'); ?>"/>
        <link type="text/css" rel="stylesheet"
              href="<?php echo $app->BASE_URL('public/themes/' . $app->theme . '/css/cms.css'); ?>"/>

        <?php
    }
    ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $app->BASE_URL('public/css/selectbox.css'); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo $app->BASE_URL('public/css/news.css'); ?>"/>
    <!-- Load scripts -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script type="text/javascript" src="<?php echo $app->BASE_URL('public/js/require.js'); ?>"></script>
    <script type="text/javascript">var isIE = false;</script>
    <!--[if IE]>
    <script type="text/javascript">isIE = true;</script><![endif]-->
    <script type="text/javascript">
        if (!window.console)
            var console = {
                log: function () {
                }
            };
        var Config = {
            URL: "<?php echo $app->BASE_URL('');?>",
            Servername: '<?php echo $app->server_name; ?>',
            image_path: "<?php echo $app->BASE_URL('public/img/');?>",
            language: "english",
            UseFusionTooltip: 1,
            Slider: {
                interval: 5000,
                effect: "slide",
                id: "slider_bg"
            },

            voteReminder: 0,
            Theme: {
                next: "Next",
                previous: "Previous"
            }
        };
        var scripts = [
            "<?php echo $app->BASE_URL('public/js/ui.js');?>",
            "<?php echo $app->BASE_URL('public/js/flux.min.js');?>",
            "<?php echo $app->BASE_URL('public/js/jquery.placeholder.min.js');?>",
            "<?php echo $app->BASE_URL('public/js/jquery.sort.js');?>",
            "<?php echo $app->BASE_URL('public/js/jquery.transit.min.js');?>",
            , "<?php echo $app->BASE_URL('public/js/ajax.js');?>"
            , "<?php echo $app->BASE_URL('public/js/validate.js');?>"];
        require(scripts, function () {
            $(document).ready(function () {
                UI.initialize();
            });
        });
        function Vote(msg) {
            UI.initialize();
            UI.alert(msg);
        }
    </script>
</head>
<?php
if (isset($_SESSION['vote']) && isset($user_logged) && $app->enableVote == true) {
$outVote = str_replace('in', 'out', $app->vote_link);
$referSite = $_SERVER['HTTP_REFERER'];
if (isset($_SERVER['HTTP_REFERER'])) {
if ($referSite == $outVote && $_SESSION['vote']['user'] == $user_logged && $_SESSION['vote']['status'] == 0 && (time() - $_SESSION['vote']['time']) < 600 && $_SESSION['vote']['ip'] == get_client_ip_server()) {
$_SESSION['vote']['status'] = 1;
if ($app->addVote() == true) {
$app->file_log('admin/logs/votes-log.txt', $_SESSION['vote']);
?>
<script>Vote('You have successfully voted From [<?php echo $referSite;?>] to our Server <br> reward will be delivered shortly');</script>
<?php
} else {
    echo '<script>Vote(\'Something went wrong while Voting\');</script>';
}
}
}
}
?>
