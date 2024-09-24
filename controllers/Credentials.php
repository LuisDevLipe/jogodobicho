<?php
// namespace CredentialsController;
include "../connection/connectionMySQL.php";
class Credentials
{
    private $user_id;
    private $username;
    private $password;
    private $rootuser;
    private $updated_at = false;
    private $con;
    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $config = new Connection\ConnectionMariaDB();
        $this->con = $config->connect();
    }

    public function login(): bool
    {
        $sql = "SELECT * FROM Credentials WHERE username = ? AND password = ?";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username, $this->password]
        );
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION["username"] = $this->username;
            $_SESSION["password"] = $this->password;
            session_commit();
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        session_start();
        session_destroy();
        session_commit();
    }

    public function getUserId(): int
    {
        $sql =
            "SELECT c.user_id , u.id FROM Credentials c, Users u WHERE c.user_id = u.id AND c.username = ? ";
        $result = $this->con->execute_query(
            query: $sql,
            params: [$this->username]
        );
        return $result->fetch_assoc()["user_id"];
    }
}
