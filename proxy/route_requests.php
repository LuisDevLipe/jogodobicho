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

               
                // <script>confirm('you are already logged in'); </script>
                echo $_SERVER['DOCUMENT_ROOT'];
                include_once $_SERVER['DOCUMENT_ROOT'] . "/jogodobicho/controllers/Credential.php";

                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $credential = new \controllers\CredentialController($username, $password);
                    $user = $credential->login();
                    if (!$user) {
                        header("Location: /jogodobicho/pages/login/login.php");
                        exit();

                    }

                    header("Location: /jogodobicho/pages/auth-util/TwoFactorAuthentication.php");
                    exit();
                }

                break;

            case 'TwoFactorAuthentication':
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


?>