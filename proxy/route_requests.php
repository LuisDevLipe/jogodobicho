<?php
namespace Router;


class Route_requests
{
    public $uri;

    public function __construct($uri)
    {


        $this->uri = explode('.', $uri)[0];


    }

    public function route()
    {

        switch ($this->uri) {
            case 'login':


                echo $_SERVER['DOCUMENT_ROOT'];
                include_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/controllers/Credential.php";

                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $credential = new \controllers\CredentialController($username, $password);
                    $user = $credential->login();
                    $_POST = [];
                    if (!$user) {
                        session_start();
                        $_SESSION['not_found_user'] = true;
                        session_commit();
                        header("Location: /jogodobicho/pages/login/login.php");
                        exit();

                    }
                    session_start();
                    $_SESSION['not_found_user'] = false;
                    session_commit();
                    header("Location: /jogodobicho/pages/auth-util/TwoFactorAuthentication.php");
                    exit();
                }

                break;

            case 'TwoFactorAuthentication':

                include_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/controllers/TwoFactorAuth.php";
                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["twoFaAnswer"])) {
                    $twoFaAnswerId = $_POST["twoFaAnswer"];
                    $twoFaAnswer = '';
                    switch ($twoFaAnswerId) {
                        case '1':
                            if (isset($_POST["mothername"])) {
                                $twoFaAnswer = $_POST["mothername"];
                            }

                            break;
                        case '2':
                            if (isset($_POST["dob"])) {
                                $twoFaAnswer = $_POST["dob"];
                            }

                            break;
                        case '3':
                            if (isset($_POST["cep"])) {
                                $twoFaAnswer = $_POST["cep"];
                            }

                            break;

                    }
                    session_start();
                    $user_id = $_SESSION["user_id"];
                    session_commit();

                    $newTwoFAInstance = new \controllers\TwoFactorAuthController(user_id: $user_id, twoFaAnswer: $twoFaAnswer, twoFaAnswerId: $twoFaAnswerId);
                    $twoFaVerified = $newTwoFAInstance->verifyTwoFactorAuth();


                    if (!$twoFaVerified) {
                        header("Location: /jogodobicho/pages/auth-util/TwoFactorAuthentication.php");
                        exit();
                    }

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                        var_dump($_POST);
                    }
                    $username = $_SESSION["username"];
                    $session_id = session_id();
                    logNewSuccessfulAuth(
                        username: $username,
                        twoFaAnswer: $twoFaAnswer,
                        session_id: $session_id
                    );
                    session_commit();
                    header("Location: /jogodobicho/");
                    exit();

                }
                break;

            case 'logout':

                if (isset($_POST["logout"])) {
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/jogodobicho/controllers/Credential.php";

                    \controllers\CredentialController::logout();

                    header("Location: /jogodobicho/");
                    exit();
                }
                break;

            case 'cadastro':

                if (isset($_POST["cadastrar"])) {

                    include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/Credential.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/User.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/Address.php";

                    $new_address = new \controllers\AdressController(
                        cep: $_POST["cep"],
                        logradouro: $_POST["logradouro"],
                        numero: $_POST["numero"],
                        cidade: $_POST["cidade"],
                        estado: $_POST["estado"],
                        complemento: $_POST["complemento"],
                        bairro: $_POST["bairro"],
                        pais: $_POST["pais"]
                    );

                    $address_id = $new_address->createAddressAndReturn_id();


                    echo "<script>alert('Endereço cadastrado com sucesso')</script>";

                    $newUser = new \controllers\UserController(
                        fullname: $_POST["name"],
                        dob: $_POST["dob"],
                        gender: $_POST["gender"],
                        mothername: $_POST["filiation-name"],
                        cpf: $_POST["cpf"],
                        email: $_POST["email"],
                        celular: $_POST["celular"],
                        fixo: $_POST["fixo"],
                        address_id: $address_id
                    );

                    $userSaved = $newUser->registerUser();

                    if (!$userSaved) {
                        echo "<script>alert('CPF de Usuário já cadastrado')</script>";
                        header("Location: /jogodobicho/pages/cadastro/cadastro.php");
                        exit();
                    }
                    $newUser_id = $newUser->findUser()["ID"];


                    $newUserCredentials = new \controllers\CredentialController(
                        username: $_POST["username"],
                        password: $_POST["password"]
                    );

                    $newUserCredentials->setUserId($newUser_id);

                    $credentialSaved = $newUserCredentials->registerCredential();

                    if (!$credentialSaved) {
                        echo "<script>alert('Nome de Usuário já cadastrado')</script>";
                        exit();
                    }
                    echo "<script>alert('Usuário cadastrado com sucesso')</script>";
                    header("Location: /jogodobicho/pages/login/login.php");

                    exit();

                }
                break;


        }


    }
}




$uri = $_SERVER['REQUEST_METHOD'] == 'GET' ? $_GET["url"] : $_POST["url"];
$router = new Route_requests($uri);
$router->route();

function logNewSuccessfulAuth($username, $twoFaAnswer, $session_id): void
{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/controllers/UserLog.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userLog = new \controllers\UserLogController(username: $username, twoFaAnswer: $twoFaAnswer, session_id: $session_id);
    $userLog->create();
    session_commit();
}

?>