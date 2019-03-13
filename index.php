<?php
/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 10/11/2017
 * Time: 3:44 PM
 */
if (file_exists("install") && !file_exists("install/.lock")) {
    header("Location: install");
    die();
}
session_start();
ob_start();
require 'models/controllers/class.controller.php';
require 'models/controllers/settings.php';
$user_logged = $_SESSION['account'];
$route = array();
$files = array();
$route['main'] = isset($_REQUEST['public/views']) ? trim($_REQUEST['public/views']) : '';
$route['account'] = isset($_REQUEST['public/views/account']) ? trim($_REQUEST['public/views/account']) : '';
$route['ranks'] = isset($_REQUEST['public/views/ranks']) ? trim($_REQUEST['public/views/ranks']) : '';
$servername = $app->server_name;
$base_url = $app->BASE_URL('');
require 'public/themes/' . $app->theme . '/views/page.tpl.php';
require 'public/views/header.php';
require 'public/themes/' . $app->theme . '/views/header.php';

$files['main'] = array(
    'Download' => 'public/views',
    'profiler' => 'public/views',
    'Help' => 'public/views',
    'news' => 'public/views',
    'Store' => 'public/views',
);
$files['account'] = array(
    'Register' => 'public/views/account',
    'LogIn' => 'public/views/account',
    'LogOut' => 'public/views/account',
    'Edit' => 'public/views/account',
    'RecoverPassword' => 'public/views/account',
    'Settings' => 'public/views/account',
    'Vote' => 'public/views/account',
    'Tickets' => 'public/views/account'
);
$files['ranks'] = array(
    'CPs' => 'public/views/ranks',
    'Arena' => 'public/views/ranks',
    'Donation' => 'public/views/ranks',
    'Level' => 'public/views/ranks',
    'Money' => 'public/views/ranks',
);
/* Get Ranks */
$ranks_path = !empty($files['ranks'][$route['ranks']]) ? $files['ranks'][$route['ranks']] . '/' : '';
if (array_key_exists($route['ranks'], $files['ranks']) && file_exists($ranks_path . $route['ranks'] . '.php')) {
    require_once($ranks_path . $route['ranks'] . '.php');
} elseif (!file_exists($ranks_path . $route['ranks'] . '.php') && !empty($route['ranks'])) {
    include 'public/views/404.php';
}
/* Get Account */
$account_path = !empty($files['account'][$route['account']]) ? $files['account'][$route['account']] . '/' : '';
if (array_key_exists($route['account'], $files['account']) && file_exists($account_path . $route['account'] . '.php') && !empty($route['account'])) {
    require_once($account_path . $route['account'] . '.php');
} elseif (!file_exists($account_path . $route['account'] . '.php') && !empty($route['account'])) {
    include 'public/views/404.php';
}
$route_path = !empty($files['main'][$route['main']]) ? $files['main'][$route['main']] . '/' : '';
if (array_key_exists($route['main'], $files['main']) && file_exists($route_path . $route['main'] . '.php')) {
    require_once($route_path . $route['main'] . '.php');
} elseif (!file_exists($route_path . $route['main'] . '.php') && !empty($route['main'])) {
    include 'public/views/404.php';
} elseif (empty($route['main']) && (empty($route['account']) && empty($route['ranks']))) {
    include 'public/views/index.php';
}

require 'public/themes/' . $app->theme . '/views/footer.php';

$app->Close_connection();
ob_end_flush();
