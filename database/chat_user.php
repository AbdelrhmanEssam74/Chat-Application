<?php

require 'database_connection.php';

class ChatUser extends database_connection
{
    private $userId;
    private $username;
    private $userEmail;
    private $userPassword;
    private $userProfile;
    private $userStatus;
    private $userCreatedOn;
    private $userVerificationCode;
    private $userLoginStatus;
    private $connect;

    public function __construct()
    {
        $database_obj = new database_connection;
        $this->connect = $database_obj->connect();
    }

    public function setUserId($userid = null)
    {
        if ($userid == null) {
            $this->userId = uniqid();
        } else {
            $this->userId = $userid;
        }
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function setUserProfile($userProfile)
    {
        $this->userProfile = $userProfile;
    }

    public function getUserProfile()
    {
        return $this->userProfile;
    }

    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }

    public function getUserStatus()
    {
        return $this->userStatus;
    }

    public function setUserCreatedOn($userCreatedOn)
    {
        $this->userCreatedOn = $userCreatedOn;
    }

    public function getUserCreatedOn()
    {
        return $this->userCreatedOn;
    }

    public function setUserVerificationCode($userVerificationCode)
    {
        $this->userVerificationCode = $userVerificationCode;
    }

    public function getUserVerificationCode()
    {
        return $this->userVerificationCode;
    }

    public function setUserLoginStatus($userLoginStatus): void
    {
        $this->userLoginStatus = $userLoginStatus;
    }

    public function getUserLoginStatus()
    {
        return $this->userLoginStatus;
    }

    /**
     *
     * @param mixed $character
     * @return string
     */
    function make_avatar($character): string
    {
        $path = "../ar/images/" . $this->getUserId() . ".png";
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);

        $font = '../ar/font/arial.ttf';

        imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }

    /**
     * Summary of get_user_data_by_email
     * @return mixed
     */
    function get_user_data_by_id(): mixed
    {
        $query = "
		SELECT * FROM chat_user_table 
		WHERE user_id = :id
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':id', $this->userId);

        if ($statement->execute()) {
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }

    /**
     * @return mixed
     */
    function get_user_data_by_email(): mixed
    {
        $query = "
		SELECT * FROM chat_user_table 
		WHERE user_email = :user_email
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_email', $this->userEmail);

        if ($statement->execute()) {
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }
    /**
     * Summary of save_data
     * @return bool
     */
    function save_data(): bool
    {
        $query = "
		INSERT INTO chat_user_table (user_id , username, user_email, user_password, user_profile, user_status, user_created_on, user_verification_code) 
		VALUES ( :id , :user_name, :user_email, :user_password, :user_profile, :user_status, :user_created_on, :user_verification_code)
		";
        $statement = $this->connect->prepare($query);

        $statement->bindParam(':id', $this->userId);
        $statement->bindParam(':user_name', $this->username);
        $statement->bindParam(':user_email', $this->userEmail);
        $statement->bindParam(':user_password', $this->userPassword);
        $statement->bindParam(':user_profile', $this->userProfile);
        $statement->bindParam(':user_status', $this->userStatus);
        $statement->bindParam(':user_created_on', $this->userCreatedOn);
        $statement->bindParam(':user_verification_code', $this->userVerificationCode);
        return $statement->execute();
    }

    /**
     * Summary of is_valid_email_verification_code
     * @return bool
     */
    function is_valid_email_verification_code(): bool
    {
        $query = "
		SELECT * FROM chat_user_table 
		WHERE user_verification_code = :user_verification_code
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_verification_code', $this->userVerificationCode);

        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Summary of enable_user_account
     * @return bool
     */
    function enable_user_account(): bool
    {
        $query = "
		UPDATE chat_user_table 
		SET user_status = :user_status 
		WHERE user_verification_code = :user_verification_code
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_status', $this->userStatus);

        $statement->bindParam(':user_verification_code', $this->userVerificationCode);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Summary of update_user_login_data
     * update user login status
     * @return bool
     */
    function update_user_login_data(): bool
    {
        $query = "
		UPDATE chat_user_table 
		SET user_login_status = :user_login_status 
		WHERE user_id = :user_id
		";
        $statement = $this->connect->prepare($query);
        $statement->bindParam(':user_login_status', $this->userLoginStatus);
        $statement->bindParam(':user_id', $this->userId);
        return $statement->execute();
    }

    /**
     * Summary of get_user_all_data
     * @return array
     */
    public function get_user_all_data(): array
    {
        $query = "
		SELECT * FROM chat_user_table 
		";

        $statement = $this->connect->prepare($query);

        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /**
     * @param $id
     * @param $username
     * @param $email
     * @return int
     */
    public function update_user_data($id, $username, $email): int
    {
        $query = "UPDATE chat_user_table 
              SET username = :username, user_email = :email 
              WHERE user_id = :id";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->rowCount();
    }

}
