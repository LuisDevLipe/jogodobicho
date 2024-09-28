<?php
namespace models;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/connection/config.php";

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
    protected $created_at;
    protected $updated_at;

    private $con;
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
        $created_at,
        $updated_at
    ) {
        $this->fullname = $fullname;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->mothername = $mothername;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->celular = $celular;
        $this->fixo = $fixo;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->con = new ConnectionMariaDB();
        $this->con = $this->con->connect();
    }

    protected function create(): bool
    {
        $userExists = $this->read();
        if ($userExists->num_rows > 0) {
            return false;
        }
        echo "<br>the user does not exist<br>";
        $sql = "INSERT INTO Users
                (fullname,dob,gender,mothername,cpf,email,celular,fixo,created_at,updated_at)
            VALUES
                (?,?,?,?,?,?,?,?,?,?)";
        echo "dopaksdoksa";
        echo "<br><pre> Params for create";
        var_dump($this->peekParams());
        echo "</pre><br>";
        var_dump(date(format: 'd-m-Y h:i:s', timestamp: $this->created_at));
        var_dump(
            date(format: 'd-m-Y h:i:s', timestamp: $this->updated_at)
        );
        $result = $this->con->execute_query(query: $sql, params: [
            $this->fullname,
            $this->dob,
            $this->gender,
            $this->mothername,
            $this->cpf,
            $this->email,
            $this->celular,
            $this->fixo,
            date(format: 'd-m-Y h:i:s', timestamp: $this->created_at),
            date(format: 'd-m-Y h:i:s', timestamp: $this->updated_at)
        ]);

        echo "<br><pre> Result from create";
        var_dump($result);
        echo "</pre><br>";
        return true;
    }

    protected function read(): mysqli_result
    {
        $sql = "SELECT * FROM Users WHERE cpf = ?";
        $result = $this->con->execute_query(query: $sql, params: [$this->cpf]);
        echo "<br><pre> Result from read";
        var_dump($result);
        echo "</pre><br>";
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
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
        return $params;
    }
}
