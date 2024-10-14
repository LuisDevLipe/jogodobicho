<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Alterar Senha</title>
        <link rel="stylesheet" href="/jogodobicho/components/navbar/navbar.css">
        <link rel="stylesheet" href="RecuparSenha.css">
		<script src="https://unpkg.com/lucide@latest"></script>
	</head>
	<body>
	<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/components/navbar/navbar.php' ?>
		<main id="AlterarSenha">
			<form action="/jogodobicho/proxy/route_requests.php" method="post" enctype="application/x-www-form-urlencoded">
				<div>
					<h1>Recuperar Senha</h1>
					<p>Se você perdeu a sua senha de acesso e de gostaria de recuperar.</p>
					<p>Entre com os dados abaixo para trocar para uma nova senha</p>
				</div>
                <fieldset>
                    <label for="user">Usuário</label>
                    <input type="text" name="user" placeholder="Seu nome de usuário"  required>
                </fieldset>
                <fieldset>
                    <label for="useremail">Email já cadastrado</label>
                    <input type="email" name="useremail" placeholder="Seu email" required>
                </fieldset>
                <fieldset>
                    <button type="submit" >Solicitar troca de senha</button>
                </fieldset>
				<div>
					<p>Se você entrou nessa página por engano, volte para a página de:</p>
					<p>
						<a href="/jogodobicho/pages/login/login.php">Login</a> ou
						<a href="/jogodobicho/pages/cadastro/cadastro.php">Cadastro</a>
					</p>
				</div>
				<input type="text" name="url" hidden value="<?= urlencode(string: basename(path: __FILE__)) ?>">
            
			</form>
		</main>
		<script>lucide.createIcons()</script>
	</body>
</html>
