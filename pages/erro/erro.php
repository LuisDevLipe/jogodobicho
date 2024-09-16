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
            --jet-black:#0a0a0a;
            --jet-black2:#2d2c2f;
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
            > h1 {
                font-size:4rem ;
                font-family: "Barlow Condensed";
                font-weight: bold;
                line-height: 2rem;
                color: var(--jet-black2);
                span {
                    color: inherit;
                }
            }
             > h2 {
                font-size: 2rem;
                line-height: 3rem;
                font-weight: bold;
                font-family: "Barlow Semi Condensed";
                color: inherit;
            }

            > p {
                font-size: 1.2rem;
                line-height:2.4rem ;
                font-weight: regular;
                font-family: "Barlow";
                color: inherit;
            }
            > a {
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
    <h1>Erro: <span><?php echo $erro.statusCode ?></span></h1>
    <p><?php echo $erro.message ?></p>
    <h2>Este página encontra-se temporariamente indisponível.</h2>
    <p>Entre em contato com o suporte ou tente novamente mais tarde.
        <p>Pedimos desculpas pelo inconveniente</p>
        <a href="/jogodobicho/">Voltar ao início do site.</a>
    </p>

</body>
</html>
