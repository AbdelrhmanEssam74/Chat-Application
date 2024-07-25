<?php

namespace ChatApp;

require dirname(__DIR__) . '/database/chat_user.php';
require 'vendor/autoload.php';
//NOTE - This is an interface provided by the Ratchet library.
//NOTE -  It defines the methods that a class must implement to act as a message component 
use Ratchet\MessageComponentInterface;

//NOTE - It defines the methods that a class must implement to represent a connection in a Ratchet server. The connection interface allows you to interact with individual client connections, such as sending data or closing the connection
use Ratchet\ConnectionInterface;
use ChatApp\models\message;
class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    /**
     * Called when a new connection is opened.
     *
     * @param ConnectionInterface $connection The newly opened connection
     */
    public function onOpen(ConnectionInterface $connection)
    {
        $this->clients->attach($connection);
        echo "New Connection! " . $connection->resourceId . "\n";
    }

    /**
     * Called when a message is received from a connection.
     *
     * @param ConnectionInterface $from The connection from which the message was received
     * @param string $msg The received message
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg);
        $user_obj = new \ChatUser();
        $user_obj->setUserId($msg->user_id);
        $user_data = $user_obj->get_user_data_by_id();
        $username = $user_data['username'];
        $data['date'] = date("Y-m-d h:i");
        switch ($msg->type) {
            case 'message':
                foreach ($this->clients as $client) : // for each through all the clients that are currently connected in the server and send a message
                    if ($client == $from) :
                        $data['from'] = "Me";
                    else:
                        $data['from'] = $username;
                    endif;
                    $data['message'] = $msg->msg;
                    $client->send(json_encode($data));
                endforeach;
                // store the message in the DB
                message::create([
                    "text" => $msg->msg,
                    "sender" => $msg->user_id,
                    "receiver" => $msg->receiver]);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Called when a connection is closed.
     *
     * @param ConnectionInterface $conn The closed connection
     */
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {{$conn->resourceId}} has disconnected\n";
    }

    /**
     * Called when an error occurs on a connection.
     *
     * @param ConnectionInterface $connection The connection on which the error occurred
     * @param \Exception $e The error exception
     */
    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        echo "Error : {$e->getMessage()}";
        $connection->close();
    }
}
