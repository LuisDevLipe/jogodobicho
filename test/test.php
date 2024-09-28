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
echo "init <br>";
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/Credential.php";
include_once $_SERVER["DOCUMENT_ROOT"] .
    "/jogodobicho/controllers/Credential.php";

$credential = new controllers\CredentialController("admin", "admin");
$credential2 = new controllers\CredentialController("lipe", "0000");
echo "is here <br>";

var_dump($credential->login());
echo "<br>";
var_dump($credential2->login());

echo "<br>bye";

include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/User.php";

echo "padsoadas";
echo "<br>teste<br>";

// if (isset($_POST["cadastrar"]));
include_once $_SERVER["DOCUMENT_ROOT"] .
    "/jogodobicho/controllers/Credential.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/User.php";
echo "dafuq <br>";

$user = new controllers\UserController(
    fullname: "luis",
    dob: date("d-m-Y H:i:s"),
    gender: "M",
    mothername: "nany",
    cpf: "19111450703",
    email: "luis@luis.com",
    celular: "21965762671",
    fixo: "21965762671",
    created_at: time(),
    updated_at: time()
);
echo "pqp";
echo $user->findUser();
$user->registerUser();
$userId = $user->findUser()["id"];
$userCredentials = new controllers\CredentialController(
    username: $_POST["username"],
    password: $_POST["password"]
);

$userCredentials->setUserId($userId);
$userCredentials->registerCredential();
?>
?>

</body>
</html>
