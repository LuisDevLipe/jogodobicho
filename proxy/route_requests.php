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
                    
                    logNewSuccessfulAuth();
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


        }


    }
}




$uri = $_SERVER['REQUEST_METHOD'] == 'GET' ? $_GET["url"] : $_POST["url"];
$router = new Route_requests($uri);
$router->route();

function logNewSuccessfulAuth(): void{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/controllers/UserLog.php";
        session_start();
        $userLog = new \controllers\UserLogController(username: $_SESSION["username"]);
        $userLog->create();
        session_commit();
}

?>