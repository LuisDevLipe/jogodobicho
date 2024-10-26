<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="/pages/auth-util/RecuperarSenha.css">
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/components/navbar/navbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/components/acessibilidade/acessibilidade.php' ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define(constant_name: 'USERNAME', value: $_SESSION['username']);
session_commit();
$_SESSION['useremail'] = $_POST['useremail'];
?>

<body>
    <main id="AlterarSenha">

        <form action='/proxy/route_requests.php' method='POST' name="recuperar-senha-form">
            <div>
                <h1>Recuperar senha</h1>
            </div>
            <input type='text' name='url' hidden value='new-password-form'>
            <input type='text' name='username' hidden value='<?= USERNAME ?>'>
            <fieldset>
                <label for="password">Nova senha </label>
                <input type="password" name="password" id='password' placeholder="Nova senha" required minlength="8"
                    maxlength="8" onchange="validarSenha(this.value,this)">
            </fieldset>
            <fieldset>
                <label for="passwordConfirm">Confirme a senha</label>
                <input type="password" name="passwordConfirm" placeholder="Confirme a senha" required minlength="8"
                    maxlength="8" onchange="validarSenhaConfirmacao(this.value,this)">
            </fieldset>
            <fieldset>
                <button type='submit' name='reset' value='reset'>Resetar senha</button>
            </fieldset>
        </form>
    </main>

</body>
<script>
    lucide.createIcons();
    function validarSenha(senha, el, length = 8) {
        if (senha.length !== length) {
            jsToastMessage(errorMessages.password, "error");
            errorStyle(el);
            return false;
        } else {
            successStyle(el);
            return true;
        }
    }
    function validarSenhaConfirmacao(
        confirmacao,
        el,
        senha = document.getElementById("password").value,
        length = 8,
    ) {
        if (senha !== confirmacao) {
            jsToastMessage(errorMessages.passwordConfirmation, "error");
            errorStyle(el);
            return false;
        }
        if (confirmacao.length !== length) {
            jsToastMessage(errorMessages.password, "error");
            errorStyle(el);
            return false;
        }
        else {
            successStyle(el);
            return true;
        }
    }
</script>



</html>