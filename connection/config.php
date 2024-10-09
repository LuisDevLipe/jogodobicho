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
        $user = "root",
        $password = "",
        $database = "jogodobicho",
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
        $this->con = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database,
            $this->port
        );
        if (mysqli_connect_errno()) {
            exit("an eror has ocurred" . mysqli_connect_error());
        }

        return $this->con;
    }
}
