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
    private $rootuser;
    private $con;
    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->rootuser = false;
        $this->updated_at = date('d-m-Y h-i-s', time());

        $config = new ConnectionMariaDB();
        $this->con = $config->connect();
    }
    public function read(): bool|mysqli_result
    {
        $sql = "SELECT * FROM Credentials WHERE username = ? AND password = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, $this->password]
        );
        return $result;
    }
    public function readUsername(): mysqli_result
    {
        $sql = "SELECT * FROM Credentials WHERE username = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;

    }

    protected function create(): bool
    {
        $user = $this->readUsername();
        if ($user->num_rows > 0) {

            return false;
        }


        $sql =
            "INSERT INTO Credentials (username, password, rootuser, updated_at,user_id) VALUES (?, ?, ?, ?,?)";

        $this->con->execute_query(
            query: $sql,
            params: [
                $this->username,
                $this->password,
                $this->rootuser,
                $this->updated_at,
                $this->user_id,
            ]
        );

        return true;
    }
}
