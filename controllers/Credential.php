<?php
require_once('/jogodobicho/connection/connectionMySQL.php');

class Credential {
    private $username;
    private $password;
    private $rootuser;
    private $updated_at;
    
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->rootuser = false;
    }

    public function login($username, $password): void {
        global $con;
        $sql = 'SELECT * FROM CREDENTIALS WHERE username = ? AND password = ?';

        $result = $con->execute_query(query: $sql, params: [$username, $password]);

        if ($result){
            session_start();
            $_SESSION['username'] = $username;
            session_commit();
        } else {
            echo 'Usuário ou senha inválidos';
        }
    }
    public function logout(): void {
        session_start();
        session_destroy();
        session_commit();
    }
    public function register($username, $password): bool {
        global $con;
        $this->updated_at = time();
        $usernameExists = $this->getUsername(username: $username);
        $sql = 'INSERT INTO CREDENTIALS (username, password, rootuser, updated_at) VALUES (?, ?, ?, ?)';

        if ($usernameExists)
        $result = $con->execute_query(query: $sql, params: [$username, $password, $this->rootuser, $this->updated_at]);

        if ($result){
            echo 'Usuário cadastrado com sucesso';
        } else {
            echo 'Erro ao cadastrar usuário';
        }
        return $result;
    }

    protected function getUsername($username):string {
        global $con;
        $sql = 'SELECT username FROM CREDENTIALS WHERE username = ?';

        $result = $con->execute_query(query: $sql, params: [$username]);

        return $result;
    }
}

