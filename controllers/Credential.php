<?php
namespace controllers;
include $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/models/Credential.php";

use models\Credential;
class CredentialController extends Credential
{

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function login(): bool
    {
        $user = $this->findUser();
        if (!$user) {
            return false;
        } else {
            session_start();
            $_SESSION["username"] = $this->username;
            session_commit();
            return true;
        }
    }

    public static function logout(): void
    {
        session_start();
        session_destroy();
        session_commit();
    }

}
