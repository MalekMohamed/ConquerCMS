<?php
/**
 * Copyright (c) 2017.  All right reserved to ConquerHub
 */

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 1/7/2017
 * Time: 4:19 AM
 */
session_start();
ob_start();
$user_logged = $_SESSION['admin'];
require '../models/controllers/class.controller.php';
$controller = new controller();
$base_url = $controller->BASE_URL('admin');
require 'client/header.php';
if (!isset($user_logged)) {
    include 'client/pages/login.php';
} else {
    $route = isset($_REQUEST['client/pages']) ? trim($_REQUEST['client/pages']) : '';
    $route_array = array(
        'Settings' => 'client/pages',
        'Files' => 'client/pages',
        'Tickets' => 'client/pages',
        'Posts' => 'client/pages',
        'Comments' => 'client/pages',
        'Database' => 'client/pages',
        'Online' => 'client/pages',
        'Support' => 'client/pages',
        'Store' => 'client/pages',
        'logout' => 'client/pages',
        'index' => 'client/pages',
    );
    /* Get Account */
    $route_path = !empty($route_array[$route]) ? $route_array[$route] . '/' : '';
    if (array_key_exists($route, $route_array) && file_exists($route_path . $route . '.php')) {
        include $route_path . $route . '.php';
    } elseif (!file_exists($route_path . $route . '.php') && !empty($route)) {
        include 'client/pages/404.php';
    } elseif (empty($route)) {
        include 'client/pages/index.php';
    }
}
require 'client/footer.php';
ob_end_flush();
?>
