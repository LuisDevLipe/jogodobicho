<?php
require 'DB/connect.php';
require_once 'jogodobicho/controllers/Credentials.php';
class Users
{
    private $id;
    private $fullname;
    private $dob;
    private $gender;
    private $mothername;
    private $cpf;
    private $email;
    private $celular;
    private $fixo;
    private $created_at;
    private $updated_at;

    public function __construct($fullname, $dob, $gender, $mothername, $cpf, $email, $celular, $fixo)
    {
        $this->fullname = $fullname;
        $this->dob = $dob;
        $this->$gender = $gender;
        $this->mothername = $mothername;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->celular = $celular;
        $this->fixo = $fixo;
        $this->created_at = time();
        $this->updated_at = time();
    }
    public function setId($id): void  {
        $this->id = $id;
    }

    public static function show($id): bool|mysqli_result
    {
        global $con;
        $sql = "SELECT * FROM Users WHERE id = '$id'";
        $result = mysqli_query(mysql: $con, query: $sql);
        return $result;

    }
    public function showAll(): bool|mysqli_result
    {
        global $con;
        $sql = "SELECT * FROM Users";
        $result = mysqli_query(mysql: $con, query: $sql);
        return $result;
    }

    public function registerUser(): bool
    {
        global $con;
        $created_at = time();
        $updated_at = time();
        $rootuser = false;
        if ($this->show(id: $this->id)) {
            echo new UserAlreadyExistsException()->getMessage();
            die();
        }
        $sql = "INSERT INTO Users
            (fullname , dob, gender, mothername, cpf, email, celular, fixo, created_at, updated_at) 
            VALUES 
            (`$this->fullname`, `$this->dob`, `$this->gender`, `$this->mothername`, `$this->cpf`, `$this->email`, `$this->celular`, `$this->fixo`, `$this->created_at`, `$this->updated_at`)";
        $result = mysqli_query(mysql: $con, query: $sql);
        return $result;

    }

}