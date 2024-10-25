<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Cadastro Jogo do Bicho Online</title>
	<link rel="stylesheet" href="cadastro.css" />

</head>

<body>
<?php include_once $_SERVER["DOCUMENT_ROOT"] .
    "/jogodobicho/components/navbar/navbar.php";
	include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/components/acessibilidade/acessibilidade.php" ?>

	<main>
		<form action="/jogodobicho/proxy/route_requests.php" method="post" name='cadastro' enctype='application/x-www-form-urlencoded'>
			<h1>Cadastro</h1>
			<div class="fields-wrapper">

				<div class="fields-group">

					<fieldset>
						<label for="name">Nome</label>
						<input required type="text" name="name"
						minlength="15" maxlength="80"
						onchange="validarNome(this)"
						>
					</fieldset>
					<fieldset><label for="dob">Data de Nascimento</label><input required type="date" name="dob">
					</fieldset>

					<fieldset><label for="gender">Sexo</label>
						<select name="gender" required>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
							<option value="outro">Outro</option>
							<option value="na">Prefiro não informar</option>
						</select>
					</fieldset>
					<fieldset><label for="filiation-name">Nome Mãe</label><input required type="text"
							name="filiation-name">
					</fieldset>
					<fieldset><label for="cpf">CPF</label><input required type="text" name="cpf"
							onchange="validarCPF(this.value, this)"
							>
					</fieldset>
					<fieldset>
						<label for="email">Email</label>
						<input required type="email" name="email" id="email" />
					</fieldset>
					<fieldset><label for="celular">Celular</label><input required type="cel" name="celular"

							pattern="\(\+[0-9]{2}\)[0-9]{2}-[0-9]{9}" placeholder="(+55)21-999999999"
							oninput="formatarCelular(this.value,this,celular)"
							onchange="validarTelefone(this.value,this)"
					></fieldset>
					<fieldset><label for="fixo">Fixo</label><input required type="tel" name="fixo"
							pattern="\(\+[0-9]{2}\)[0-9]{2}-[0-9]{8}" placeholder="(+55)21-999999999"
							oninput="formatarFixo(this.value,this,'fixo')"
							onchange="validarTelefone(this.value,this,true)"
					></fieldset>
				</div>
				<div class="field-wrapper">

					<fieldset class="adress">
						<label for="cep">CEP</label>
						<input type="text" required name="cep" oninput="validarCEP(this.value)" minlength="8"
							maxlength="9">
						<label for="logradouro">Rua</label><input required name="logradouro" type="text">
						<label for="numero">Número</label> <input required type="text" name="numero">
						<label for="cidade">Cidade</label><input required type="text" name="cidade">
						<label for="estado">Estado</label><input required name="estado" type="text">
						<label for="complemento">Complemento</label><input type="text" name="complemento">
						<label for="bairro">Bairro</label><input required name="bairro" type="text">
						<label for="pais">País</label><input required name="pais" type="text">
					</fieldset>
					<fieldset>
						<label for="username">Nome de Usuário</label>
						<input required type="text" name="username" id="username" maxlength="6" minlength="6" onchange="validarUsername(this.value,this)"/>
					</fieldset>
					<fieldset>

						<label for="password">Senha</label>
						<input required type="password" name="password" id="password" minlength="8" maxlength="8"
						onchange="validarSenha(this.value,this)"/>
					</fieldset>
					<fieldset>

						<label for="passwordConfirm">Confirmar Senha</label>
						<input required type="password" name="passwordConfirm" id="passwordConfirm" minlength="8" maxlength="8"
					   onchange="validarSenhaConfirmacao(this.value,this)"/>
					</fieldset>
				</div>
			</div>
			<fieldset>

				<button type="submit" name='cadastrar'>Cadastrar</button>
			</fieldset>
			<fieldset>
				<input type="reset" value="Limpar"/>
			</fieldset>
			<fieldset>
				<input required type="checkbox" name="termos" id="termos" />
				<label for="termos">Eu concordo com os
					<br>
					<a href="#">Termos de serviços e condições</a></label>
			</fieldset>
			<a href="/jogodobicho/pages/login/login.php">Login</a>
			<input type="text" name="url" hidden value="<?= urlencode(
       string: basename(path: __FILE__)
   ) ?>">
		</form>

	</main>
	<script src="/jogodobicho/public/js/cadastro.js"></script>
	<script>lucide.createIcons()</script>
</body>

</html>
