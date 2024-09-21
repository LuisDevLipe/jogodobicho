<?php
require_once('/jogodobicho/connection/connectionMySQL.php');

class User {
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
    
    public function __construct($id,$fullname,$dob,$gender,$mothername,$cpf,$email,$celular,$fixo){
        $this->id = $id;
        $this->fullname = $fullname;
        $this->dob = $dob;
        $this->gender = $gender ;
        $this->mothername = $mothername ;
        $this->cpf = $cpf ;
        $this->email = $email ;
        $this->celular = $celular ;
        $this->fixo = $fixo ;
    
    }
    public function create():bool{
        global $con;

        $this->created_at = time();
        $this->updated_at = time();

        $sql = 'INSERT INTO USERS (fullname, dob,gender,mothername,cpf,email,celular,fixo, created_at, updated_at) VALUES 
        ($this->fullname,
        $this->dob,
        $this->gender
        $this->mothername
        $this->cpf
        $this->email
        $this->celular
        $this->fixo
        $this->created_at
        $this->updated_at)';

        $result = $con->execute_query(query: $sql);
        
        return $result;
    }
}