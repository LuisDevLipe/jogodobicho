<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/connection/config.php";

use Connection\ConnectionMariaDB;
use mysqli_result;

class User
{
    protected $id;
    protected $fullname;
    protected $dob;
    protected $gender;
    protected $mothername;
    protected $cpf;
    protected $email;
    protected $celular;
    protected $fixo;

    protected $address_id;

    protected $created_at;
    protected $updated_at;

    protected static $con;
    /**
     * @param int $id
     * @param string $fullname
     * @param string $dob
     * @param string $gender
     * @param string $mothername
     * @param string $cpf
     * @param string $email
     * @param string $celular
     * @param string $fixo
     * @param int $created_at
     * @param int $updated_at
     */
    public function __construct(
        $fullname,
        $dob,
        $gender,
        $mothername,
        $cpf,
        $email,
        $celular,
        $fixo,
        $address_id
    ) {
        $this->fullname = $fullname;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->mothername = $mothername;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->celular = $celular;
        $this->fixo = $fixo;
        $this->address_id = $address_id;
        $this->created_at = time();
        $this->updated_at = time();
        $config = new ConnectionMariaDB();
        self::$con = $config->connect();
    }

    private static function static_connection(): void
    {
        $config = new ConnectionMariaDB();
        self::$con = $config->connect();
    }

    protected function create(): bool
    {
        $sql = "INSERT INTO users (fullname,dob,gender,mothername,cpf,email,celular,fixo,address_id) VALUES (?,?,?,?,?,?,?,?,?)";

        $result = self::$con->execute_query(
            query: $sql,
            params: [
                $this->fullname,
                $this->dob,
                $this->gender,
                $this->mothername,
                $this->cpf,
                $this->email,
                $this->celular,
                $this->fixo,
                $this->address_id,
            ]
        );
        // check if the query was executed or failed
        // dd($result);


        // print error if any
        if ($result === false) {
            echo 'erro ao inserir';
            echo self::$con->error;
        }

        return $result;
    }

    protected function read(): mysqli_result
    {
        $sql = "SELECT * FROM users WHERE cpf = ?";
        $result = self::$con->execute_query(query: $sql, params: [$this->cpf]);

        return $result;
    }

    protected function update(): bool
    {
        return false;
    }
    protected static function delete($ID): bool
    {
        self::static_connection();
        $sql = "DELETE FROM users WHERE ID = ?";
        $result = self::$con->execute_query(query: $sql, params: [$ID]);
        return $result;
    }

    protected function readAll(): mysqli_result
    {
        $sql = "SELECT * FROM users";
        $result = self::$con->execute_query(query: $sql);
        return $result;
    }

    protected function queryUsers($queryParam): mysqli_result
    {
        $sql = "SELECT * FROM users where fullname like ?";
        $result = self::$con->execute_query(query: $sql, params: [$queryParam]);
        return $result;
    }

    protected function read_user_by_email(): mysqli_result
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = self::$con->execute_query(
            query: $sql,
            params: [$this->email]
        );
        return $result;
    }
    public function peekParams()
    {
        $params = [
            "fullname" => $this->fullname,
            "dob" => $this->dob,
            "gender" => $this->gender,
            "mothername" => $this->mothername,
            "cpf" => $this->cpf,
            "email" => $this->email,
            "celular" => $this->celular,
            "fixo" => $this->fixo,
            "address_id" => $this->address_id,
        ];
        return $params;
    }
}
