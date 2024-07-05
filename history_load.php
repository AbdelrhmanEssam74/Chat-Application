<?php
require 'vendor/autoload.php';
use ChatApp\models\message;

//NOTE - Get all messages from database and convert them into json format 
echo message::all()->toJson();