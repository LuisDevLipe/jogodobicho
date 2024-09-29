<?php
namespace controllers;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/User.php";
use models\User;
class UserController extends User
{
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
        parent::__construct(
            $fullname,
            $dob,
            $gender,
            $mothername,
            $cpf,
            $email,
            $celular,
            $fixo

        );
        // debug_print_backtrace();
    }

    public function registerUser(): bool
    {
        $user = $this->read();
       
        if ($user->num_rows > 0) {
            // user exists
            return false;
        }
        if ($user->fetch_assoc()["cpf"] === $this->cpf) {
            return false;
        }


        // create user
        $query_result = $this->create();


       // returns the result of the query ( true or false on failure)
        return $query_result;

    }
    /**
     * @param string $cpf
     */
    public function findUser(): bool|array
    {
        $user = $this->read();
        if ($user->num_rows === 0) {
            return false;
        }
        $user = $user->fetch_assoc();
        return $user;
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
