<?php
require_once('jogodobicho/connection/connectionMySQL.php');
require_once 'jogodobicho/controllers/Users.php';

class Credentials
{
    private $username;
    private $password;
    private $rootuser;
    private $updated_at;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->rootuser = false;
    }
    public function getId(): int{
        global $con;
        $sql = 'SELECT c.user_id , u.id FROM CREDENTIALS c WHERE username = ? JOIN USERS u ON c.user_id = u.id';
        $result = $con->execute_query(query: $sql, params: [$this->username]);
        
        if (!is_int($result)){
            die('Usuário não encontrado');
        }
        return $result;

    }

    public function login(): bool
    {
        global $con;
        $sql = 'SELECT * FROM CREDENTIALS WHERE username = ? AND password = ?';

        $result = $con->execute_query(query: $sql, params: [$this->username, $this->password]);

        if ($result) {
            session_start();
            $_SESSION['username'] = $this->username;
            session_commit();
        
        } else {
            echo 'Usuário ou senha inválidos';
        }
        return $result;
    }
    public function logout(): void
    {
        session_start();
        session_destroy();
        session_commit();
    }
    public function registerCredentials(): bool
    {
        global $con;
        $this->updated_at = time();
        $usernameExists = Users::show();
        $sql = 'INSERT INTO CREDENTIALS (username, password, rootuser, updated_at) VALUES (?, ?, ?, ?)';

        if ($usernameExists) {
            die(new UserAlreadyExistsException()->getMessage());
        }

        $result = $con->execute_query(query: $sql, params: [$this->username, $this->password, $this->rootuser, $this->updated_at]);

        return $result;
    }

}

