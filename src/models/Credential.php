<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/connection/config.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/exceptions/exceptions.php";
use Connection\ConnectionMariaDB;
use exceptions\UserAlreadyExistsException;

use \mysqli_result;

new ConnectionMariaDB();
class Credential
{
    protected $user_id;
    protected $username;
    protected $password;
    protected $updated_at;
    private static $con;
    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $config = new ConnectionMariaDB();
        self::$con = $config->connect();
    }
    protected function read(): mysqli_result|bool
    {
        $sql = "SELECT * FROM credentials WHERE username = ?";
        $result = self::$con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }

    protected function create(): mysqli_result|bool
    {

        $sql = "INSERT INTO credentials (username, password,user_id) VALUES (?, ?, ?)";

        $result = self::$con->execute_query(
            query: $sql,
            params: [
                $this->username,
                $this->password,
                $this->user_id
            ]
        );

        return $result;
    }
    protected function update(): bool
    {
        $sql = "UPDATE credentials SET password = ? WHERE username = ?";
        $result = self::$con->execute_query(
            query: $sql,
            params: [$this->password, $this->username]
        );
        return $result;
    }

    protected function update_unlock_account(): bool
    {
        $sql = "UPDATE credentials SET locked_account = 0, login_attempts = 0 WHERE username = ?";
        $result = self::$con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }

}
