<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/connection/config.php";

use Connection\ConnectionMariaDB;
use mysqli_result;
class UserLog
{
    protected $id;
    protected $session_id;
    protected $username;
    protected $TwoFaAnswer;
    protected $login_at;
    protected $logout_at;
    protected $con;
    public function __construct($username, $twoFaAnswer, $session_id)
    {
        $this->username = $username;
        $this->TwoFaAnswer = $twoFaAnswer;
        $this->session_id = $session_id;
        $this->con = new ConnectionMariaDB();
        $this->con = $this->con->connect();
    }

    public function read(): mysqli_result|bool
    {
        $sql = "SELECT * FROM userLogs WHERE username = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result;
    }
    public function readAll(): mysqli_result|bool
    {
        $sql = "SELECT * FROM userLogs";
        $result = $this->con->execute_query(query: $sql);
        return $result;
    }

    public static function queryUserLogs(
        $queryOption,
        $queryParam
    ): mysqli_result|bool {
        $con = new ConnectionMariaDB();
        $con = $con->connect();
        $queryParam = filter_var($queryParam, FILTER_SANITIZE_STRING);
        $queryParam = filter_var($queryParam, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($queryOption === "--nome") {
            $sql =
                "SELECT u.fullname, ul.TwoFaAnswer,ul.login_at FROM userLogs ul, credentials c, users u where ul.username = c.username AND c.user_id = u.id AND u.fullname LIKE ? ORDER BY ul.login_at DESC";
            $queryParam = "%$queryParam%";
        } elseif ($queryOption === "--cpf") {
            $sql =
                "SELECT u.fullname, ul.TwoFaAnswer,ul.login_at FROM userLogs ul, credentials c, users u where ul.username = c.username AND c.user_id = u.id AND u.cpf = ? ORDER BY ul.login_at DESC";
        } elseif ($queryOption === "--all") {
            $sql =
                "SELECT u.fullname, ul.TwoFaAnswer,ul.login_at FROM userLogs ul, credentials c, users u where ul.username = c.username AND c.user_id = u.id ORDER BY ul.login_at DESC;";

            $result = $con->execute_query(query: $sql);

            return $result;
        }

        $result = $con->execute_query(query: $sql, params: [$queryParam]);
        return $result;
    }
    public function create(): bool
    {
        $sql =
            "INSERT INTO userLogs (username, session_id,TwoFaAnswer) VALUES (?,?,?)";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, session_id(), $this->TwoFaAnswer]
        );
        return $result;
    }

    public function update(): bool
    {
        $sql =
            "UPDATE userLogs SET logout_at = NOW() WHERE username = ? AND session_id = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, session_id()]
        );
        return $result;
    }
}

?>
