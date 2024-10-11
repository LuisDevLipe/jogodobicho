<?php
namespace controllers;

include_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/connection/config.php";

use Connection\ConnectionMariaDB;

class TwoFactorAuthController
{
    protected $user_id;
    protected $login_attempts;
    protected $account_is_locked;
    protected $twoFaAnswer;
    protected $twoFaAnswerId;

    private $con;

    public function __construct($user_id, $twoFaAnswerId, $twoFaAnswer)
    {
        $this->user_id = $user_id;
        $this->twoFaAnswerId = $twoFaAnswerId;
        $this->twoFaAnswer = $twoFaAnswer;

        $this->con = new ConnectionMariaDB();
        $this->con = $this->con->connect();

        $this->login_attempts = $this->getLoginAttempts();
        $this->account_is_locked = $this->getLockedAccount();
    }

    public function verifyTwoFactorAuth(): bool
    {
        $this->account_is_locked = $this->getLockedAccount();

        
        if ($this->account_is_locked) {
            session_start();
            $_SESSION['account_is_locked'] = true;
            session_commit();
            return false;
        }

        $twoFAFieldName = self::getTwoFAFieldName(twoFaAnswerId: $this->twoFaAnswerId);
        $user_id = $this->user_id;

        if ($twoFAFieldName === 'cep') {
            $query_user_address_id = "SELECT address_id FROM users WHERE id = ?";
            $result = $this->con->execute_query($query_user_address_id, params: [$user_id]);
            $address_id = $result->fetch_assoc()['address_id'];
            $query = "SELECT $twoFAFieldName FROM address WHERE id = ?";
            $result = $this->con->execute_query($query, params: [$address_id]);
        } else {
            $query = "SELECT $twoFAFieldName FROM users WHERE id = ?";
            $result = $this->con->execute_query($query, params: [$user_id]);
        }



        $twoFaAnswer = $result->fetch_assoc()[$twoFAFieldName];

        if ($twoFaAnswer <> $this->twoFaAnswer) {
            $this->setLoginAttempts();

            return false;
        }
        session_start();
        $_SESSION['isAuthenticated'] = true;
        $_SESSION['account_is_locked'] = false;
        session_commit();
        return true;

    }

    public function setLoginAttempts(): void
    {
        $this->login_attempts++;
        $query = "UPDATE credentials SET login_attempts = ? WHERE user_id = ?";
        $result = $this->con->execute_query($query, params: [$this->login_attempts, $this->user_id]);

        if ($this->login_attempts >= 3) {
            $this->lockAccount();
        }
    }
    public function getLoginAttempts(): int|bool
    {
        $user_id = $this->user_id;
        $query = "SELECT login_attempts FROM credentials WHERE user_id = ?";
        $result = $this->con->execute_query($query, params: [$user_id]);

        return $result->num_rows > 0 ? $result->fetch_assoc()['login_attempts'] : false;
    }

    public function lockAccount(): void
    {
        $query = "UPDATE credentials SET locked_account = 1 WHERE user_id = ?";
        $result = $this->con->execute_query($query, params: [$this->user_id]);
       
        

    }
    public function getLockedAccount(): bool
    {
        $user_id = $this->user_id;
        $query = "SELECT locked_account FROM credentials WHERE user_id = ?";
        $result = $this->con->execute_query($query, params: [$user_id]);

  
        return $result->fetch_assoc()['locked_account'];

    }

    protected static function getTwoFAFieldName($twoFaAnswerId): string
    {
        $twoFaFieldName = '';
        switch ($twoFaAnswerId) {
            case '1':
                $twoFaFieldName = 'mothername';
                break;
            case '2':
                $twoFaFieldName = 'dob';
                break;
            case '3':
                $twoFaFieldName = 'cep';
                break;
        }
        return $twoFaFieldName;
    }



}
?>