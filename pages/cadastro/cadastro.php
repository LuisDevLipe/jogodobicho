<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Cadastro Jogo do Bicho Online</title>
	<link rel="stylesheet" href="../cadastro/cadastro.css" />
	<link rel="stylesheet" href="/jogodobicho/components/navbar/navbar.css" />
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
		<form action="#" method="post">
			<h1>Cadastro</h1>
			<div class="fields-wrapper">

				<div class="fields-group">

					<fieldset>
						<label for="name">Nome</label>
						<input required type="text" name="name" minlength="15" maxlength="80">
					</fieldset>
					<fieldset><label for="dob">Data de Nascimento</label><input required type="date" name="dob"></fieldset>

					<fieldset><label for="gender">Sexo</label>
						<select name="gender" required>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
							<option value="outro">Outro</option>
							<option value="na">Prefiro não informar</option>
						</select>
					</fieldset>
					<fieldset><label for="filiation-name">Nome Mãe</label><input required type="text" name="filiation-name">
					</fieldset>
					<fieldset><label for="cpf">CPF</label><input required type="text"
						oninput="validarCPF(this.value)"
							pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})">
					</fieldset>
					<fieldset>
						<label for="email">Email</label>
						<input required type="email" name="email" id="email" />
					</fieldset>
					<fieldset><label for="cel">Celular</label><input required type="cel" name="cel"
							pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></fieldset>
					<fieldset><label for="tel">Fixo</label><input required type="tel" name="cel"
							pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></fieldset>
				</div>
				<div class="field-wrapper">

					<fieldset class="adress">
						<label for="cep">CEP</label>
						<input type="text" required name="cep" oninput="validarCEP(this.value)" minlength="8" maxlength="8">
						<label for="logradouro">Rua</label><input required name="logradouro" type="text">
						<label for="numero">Número</label> <input required type="text" name="numero">
						<label for="cidade">Cidade</label><input required type="text" name="Cidade">
						<label for="estado">Estado</label><input required name="estado" type="text">
						<label for="complemento">Complemento</label><input required type="text" name="complemento">
						<label for="bairro">Bairro</label><input required name="bairro" type="text">
					</fieldset>
					<fieldset>

						<label for="password">Senha</label>
						<input required type="password" name="password" id="password" />
					</fieldset>
					<fieldset>

						<label for="passwordConfirm">Confirmar Senha</label>
						<input required type="password" name="passwordConfirm" id="passwordConfirm" />
					</fieldset>
				</div>
			</div>
			<fieldset>

				<button type="submit">Cadastrar</button>
			</fieldset>
			<fieldset>
				<input required type="checkbox" name="termos" id="termos" />
				<label for="termos">Eu concordo com os
					<br>
					<a href="#">Termos de serviços e condições</a></label>
			</fieldset>
			<a href="/jogodobicho/pages/login/login.php">Login</a>
		</form>
	</main>
	<script src="cadastro.js"></script>
	<script>lucide.createIcons()</script>
</body>

</html>