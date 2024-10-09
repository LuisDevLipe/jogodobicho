<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/connection/config.php";

use Connection\ConnectionMariaDB;
use mysqli_result;
class UserLog
{
    protected $id;
    protected $session_id;
    protected $username;
    protected $TwoFa_Answer;
    protected $login_at;
    protected $logout_at;
    protected $con;
    public function __construct($username,$twoFaAnswer,$session_id)
    {
        $this->username = $username;
        $this->TwoFa_Answer = $twoFaAnswer;
        $this->session_id = $session_id;
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
        $queryParam = filter_var($queryParam, FILTER_SANITIZE_STRING);
        $queryParam = filter_var($queryParam, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($queryOption === '--nome') {
            $sql = "SELECT u.fullname, ul.TwoFA_Answer,ul.login_at FROM UserLog ul, Credentials c, Users u where ul.username = c.username AND c.user_id = u.id AND u.fullname LIKE ? ORDER BY ul.login_at DESC";
            $queryParam = "%$queryParam%";
        } else if ($queryOption === '--cpf') {
            $sql = "SELECT u.fullname, ul.TwoFA_Answer,ul.login_at FROM UserLog ul, Credentials c, Users u where ul.username = c.username AND c.user_id = u.id AND u.cpf = ? ORDER BY ul.login_at DESC";
        } else if ($queryOption === '--all') {
            $sql = "SELECT u.fullname, ul.TwoFA_Answer,ul.login_at FROM UserLog ul, Credentials c, Users u where ul.username = c.username AND c.user_id = u.id ORDER BY ul.login_at DESC;";
            
            $result = $this->con->execute_query(query: $sql);

            return $result;
        }
        


        $result = $this->con->execute_query(
            query: $sql,
            params: [$queryParam]
        );
        return $result;
    }
    public function create(): bool
    {
        $sql = "INSERT INTO UserLog (username, session_id,TwoFA_Answer) VALUES (?,?,?)";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, session_id(), $this->TwoFa_Answer]
        );
        return $result;
    }

    public function update(): bool
    {
        $sql = "UPDATE UserLog SET logout_at = NOW() WHERE username = ? AND session_id = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, session_id()]
        );
        return $result;
    }
}

?>