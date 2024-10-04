<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/connection/config.php";
include_once $_SERVER["DOCUMENT_ROOT"] .
    "/jogodobicho/exceptions/exceptions.php";
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
    private $con;
    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $config = new ConnectionMariaDB();
        $this->con = $config->connect();
    }
    public function read(): mysqli_result|bool
    {
        $sql = "SELECT * FROM Credentials WHERE username = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }

    protected function create(): mysqli_result|bool
    {

        $sql =
            "INSERT INTO Credentials (username, password,user_id) VALUES (?, ?, ?)";

        $result = $this->con->execute_query(
            query: $sql,
            params: [
                $this->username,
                $this->password,
                $this->user_id
            ]
        );

        return $result;
    }
}
