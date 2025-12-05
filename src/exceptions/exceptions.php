<?php
namespace exceptions;
use Throwable;
use Exception;
class UserAlreadyExistsException extends Exception
{
    public function __construct(
        $message = "Usuário já existe",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
    /**
     * @param mixed $url
     */
    public function redirect($url = "/pages/erro/erro.php"): void
    {
        header("Location: $_SERVER[DOCUMENT_ROOT] $url");
    }
}
