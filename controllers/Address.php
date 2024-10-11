<?php
namespace controllers;
require_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/Address.php";
use models\Address;



class AdressController extends Address
{
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

        //clean cep from special characters
        $cep = preg_replace('/[^0-9]/', '', $cep);
        // clean all fields from special characters and html tags and accents
        $logradouro = filter_var($logradouro, FILTER_SANITIZE_STRING);
        $numero = filter_var($numero, FILTER_SANITIZE_STRING);
        $cidade = filter_var($cidade, FILTER_SANITIZE_STRING);
        $estado = filter_var($estado, FILTER_SANITIZE_STRING);
        $complemento = filter_var($complemento, FILTER_SANITIZE_STRING);
        $bairro = filter_var($bairro, FILTER_SANITIZE_STRING);
        $pais = filter_var($pais, FILTER_SANITIZE_STRING);

        parent::__construct(
            $cep,
            $logradouro,
            $numero,
            $cidade,
            $estado,
            $complemento,
            $bairro,
            $pais
        );
    }

    public function createAddressAndReturn_id(): int
    {
        $address = $this->findIfExists();
        if ($address->num_rows > 0) {
            return $address->fetch_assoc()["ID"];
        } else {
            parent::create();
            return self::$con->insert_id;
        }
        


    }
 
}

?>