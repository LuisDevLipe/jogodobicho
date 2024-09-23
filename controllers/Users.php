<?php
namespace UsersController;
// include '../connection/connectionMySQL.php';
// use const Connection\CON as conec;
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

    public static function show($id)
    {
        debug_print_backtrace();
        global $con;
            $sql = "SELECT * FROM Users WHERE id = $id";
            echo $sql;
            $result = mysqli_query(mysql: $con, query: $sql);
            echo '<br>result:'; 
            return $result;

    }
    // public function showAll(): bool| array
    // {
    //     $con = Connection\CON;
    //     $sql = "SELECT * FROM Users";
    //     $result = mysqli_query(mysql: $con, query: $sql);
    //     return $result;
    // }

    // public function registerUser(): bool
    // {
    //     $con = Connection\CON;
    //     $created_at = time();
    //     $updated_at = time();
    //     $rootuser = false;
    //     if ($this->show(id: $this->id)) {
    //         die('erro no registro');
    //         // die(new UserAlreadyExistsException()->getMessage());
    //     }
    //     $sql = "INSERT INTO Users
    //         (fullname , dob, gender, mothername, cpf, email, celular, fixo, created_at, updated_at) 
    //         VALUES 
    //         (`$this->fullname`, `$this->dob`, `$this->gender`, `$this->mothername`, `$this->cpf`, `$this->email`, `$this->celular`, `$this->fixo`, `$this->created_at`, `$this->updated_at`)";
    //     $result = mysqli_query(mysql: $con, query: $sql);
    //     return $result;

    // }

}