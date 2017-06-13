<?php
/**
 * Created by PhpStorm.
 * User: haidang
 * Date: 13/06/2017
 * Time: 13:37
 */
ini_set('display_errors', 1);
session_start();

//if (!isset($_SESSION['logged'])) {
//    header('Location: /blog2/login.php', false, 302);
//}

require_once 'Connection.php';

$config = require_once 'config.php';
$mysql = new Connection($config);

$module = null;
if (isset($_GET['module'])) {
    $module = $_GET['module'];
}

switch ($module) {
    case 'user':
        require_once 'admin/user.php';

        break;
    case 'blog':
        require_once 'admin/blog.php';

        break;
    default:
        require_once 'admin/dashboard.php';
}

//echo 'Welcome to admin area';

