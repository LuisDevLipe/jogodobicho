<!DOCTYPE html>
<?php
session_start();
if ($_SESSION["username"]):?>
    <script>confirm('you are already logged in'); </script>
<?php endif; session_commit();?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Jogo do Bicho Online</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="/jogodobicho/components/navbar/navbar.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

<nav class="main-navigation closed">
		<span class="toggle"><i data-lucide="menu"></i></span>
		<a href="/jogodobicho/">Jogo Do Bicho Online</a>
		<div class="sub-menu-items">
			<a href="/jogodobicho/pages/placar-de-lideres/">Placar de Líderes</a>
		</div>
		<div class="menu-items">
			<a href="#" class="jogar-btn">Jogar <i data-lucide="dices"></i></a>
			<a href="#">Meus Jogos</a>
			<a href="/jogodobicho/pages/login/login.php" class="login-btn">Login/Cadastro <i data-lucide="circle-user-round"></i></a>
		</div>
	</nav>
	<script src="/jogodobicho/components/navbar/scripts.js" defer></script>

    <main>
        <form action="#" method="post" name='login'>
            <h1>Login</h1>
            <fieldset>
                <label for="username">Usuário</label>

                <input type="text" name="username" id="username" required>
            </fieldset>
            <fieldset>

                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required>
            </fieldset>
            <fieldset>

                <button type="submit">Entrar</button>
            </fieldset>
                <a href="/jogodobicho/pages/auth-util/recuperar-senha.php">Esqueci minha senha</a>
            <a href="/jogodobicho/pages/cadastro/cadastro.php">Cadastrar</a>

        </form>
        <?php
        include_once $_SERVER["DOCUMENT_ROOT"] .
            "/jogodobicho/controllers/Credential.php";
        use controllers\CredentialController;
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $credential = new CredentialController($username, $password);
            $user = $credential->login();
            if (!$user) {
                echo "<p>Usuário ou senha inválidos</p>";
            } else {
                header("Location: /jogodobicho/");
            }
        }
        ?>
    </main>
    <script>lucide.createIcons()</script>
</cript
</html>
