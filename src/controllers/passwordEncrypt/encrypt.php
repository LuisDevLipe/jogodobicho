<?php

namespace controllers\passwordEncrypt;

class Encrypt
{
    public static function verify($password, $hash): bool
    {
        return password_verify(password: $password, hash: $hash);
    }
    private $password;
    protected $hash;

    public function __construct($password)
    {

        $this->password = $password;

        $this->hash = $this->encrypt();
    }

    public function encrypt(): string|bool
    {

        return password_hash(
            password: $this->password,
            algo: PASSWORD_BCRYPT,
            options: ['cost' => 12]
        );
    }



}


?>