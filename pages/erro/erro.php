<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Este site encontrou um erro</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        :root {
            --primary-color: #192143;
            --jet-black: #0a0a0a;
            --jet-black2: #2d2c2f;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: 4rem;
            font-family: "Montserrat", "Barlow", "Arial";

            color: var(--jet-black);

            h1 {
                font-size: 4rem;
                font-family: "Barlow Condensed";
                font-weight: bold;
                line-height: 6rem;
                color: var(--jet-black2);

                span {
                    color: inherit;
                }
            }

            h2 {
                font-size: 2rem;
                line-height: 3rem;
                font-weight: bold;
                font-family: "Barlow Semi Condensed";
                color: inherit;
            }

            p {
                font-size: 1.2rem;
                line-height: 2.4rem;
                font-weight: regular;
                font-family: "Barlow";
                color: inherit;
            }

            a {
                font-size: 1rem;
                line-height: 1.5rem;
                font-weight: regular;
                font-style: italic;
                font-family: "Montserrat";
                color: var(--primary-color);
                padding: 0.25rem;
            }
        }
    </style>
</head>

<body>
    <?php
    enum Status_code
    {
        case NOT_FOUND;
        case FORBIDDEN;
        case INTERNAL_SERVER_ERROR;
        case BAD_GATEWAY;
        case SERVICE_UNAVAILABLE;
        case GATEWAY_TIMEOUT;


    }


    // get error message
    function get_error_message(Status_code $code): string|array
    {
        return match ($code) {
            Status_code::NOT_FOUND => ["not found", "The requested resource was not found on this server."],
            Status_code::FORBIDDEN => ["forbidden", "You don't have permission to access this resource."],
            Status_code::INTERNAL_SERVER_ERROR => ["internal server error", "The server encountered an internal error and was unable to complete your request."],
            Status_code::BAD_GATEWAY => ["bad gateway", "The server received an invalid response from an upstream server."],
            Status_code::SERVICE_UNAVAILABLE => ["service unavailable", "The server is temporarily unable to service your request due to maintenance downtime or capacity problems."],
            Status_code::GATEWAY_TIMEOUT => ["gateway timeout", "The server did not receive a timely response from an upstream server."],
            default => Status_code::INTERNAL_SERVER_ERROR
        };
    }

    // convert status code to enum
    function get_status_code(int $status): Status_code
    {
        return match ($status) {
            404 => Status_code::NOT_FOUND,
            403 => Status_code::FORBIDDEN,
            500 => Status_code::INTERNAL_SERVER_ERROR,
            502 => Status_code::BAD_GATEWAY,
            503 => Status_code::SERVICE_UNAVAILABLE,
            504 => Status_code::GATEWAY_TIMEOUT,

            default => Status_code::INTERNAL_SERVER_ERROR
        };
    }

    if (isset($_SERVER['REDIRECT_STATUS'])) {

        $status = $_SERVER['REDIRECT_STATUS'];
    } else {

        $status = $_SERVER['QUERY_STRING'];
    }

    if (strlen($status) > 3) {
        $status = 500;
    }


    ?>
    <h1>
        Erro: <span><?= $status ?></span>
        <?= get_error_message(code: get_status_code(status: $status))[0] . PHP_EOL ?>
    </h1>
    <h2><?= get_error_message(code: get_status_code(status: $status))[1] ?></h2>
    <p>Pedimos desculpas pelo inconveniente</p>
    <a href="/jogodobicho/">Voltar ao início do site.</a>
    <br>

    <div style="padding:4rem">

        <p>more info about the issue:</p>
        <p>

            <?php
            echo 'URI: ' . $_SERVER["REQUEST_URI"] . PHP_EOL;
            $query_string = 'no query string was found';
            if (isset($_SERVER["REDIRECT_QUERY_STRING"])) {
                $query_string = $_SERVER["REDIRECT_QUERY_STRING"] . PHP_EOL;

            }
            echo '<br>';
            echo 'QUERY_STRING: ' . $query_string;

            ?>

        </p>
    </div>

</body>

</html>