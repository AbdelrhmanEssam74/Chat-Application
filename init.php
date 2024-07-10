<?php
session_start();
date_default_timezone_set("Europe/Sofia");
# Routes
define("AppURL", "http://localhost/chat-App/");
$templates = 'include/template/'; // templates directory
$authentication = 'authentication/'; // authentication directory
$css = 'ar/css/'; // css directory
$js = 'ar/js/'; // javascript directory
$database = 'database/'; // database directory
$vender = 'vendor/';
$ChatRoom = AppURL . 'Chat Room.php';
