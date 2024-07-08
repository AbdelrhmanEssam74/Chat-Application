<?php
//NOTE - Database Connection
final class database_connection
{
  private $host = "localhost";
  private $username = "Admin1";
  private $password = "a123";
  private $database = "chat_app";
  private $connection = null;
  public function connect()
  {
    $this->connection = new PDO(
      "mysql:host={$this->host};dbname={$this->database}",
      $this->username,
      $this->password
    );
    return $this->connection;
  }
}
