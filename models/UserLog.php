<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/connection/config.php";

use Connection\ConnectionMariaDB;
use mysqli_result;
class UserLog
{
    protected $id;
    protected $username;
    protected $TwoFA_id;
    protected $TwoFa_Answer;
    protected $login_at;
    protected $logout_at;
    protected $con;
    public function __construct($username)
    {
        $this->username = $username;
        $this->con = new ConnectionMariaDB();
        $this->con = $this->con->connect();
    }

    public function read(): mysqli_result|bool
    {
        $sql = "SELECT * FROM UserLog WHERE username = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }
    public function readAll(): mysqli_result|bool
    {
        $sql = "SELECT * FROM UserLog";
        $result = $this->con->execute_query(
            query: $sql
        );
        return $result;
    }

    public function queryUserLogs($queryOption, $queryParam): mysqli_result|bool
    {
        if ($queryOption === '--nome') {
        
            $sql = "SELECT Users.fullname,UserLog.TwoFA_Answer, UserLog.login_at FROM UserLog, Users,Credentials WHERE username LIKE ? ORDER BY UserLog.login_at DESC";
        } else if ($queryOption === '--cpf') {
            $sql = "SELECT Users.fullname,UserLog.TwoFA_Answer, UserLog.login_at FROM UserLog, Users,Credentials WHERE cpf LIKE ? ORDER BY UserLog.login_at DESC";
        } else if ($queryOption === '--all') {
            $sql = "SELECT Users.fullname,UserLog.TwoFA_Answer, UserLog.login_at FROM UserLog, Users,Credentials ORDER BY UserLog.login_at DESC";
            $result = $this->con->execute_query(query: $sql);
            return $result;
        }

        $queryParam = filter_var($queryParam, FILTER_SANITIZE_STRING);
        $queryParam = filter_var($queryParam, FILTER_SANITIZE_SPECIAL_CHARS);
        $queryParam = "%$queryParam%";

        $result = $this->con->execute_query(
            query: $sql,
            params: [$queryParam]
        );
        return $result;
    }
    public function create(): bool
    {
        $sql = "INSERT INTO UserLog (username) VALUES (?)";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }

    public function update(): bool
    {
        $sql = "UPDATE UserLog SET logout_at = NOW() WHERE username = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }
}

?>