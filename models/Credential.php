<?php
namespace models;
include $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/connection/config.php";
use \Connection\ConnectionMariaDB;

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
        $this->updated_at = time();

        $config = new ConnectionMariaDB();
        $this->con = $config->connect();
    }
    public function findUser(): bool|mysqli_result
    {
        $sql = "SELECT * FROM Credentials WHERE username = ? AND password = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, $this->password]
        );
        return $result;
    }
    public function findUserId(): int|bool
    {
        $sql =
            "SELECT c.user_id , u.id FROM Credentials c, Users u WHERE c.user_id = u.id AND c.username = ? ";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }
}
