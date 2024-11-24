<?php
namespace Connection;

use mysqli;

class ConnectionMariaDB
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $port;
    private $con;
    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     * @param int $port
     */

    public function __construct(
        $host = "localhost",
        $user = "luis",
        $password = "admin",
        $database = "db_jogodobicho_legacy",
        $port = 3306
    ) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }
    /**
     * @return mysqli|bool
     */
    public function connect()
    {

        try {
            $this->con = new mysqli(
                $this->host,
                $this->user,
                $this->password,
                $this->database,
                $this->port
            );

            if ($this->con->connect_error) {
                throw new \Exception("Connection failed: " . $this->con->connect_error);
            }
 
            return $this->con;
        } catch (\Exception $e) {
            echo $e->getMessage();
            header("Location: /pages/erro/erro.php?500");
            die();
        }


    }
}
