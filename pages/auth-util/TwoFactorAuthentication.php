<?php 
	function isAccountLocked(): bool {
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(isset($_SESSION['account_is_locked']) && $_SESSION['account_is_locked'] === true) {
			session_commit();
			return true;
		}
		session_commit();
		return false;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Autenticação de 2 Fatores</title>
	<link rel="stylesheet" href="/jogodobicho/components/navbar/navbar.css" />
	<link rel="stylesheet" href="TwoFacAuth.css">
	<script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
	<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/components/navbar/navbar.php' ?>
	<main class="TwoFacAuth">
		<section id="form-section">

			<div>
				<h1>Autenticação de 2 Fatores</h1>
				<p>Responda a esta pergunta para garantirmos a sua segurança</p>
			</div>
			<form action="/jogodobicho/proxy/route_requests.php" method="post">


				<?php {
					switch (rand( min: 1, max: 3)) {
						case 1:
							echo '
							<fieldset>
							<label for="mothername">Qual o nome da sua mãe ?</label>
							<input type=\'text\' name=\'twoFaAnswer\' id=\'twoFaAnswer\' hidden required value=\'1\' />
							<input type="text" name="mothername" id="mothername" required placeholder="Digite aqui" />
							</fieldset>';
							break;
						case 2:
							echo '
								<fieldset>
								<label for="dob">Qual a data do seu nascimento</label>
								<input type=\'text\' name=\'twoFaAnswer\' id=\'twoFaAnswer\' hidden required value=\'2\' />
								<input type="date" name="dob" id="dob" required />
								</fieldset>';
							break;
						case 3:
							echo '
									<fieldset>
									<label for="cep">Qual o CEP do seu endereço</label>
									<input type=\'text\' name=\'twoFaAnswer\' id=\'twoFaAnswer\' hidden required value=\'3\' />
									<input type="text" name="cep" id="cep" maxlength="8" required placeholder="Digite aqui" />
									</fieldset>';
							break;
					}
				} ?>




				<!-- Somente uma pergunta gerada aleatoriamente deverá ser respondida
3 tentativas falhas deve apresentar a mensagem '3 tentativas sem sucesso! Favor realizar login novamente'  
e redirecionar para a página de login -->

				<fieldset>
					<button type="submit">Enviar</button>
				</fieldset>
				<fieldset>
					<?php if (isAccountLocked()): ?>
						<p class="account-locked">3 tentativas sem sucesso! Favor realizar login novamente</p>
					<?php endif; ?>
				</fieldset>

				<input type="text" name="url" hidden value="<?= urlencode(string: basename(path: __FILE__)) ?>">
			</form>
			<div>
				<p style="text-align: justify;">Se você estiver enfrentando problemas para
					entrar na sua conta entre em contato pelo link abaixo</p>
				<a href="mailto:suporte@jogodobicho.com?subject=Problemas com autenticação"> suporte@jogodobicho.com</a>
			</div>
		</section>
	</main>
	<script>lucide.createIcons();</script>
</body>

</html>