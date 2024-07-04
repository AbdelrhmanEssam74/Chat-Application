<?php

namespace ChatApp;

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
   * @param ConnectionInterface $from    The connection from which the message was received
   * @param string              $message The received message
   */
  public function onMessage(ConnectionInterface $from, $message)
  {
    echo $message;
    foreach ($this->clients as $client) : // for each through all the clients that are currently connected in the server and send a message 
      if ($client !== $from) :
        $client->send($message);
      endif;
    endforeach;
    // store the message in the DB
    message::create([
      "text" => $message
    ]);
  }

  /**
   * Called when a connection is closed.
   *
   * @param ConnectionInterface $connection The closed connection
   */
  public function onClose(ConnectionInterface $connection)
  {
    $this->clients->detach($connection);
    echo "Connection {{$connection->resourceId}} has disconnected\n";
  }

  /**
   * Called when an error occurs on a connection.
   *
   * @param ConnectionInterface $connection The connection on which the error occurred
   * @param \Exception          $e          The error exception
   */
  public function onError(ConnectionInterface $connection, \Exception $e)
  {
    echo "Error : {$e->getMessage()}";
    $connection->close();
  }
}
