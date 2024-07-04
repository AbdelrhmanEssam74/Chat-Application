<?php
require 'vendor/autoload.php';

use ChatApp\Chat;

/**
 * This is the core of the events driven from client actions. It handles receiving new connections, reading/writing to those connections, closing the connections, and handles all errors from your application.
 */

use Ratchet\Server\IoServer;

$server = IoServer::factory(new Chat, 8080);
$server->run();
