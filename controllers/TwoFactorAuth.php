<?php
namespace controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/models/Credential.php";
use models\Credential;

class TwoFactorAuthController
{
    protected $user_id;
    protected $login_attempts;
    protected $twoFaAnswer;
    protected $twoFaAnswerId;

    public function __construct($user_id, $twoFaAnswerId, $twoFaAnswer)
    {
        $this->user_id = $user_id;
        $this->twoFaAnswerId = $twoFaAnswerId;
        $this->twoFaAnswer = $twoFaAnswer;
        $this->login_attempts = 0;
    }

    public function verifyTwoFactorAuth():bool{


        

        $result = false;
        return $result;
    }
    
    public function setLoginAttempts($login_attempt = 1)
    {
        $this->login_attempts += $this->login_attempts + $login_attempt;

        if ($this->login_attempts >= 3) {
            $this->lockAccount();
        }
    }

    public function lockAccount()
    {
        // $credential = new Credential();
        // $credential->lockAccount($this->user_id);
    }




 
}
?>