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
        $fixo
    ) {
        $this->fullname = $fullname;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->mothername = $mothername;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->celular = $celular;
        $this->fixo = $fixo;
        $this->created_at = time();
        $this->updated_at = time();
        $this->con = new ConnectionMariaDB();
        $this->con = $this->con->connect();
    }

    protected function create(): bool
    {
         
       
        $sql = "INSERT INTO Users
                (fullname,dob,gender,mothername,cpf,email,celular,fixo)
            VALUES
                (?,?,?,?,?,?,?,?)";
       
        $result = $this->con->execute_query(query: $sql, params: [
            $this->fullname,
            $this->dob,
            $this->gender,
            $this->mothername,
            $this->cpf,
            $this->email,
            $this->celular,
            $this->fixo
        ]);
      
        return $result;
    }

    protected function read(): mysqli_result
    {
        $sql = "SELECT * FROM Users WHERE cpf = ?";
        $result = $this->con->execute_query(query: $sql, params: [$this->cpf]);
        
        return $result;
    }
    protected function readAll(): mysqli_result
    {
        $sql = "SELECT * FROM Users";
        $result = $this->con->execute_query(query: $sql);
        return $result;
    }

    protected function queryUsers($queryParam): mysqli_result
    {
        $sql = "SELECT * FROM Users where fullname like ?";
        $result = $this->con->execute_query(query: $sql, params: [$queryParam]);
        return $result;
    }
    
    // public function peekParams()
    // {
    //     $params = [
    //         "fullname" => $this->fullname,
    //         "dob" => $this->dob,
    //         "gender" => $this->gender,
    //         "mothername" => $this->mothername,
    //         "cpf" => $this->cpf,
    //         "email" => $this->email,
    //         "celular" => $this->celular,
    //         "fixo" => $this->fixo
    //     ];
    //     return $params;
    // }
}
