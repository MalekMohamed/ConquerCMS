<!DOCTYPE html>
<html class="ajax_loader">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured ADMIN theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo $base_url; ?>/assets/images/favicon_1.ico">
    <title><?php echo $controller->server_name; ?></title>

    <meta name="theme-color" content="#07cf1f"/>
    <!-- DataTables -->
    <link href="<?php echo $base_url; ?>/assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base_url; ?>/assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/css/gaming.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/plugins/summernote/summernote.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.css" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/plugins/ladda-buttons/css/ladda-themeless.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet"
          type="text/css">
    <!-- Custom box css -->
    <link href="<?php echo $base_url; ?>/assets/plugins/custombox/css/custombox.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="<?php echo $base_url; ?>/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $base_url; ?>/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo $controller->BASE_URL('admin/assets/css/custome.css');?>" rel="stylesheet" type="text/css"/>
    <style>
        .dataTables_wrapper {
            width: 100%;
        }
    </style>
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


</head>

<?php if (!isset($user_logged)) { ?>
<body class="register-bg">
<?php } else { ?>
<body class="fixed-left">
<?php } ?>
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="index.html" class="logo glowing-logo green-neon"><?php echo $controller->server_name;?></a>

            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <?php if (isset($user_logged)) {
                        $character = $controller->get_char_by_owner($user_logged);
                        ?>
                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown top-menu-item-xs">
                                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                      <img src="<?php echo $controller->BASE_URL('public/img/faces/'.$character['Face']);?>.jpg" alt="user" style="border-radius: 60%;">
                                </a>
                                <ul class="dropdown-menu">

                                    <li><a href="<?php echo $base_url; ?>/Settings"><i class="ti-settings m-r-10 text-custom"></i>
                                            Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $base_url; ?>/Logout"><i class="ti-power-off m-r-10 text-danger"></i>
                                            Logout</a></li>
                                </ul>
                            </li>
                        </ul> <?php } ?>
                    <div class="pull-right">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->
    <?php if (isset($user_logged)) { ?>
        <div class="left side-menu">

            <div class="sidebar-inner slimscrollleft">

                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>

                        <li class="text-muted menu-title">Navigation</li>
                        <li>
                            <a href="<?php echo $base_url;?>/index" data-hasevent="1" direct="0" class="waves-effect "><i class="fa fa-home"></i>
                                <span> Dashboard </span></a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url;?>/Support" data-hasevent="1" direct="0" class=" waves-effect"><i class="fa fa-envelope"></i>
                                <span> Support </span></a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url;?>/Settings" data-hasevent="1" direct="0" class=" waves-effect"><i class="fa fa-cogs"></i>
                                <span> Settings </span></a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url;?>/Store" data-hasevent="1" direct="0" class="waves-effect "><i class="fa fa-shopping-cart"></i>
                                <span> Store </span></a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa  fa-file-text"></i> <span>  Logs (txt)  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo $base_url;?>/Files/Admin">Admin Panel Logs</a></li>
                                <li><a href="<?php echo $base_url;?>/Files/Votes">Votes Logs</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $base_url;?>/Online" data-hasevent="1" direct="0" class="waves-effect "><i class="fa fa-users"></i>
                                <span> Online </span></a>
                        </li>
                        <li>
                            <a href="<? echo $base_url;?>/Database" data-hasevent="1" direct="0" class="waves-effect "><i class="fa fa-database"></i>
                                <span> Database </span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa  fa-newspaper-o"></i> <span>  News Panel </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo $base_url;?>/Posts">Posts</a></li>
                                <li><a href="<?php echo $base_url;?>/Comments">Comments</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            </side-bar>
        </div>
    <?php } ?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
