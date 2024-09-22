<?php
class UserAlreadyExistsException extends Exception {
    public function __construct($message = "Usuário já existe", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}