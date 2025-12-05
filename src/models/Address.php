<?php
namespace models;
require_once $_SERVER["DOCUMENT_ROOT"] . "/connection/config.php";
use Connection\ConnectionMariaDB;

class Address
{
    protected string $cep;
    protected string $logradouro;
    protected string $numero;
    protected string $cidade;
    protected string $estado;
    protected string $complemento;
    protected string $bairro;
    protected string $pais;

    protected static $con;

    public function __construct(
        string $cep,
        string $logradouro,
        string $numero,
        string $cidade,
        string $estado,
        string $complemento,
        string $bairro,
        string $pais


    ) {
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->pais = $pais;


        $config = new ConnectionMariaDB();
        self::$con = $config->connect();
    }

    protected function create(): bool
    {
        $sql = "INSERT INTO address (cep, logradouro, numero, cidade, estado, complemento, bairro, pais) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = self::$con->execute_query(
            query: $sql,
            params: [
                $this->cep,
                $this->logradouro,
                $this->numero,
                $this->cidade,
                $this->estado,
                $this->complemento,
                $this->bairro,
                $this->pais
        
            ]
        );

        return $result;
    }

    

    protected function findIfExists(): \mysqli_result{
        $sql = "SELECT * FROM address WHERE cep = ? AND logradouro = ? AND numero = ? AND cidade = ? AND estado = ? AND complemento = ? AND bairro = ? AND pais = ?";
        $result = self::$con->execute_query(
            query: $sql,
            params: [
                $this->cep,
                $this->logradouro,
                $this->numero,
                $this->cidade,
                $this->estado,
                $this->complemento,
                $this->bairro,
                $this->pais
            ]
        );

        return $result;
    }

}
?>