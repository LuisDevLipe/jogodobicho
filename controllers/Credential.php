<?php
namespace controllers;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/Credential.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/UserLog.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/passwordEncrypt/encrypt.php";


use models\Credential;
use models\UserLog;
use controllers\passwordEncrypt\Encrypt;
class CredentialController extends Credential
{
    private $unhashedPassword;
    private $hashPassword;
    public function __construct($username, $password)
    {
        $this->unhashedPassword = $password;
        $hashPassword = new Encrypt(password: $password);
        $this->hashPassword = $hashPassword->encrypt();

        if ($this->hashPassword === false) {
            throw new \Exception(message: "Error hashing password");
        }
        parent::__construct(username: $username, password: $this->hashPassword);
    }

    public function login(): bool|array
    {
        $user = $this->read();

        if ($user->num_rows === 0) {
            return false; // false
        }
        $user = $user->fetch_assoc();
        $verifyPassword = Encrypt::verify(password: $this->unhashedPassword, hash: $user["password"]);

        if (!$verifyPassword) {
            return false;
        }
        session_start();
        $_SESSION["username"] = $user["username"];
        $_SESSION['rootuser'] = $user['rootuser'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['isAuthenticated2FA'] = false;
        $_SESSION['twoFaAnswer'] = null;
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
        $user = $this->read();
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
