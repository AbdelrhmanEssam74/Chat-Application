<?php
require 'database_connection.php';

class ChatRooms extends database_connection
{
    private $chat_id;
    private $user_id;
    private $message;
    private $created_on;
    protected $connect;

    public function __construct()
    {
        $database_obj = new database_connection;
        $this->connect = $database_obj->connect();
    }

    public function setChatId($chat_id): void
    {
        $this->chat_id = $chat_id;
    }

    function getChatId()
    {
        return $this->chat_id;
    }

    function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    function getUserId()
    {
        return $this->user_id;
    }

    function setMessage($message): void
    {
        $this->message = $message;
    }

    function getMessage()
    {
        return $this->message;
    }

    function setCreatedOn($created_on): void
    {
        $this->created_on = $created_on;
    }

    function getCreatedOn()
    {
        return $this->created_on;
    }


    function save_chat(): void
    {
        $query = "
		INSERT INTO chatrooms 
			(userid, msg, created_on) 
			VALUES (:userid, :msg, :created_on)
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':userid', $this->user_id);

        $statement->bindParam(':msg', $this->message);

        $statement->bindParam(':created_on', $this->created_on);

        $statement->execute();
    }

    function get_all_chat_data()
    {
        $query = "
		SELECT * FROM chatrooms 
			INNER JOIN chat_user_table 
			ON chat_user_table.user_id = chatrooms.userid 
			ORDER BY chatrooms.id ASC
		";

        $statement = $this->connect->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}