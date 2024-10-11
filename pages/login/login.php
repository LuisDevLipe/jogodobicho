<?php 
    function credentialError():bool {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['not_found_user']) && $_SESSION['not_found_user'] === true) {
            session_commit();
            return true;
        }
        session_commit();
        return false;

    }
?>
<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated'] === true):?>
    <script>confirm('you are already logged in'); </script>
    <script>window.location.href = '/jogodobicho/'</script>
    
<?php endif; session_commit();?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Jogo do Bicho Online</title>
    <link rel="stylesheet" href="/jogodobicho/pages/login/login.css">
    
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/components/navbar/navbar.php' ?>

    <main>
        <form action="/jogodobicho/proxy/route_requests.php" method="post" name='login'>
            <h1>Login</h1>
            <fieldset>
                <label for="username">Usuário</label>

                <input type="text" name="username" id="username" required>
            </fieldset>
            <fieldset>

                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required>
                <?php if(credentialError()): ?>
                    <span class="error">Usuário ou senha incorretos</span>
                <?php endif; ?>
            </fieldset>
            <fieldset>

                <button type="submit">Entrar</button>
            </fieldset>
                <a href="/jogodobicho/pages/auth-util/recuperar-senha.php">Esqueci minha senha</a>
            <a href="/jogodobicho/pages/cadastro/cadastro.php">Cadastrar</a>
<input type="text" name="url" hidden value="<?= urlencode(string: basename(path: __FILE__))?>">
        </form>
        
    </main>
    <script>lucide.createIcons()</script>
</body>
</html>
