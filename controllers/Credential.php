<?php
namespace controllers;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/Credential.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/UserLog.php";

use models\Credential;
use models\UserLog;
class CredentialController extends Credential
{
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function login(): bool|array
    {
        $user = $this->read();

        if ($user->num_rows === 0) {
            return false; // false
        }
        $user = $user->fetch_assoc();
        session_start();
        $_SESSION["username"] = $user["username"];
        $_SESSION['rootuser'] = $user['rootuser'];
        session_commit();

        // LOG USER LOGIN IN UserLog
        $userLog = new UserLog(username: $user["username"]);
        $userLog->create();
        return $user;
    }

    public static function logout(): void
    {
        session_start();
        // LOG USER LOGOUT IN UserLog
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $userLog = new UserLog(username: $username);
            $userLog->update();
            
        }

        // destroy session
        session_unset();
        session_destroy();
        // close session
        session_commit();
        // refresh page to reset session variables
        header("Refresh:0");
    }
    /**
     * @param int $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function registerCredential(): bool
    {
        $user = $this->readUsername();
        if ($user->num_rows > 0) {
            // username already exists
            return false;
        }

        // create user
        $query_result = $this->create();
        return $query_result;
    }

    public function peekParams(): void
    {
        $params = [
            "username" => $this->username,
            "password" => $this->password,
            "user_id" => $this->user_id,
            "updated_at" => $this->updated_at,

        ];
        ;
    }
}
