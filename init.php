<?php
session_start();
date_default_timezone_set("Europe/Sofia");
# Routes
const AppURL = "http://localhost/chat-App/";
$templates = 'include/template/'; // templates directory
$authentication = 'authentication/'; // authentication directory
$css = 'ar/css/'; // css directory
$js = 'ar/js/'; // javascript directory
$img = 'ar/images/'; // images directory
$database = 'database/'; // database directory
$vendor = 'vendor/';
$ChatRoom = AppURL . 'Chat Room.php';
$profile = AppURL . 'Profile.php';