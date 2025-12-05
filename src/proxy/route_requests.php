<?php
namespace Router;

class Route_requests
{
    public $uri;

    public function __construct($uri)
    {
        $this->uri = explode(".", $uri)[0];
    }

    public function route()
    {
        switch ($this->uri) {
            case "login":
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                if (isset($_SESSION["user_id"])) {
                    header("Location: /index.php?success=auth");
                    exit();
                }
                include_once $_SERVER["DOCUMENT_ROOT"] .
                    "/controllers/Credential.php";

                if (
                    $_SERVER["REQUEST_METHOD"] === "POST" &&
                    isset($_POST["username"]) &&
                    isset($_POST["password"])
                ) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $credential = new \controllers\CredentialController(
                        username: $username,
                        password: $password
                    );
                    $user = $credential->login();

                    $_POST = [];
                    if (!$user) {
                        header("Location: /pages/login/login.php?error=auth");
                        exit();
                    }

                    header(
                        "Location: /pages/auth-util/TwoFactorAuthentication.php"
                    );
                    exit();
                }

                break;

            case "TwoFactorAuthentication":
                include_once $_SERVER["DOCUMENT_ROOT"] .
                    "/controllers/TwoFactorAuth.php";
                if (
                    $_SERVER["REQUEST_METHOD"] === "POST" &&
                    isset($_POST["twoFaAnswer"])
                ) {
                    $twoFaAnswerId = $_POST["twoFaAnswer"];
                    $twoFaAnswer = "";
                    switch ($twoFaAnswerId) {
                        case "1":
                            if (isset($_POST["mothername"])) {
                                $twoFaAnswer = $_POST["mothername"];
                            }

                            break;
                        case "2":
                            if (isset($_POST["dob"])) {
                                $twoFaAnswer = $_POST["dob"];
                            }

                            break;
                        case "3":
                            if (isset($_POST["cep"])) {
                                $twoFaAnswer = $_POST["cep"];
                            }

                            break;
                    }
                    session_start();
                    $user_id = $_SESSION["user_id"] ?? null;
                    session_commit();

                    if (!$user_id) {
                        header("Location: /pages/login/login.php?error=auth");
                        exit();
                    }

                    $newTwoFAInstance = new \controllers\TwoFactorAuthController(
                        user_id: $user_id,
                        twoFaAnswer: $twoFaAnswer,
                        twoFaAnswerId: $twoFaAnswerId
                    );
                    $twoFaVerified = $newTwoFAInstance->verifyTwoFactorAuth();
                    if (
                        isset($_SESSION["account_is_locked"]) &&
                        $_SESSION["account_is_locked"] === true
                    ) {
                        header(
                            "Location: /pages/auth-util/TwoFactorAuthentication.php?error=locked"
                        );
                        exit();
                    }
                    if (!$twoFaVerified) {
                        header(
                            "Location: /pages/auth-util/TwoFactorAuthentication.php?error=auth2fa"
                        );
                        exit();
                    }

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $username = $_SESSION["username"];
                    $session_id = session_id();
                    logNewSuccessfulAuth(
                        username: $username,
                        twoFaAnswer: $twoFaAnswer,
                        session_id: $session_id
                    );

                    session_commit();

                    header("Location: /?success=auth");
                    die();
                }

                break;

            case "logout":
                if (isset($_POST["logout"])) {
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/Credential.php";

                    \controllers\CredentialController::logout();

                    header("Location: /?success=logout");
                    exit();
                }
                break;

            case "cadastro":
                // sanitize every inupt from the $_POST variable, to prevent SQL injection
                foreach ($_POST as $key => $value) {
                    $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                }

                require_once $_SERVER["DOCUMENT_ROOT"] .
                    "/functions/validations.php";

                // remover caracteres especiais do celular
                $_POST["celular"] = preg_replace(
                    "/[^0-9]/",
                    "",
                    $_POST["celular"]
                );
                $_POST["fixo"] = preg_replace("/[^0-9]/", "", $_POST["fixo"]);

                // remover caracteres especiais do cep
                $_POST["cep"] = preg_replace("/[^0-9]/", "", $_POST["cep"]);
                // remover caracteres especiais do cpf
                $_POST["cpf"] = preg_replace("/[^0-9]/", "", $_POST["cpf"]);
                // validar cpf
                if (!validarCPF($_POST["cpf"])) {
                    header("Location: /pages/cadastro/cadastro.php?error=cpf");
                    exit();
                }
                // username deve conter exatos 6 caracteres alfabeticos
                if (!validarUsername($_POST["username"])) {
                    header(
                        "Location: /pages/cadastro/cadastro.php?error=username"
                    );
                    exit();
                }

                // senha deve conter exatos 8 caracteres alfabeticos
                if (!validarSenha($_POST["password"])) {
                    header(
                        "Location: /pages/cadastro/cadastro.php?error=password"
                    );
                    exit();
                }

                // senhas conferem
                if ($_POST["password"] !== $_POST["passwordConfirm"]) {
                    header(
                        "Location: /pages/cadastro/cadastro.php?error=passwordConfirmation"
                    );
                    exit();
                }

                // validar se aceitou os termos
                if (!isset($_POST["termos"])) {
                    header(
                        "Location: /pages/cadastro/cadastro.php?error=termos"
                    );
                    exit();
                }

                if (isset($_POST["cadastrar"])) {
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/Credential.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/User.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/Address.php";

                    if (!isset($_POST["termos"])) {
                        header(
                            "Location: /pages/cadastro/cadastro.php?error=termos"
                        );
                        exit();
                    }
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
                    $userExists = $newUser->findUser();
                    if ($userExists) {
                        header(
                            "Location: /pages/cadastro/cadastro.php?error=userExists"
                        );
                        exit();
                    }
                    $newUserCredentials = new \controllers\CredentialController(
                        username: $_POST["username"],
                        password: $_POST["password"]
                    );

                    $credentialExists = $newUserCredentials::check_if_username_exists(
                        username: $_POST["username"]
                    );
                    if ($credentialExists) {
                        header(
                            "Location: /pages/cadastro/cadastro.php?error=usernameExists"
                        );
                        exit();
                    }

                    if (!$userExists && !$credentialExists) {
                        $newUser->registerUser();
                        $newUserCredentials->setUserId(
                            user_id: $newUser->findUser()["ID"]
                        );
                        $newUserCredentials->registerCredential();
                    }
                    header("Location: /pages/login/login.php?success=register");
                    exit();
                }
                break;

            case "recuperar-senha":
                if (isset($_POST["username"]) && isset($_POST["useremail"])) {
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/Credential.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/User.php";
                    $user = \controllers\CredentialController::check_if_username_exists(
                        username: $_POST["username"]
                    );
                    if (!$user) {
                        header(
                            "Location: /pages/auth-util/recuperar-senha.php?error=userNotFound"
                        );
                        exit();
                    }
                    $email = \controllers\UserController::check_if_email_exists(
                        email: $_POST["useremail"]
                    );
                    if (!$email) {
                        header(
                            "Location: /pages/auth-util/recuperar-senha.php?error=emailNoMatch"
                        );
                        exit();
                    }
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION["username"] = $_POST["username"];
                    session_commit();
                    header(
                        "Location: /pages/auth-util/recuperar-senha-form.php?"
                    );
                    exit();
                }
                header("Location: /pages/erro/erro.php?500");
                break;
            case "new-password-form":
                if (isset($_POST["reset"]) && isset($_POST["password"])) {
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/Credential.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/User.php";
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/passwordEncrypt/encrypt.php";
                    $newPassword = $_POST["password"];
                    echo $newPassword;

                    $newUserCredentials = new \controllers\CredentialController(
                        username: $_POST["username"],
                        password: $newPassword
                    );
                    $updated_password = $newUserCredentials->update_password();
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    session_destroy();
                    session_commit();
                    if (!$updated_password) {
                        header(
                            "Location: /pages/auth-util/recuperar-senha-form.php?error=passwordReset"
                        );
                        exit();
                    } else {
                        header(
                            "Location: /pages/login/login.php?success=passwordReset"
                        );
                        exit();
                    }
                }
                header("Location: /pages/erro/erro.php?500");
                break;
            case "delete-user":
                error_reporting(E_ALL);
                ini_set("display_errors", 1);
                if (isset($_POST["delete_user"])) {
                    include_once $_SERVER["DOCUMENT_ROOT"] .
                        "/controllers/User.php";

                    $user_id = $_POST["delete_user"];
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (session_status() == "PHP_SESSION_NONE") {
                        session_start();
                    }
                    if ($_SESSION["user_id"] == $user_id) {
                        header(
                            "Location: /pages/private/consulta_usuarios.php?error=deleteSelf"
                        );

                        exit();
                    }
                    $user_was_deleted = \controllers\UserController::delete_user(
                        $user_id
                    );
                    if (!$user_was_deleted) {
                        header(
                            "Location: /pages/private/consulta_usuarios.php?error=delete"
                        );

                        exit();
                    } else {
                        header(
                            "Location: /pages/private/consulta_usuarios.php?success=delete"
                        );

                        exit();
                    }
                }
                header("Location: /pages/erro/erro.php?500");
                break;

            default:
                header("Location: /pages/erro/erro.php?404");
                exit();
        }
        exit();
    }
}

$uri = $_SERVER["REQUEST_METHOD"] == "GET" ? $_GET["url"] : $_POST["url"];
$router = new Route_requests($uri);
$router->route();

function logNewSuccessfulAuth($username, $twoFaAnswer, $session_id): void
{
    include_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/UserLog.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userLog = new \controllers\UserLogController(
        username: $username,
        twoFaAnswer: $twoFaAnswer,
        session_id: $session_id
    );
    $userLog->create();
    session_commit();
}

?>
