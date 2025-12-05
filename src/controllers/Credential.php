<?php
namespace controllers;
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/Credential.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/models/UserLog.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/passwordEncrypt/encrypt.php";


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
        // session_start();
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
        $this->unlock_account();
        $_SESSION["username"] = $user["username"];
        $_SESSION['rootuser'] = $user['rootuser'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['isAuthenticated'] = false;

        // LOG USER LOGIN IN UserLog
        // $userLog = new UserLog(username: $user["username"]);
        // $userLog->create();

        return $user;
    }

    public function unlock_account(): bool
    {
        $unlocked = $this->update_unlock_account();
        $_SESSION['account_is_locked'] = false;
        return $unlocked;

    }

    public static function logout(): void
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // LOG USER LOGOUT IN UserLog
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $userLog = new UserLog(username: $username, twoFaAnswer: '', session_id: session_id());
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


    public static function check_if_username_exists($username): string|bool
    {
        $credential = new Credential(username: $username, password: '');
        $user = $credential->read();
        if ($user === null) {
            return false;
        } else if ($user->num_rows === 0) {
            return false;
        }
        $user = $user->fetch_assoc();
        $user_email = $user["username"];
        return $user_email;

    }

    public function update_password(): bool
    {
        $updated_password = $this->update();
        if ($updated_password === null) {
            return false;
        }
        return $updated_password;
    }
}
