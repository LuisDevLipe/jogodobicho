<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ola</h1>
<?php

// include dirname(__DIR__) . '/test2/test_include.php';
echo 'init <br>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/jogodobicho/models/Credential.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/jogodobicho/controllers/Credential.php';
use models\Credential;
use controllers\CredentialController;

$credential = new CredentialController('admin', 'admin');
$credential2 = new CredentialController('lipe', '0000');
echo 'is here <br>';

var_dump($credential->login());
echo '<br>';
var_dump($credential2->login()   );

echo '<br>bye';

?>

</body>
</html>
