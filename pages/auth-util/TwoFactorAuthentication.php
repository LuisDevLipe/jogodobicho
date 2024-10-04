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
					switch (rand(min: 1, max: 3)) {
						case 1:
							echo '
							<fieldset>
							<label for="mothername">Qual o nome da sua mãe ?</label>
							<input type="text" name="mothername" id="" required placeholder="Digite aqui" />
							</fieldset>';
							break;
						case 2:
							echo '
								<fieldset>
								<label for="dob">Qual a data do seu nascimento</label>
								<input type="date" name="dob" id="" required />
								</fieldset>';
							break;
						case 3:
							echo '
									<fieldset>
									<label for="cep">Qual o CEP do seu endereço</label>
									<input type="text" name="cep" id="" maxlength="8" required placeholder="Digite aqui" />
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