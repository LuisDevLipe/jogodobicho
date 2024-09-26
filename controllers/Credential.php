<?php
namespace controllers;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/Credential.php";

use models\Credential;
class CredentialController extends Credential
{
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function login(): bool | array
    {
        $user = $this->findUser();
        

        if ($user->num_rows === 0) {
            return false; // false
        } 
        $user = $user->fetch_assoc();
            session_start();
            $_SESSION["username"] = $user["username"];
            session_commit();
            return $user;
        
    }

    public static function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
        session_commit();
    }
}
