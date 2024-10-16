<?php

function isUserAuthenticated(): bool
{
    $userIsAuthenticated = false;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (
        isset($_SESSION["isAuthenticated"]) &&
        $_SESSION["isAuthenticated"] === true
    ) {
        $userIsAuthenticated = true;
    }

    session_commit();
    return $userIsAuthenticated;
} ?>
<nav class="main-navigation closed">
    <link rel="stylesheet" href='/jogodobicho/components/navbar/navbar.css'>
    <script rel="stylesheet" src="/jogodobicho/public/js/lucide.dev.js"></script>
    <span class="toggle"><i data-lucide="menu"></i></span>
    <a href="/jogodobicho/">Jogo Do Bicho Online</a>
    <div class="sub-menu-items">
        <!-- <a href="/jogodobicho/pages/placar-de-lideres/">Placar de Líderes</a> -->
        <?php
        session_start();
        if (isUserAuthenticated() && $_SESSION["rootuser"] == 1): ?>
            <a href='/jogodobicho/pages/private/system_log.php'>log do sistema</a>
            <a href='/jogodobicho/pages/private/consulta_usuarios.php'>Consulta usuários</a>
        <?php endif;
        ?>

        </div>
        <div class="menu-items">
            <a href="#" class="jogar-btn">Jogar <i data-lucide="dices"></i></a>
            <a href="#">Meus Jogos</a>
            <?php
            if (isUserAuthenticated()): ?>
            <a href='#'>Bem vindo de volta <?= $_SESSION["username"] ?>.</a>
        <?php else: ?>
            <a href="/jogodobicho/pages/login/login.php/" target="_self">Bem vindo, Visitante!</a>
        <?php endif;
            session_commit();
            ?>
        <?php
        session_start();
        if (isUserAuthenticated()): ?>
            <form method='post' name='logout' action='/jogodobicho/proxy/route_requests.php'>
                <input type="text" name="url" hidden value="<?= urlencode(
                    string: "logout"
                ) ?>">
                <button type='submit' name="logout" value="logout">Desconectar</button>
            </form>
        <?php else: ?>
            <a href='/jogodobicho/pages/login/login.php' class='login-btn'>Login/Cadastro <i
                    data-lucide='circle-user-round'></i></a>
        <?php endif;
        session_commit();
        ?>




    </div>
    <script src="/jogodobicho/components/navbar/scripts.js" defer></script>
    <script rel='text/javascript' src='/jogodobicho/public/js/main.js'></script>
    <link rel="stylesheet" href='/jogodobicho/public/css/toast.css'>
</nav>
