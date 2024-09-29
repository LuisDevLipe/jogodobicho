<?php
session_start();
if (isset($_SESSION['rootuser'])) {

	switch (($_SESSION['rootuser'])) {
	case 0:
		echo '<script>alert("Você não tem permissão para acessar essa página")</script>';
		echo '<script>location.href = "/jogodobicho"</script>';
			echo $_SESSION['rootuser'];
			break;
		case 1:
			// echo "Você é um root user";
			break;
	}
} 
else {
	echo "<script>
		alert('Você não tem permissão para acessar essa página, entre com sua conta de administrador');
		location.href = '/jogodobicho/pages/login/login.php';
	</script>";
}
session_commit();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Consulta de usuários</title>
	<link rel="stylesheet" href="console.css" />
	<link rel="stylesheet" href="/jogodobicho/components/navbar/navbar.css">
	<script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<nav class="main-navigation closed">
	<span class="toggle"><i data-lucide="menu"></i></span>
	<a href="/jogodobicho/">Jogo Do Bicho Online</a>
	<div class="sub-menu-items">

		<?php
		session_start();
		if (isset($_SESSION["username"])): ?>
			<a href='#'>Bem vindo de volta <?= $_SESSION[
				"username"
			] ?>.</a>
		<?php else: ?>
			<a href="/jogodobicho/pages/login/login.php/" target="_self">Bem vindo, Visitante!</a>
		<?php endif;
		session_commit();
		?>
			<a href="./consulta_usuarios.php">Consulta Usuarios</a>
			<a href="./system_log.php">Log do Sistema</a>
		</div>
		<div class="menu-items">
			<a href="#" class="jogar-btn">Jogar <i data-lucide="dices"></i></a>
			<a href="#">Meus Jogos</a>
			<?php
			session_start();
			if (isset($_SESSION["username"])): ?>
				<form method='post' name='logout' action=''>
					<button type='submit' name="logout" value="logout">Desconectar</button>
				</form>
			<?php else: ?>
				<a href='/jogodobicho/pages/login/login.php' class='login-btn'>Login/Cadastro <i
						data-lucide='circle-user-round'></i></a>
			<?php endif;
			session_commit();
			?>
		
		
		
			<?php if (isset($_POST["logout"])) {
				include_once $_SERVER["DOCUMENT_ROOT"] .
					"/jogodobicho/controllers/Credential.php";

				controllers\CredentialController::logout();
			} ?>
		</div>
	</nav>
	<main class="system_log">
		<h1>Log do Sistema</h1>
		<section class="wrapper">
			<div class="console-outer">
				<div class="console-header">
					<div>
						<i data-lucide="circle"></i>
						<i data-lucide="circle"></i>
						<i data-lucide="circle"></i>
					</div>
					<div>
						<h2>Comandos disponíveis:</h2>
						<p>buscar --nome &lt;nome:string&gt;</p>|
						<p>buscar --cpf &lt;cpf:string&gt;</p>|
						<p>buscar --all</p>
					</div>
					<div>
						<i data-lucide="minus"></i>
						<i data-lucide="square"></i>
						<i data-lucide="x"></i>
					</div>
				</div>
				<div class="console-inner">
					<div class="console-output">
						<line>
							<user> mastername@jogodobicho: </user>
							<path> /private/system_log/</path>
							<command_d-sign> $ </command_d-sign>
							<command> buscar --all </command>
						</line>
						<output>
							<p>auth_when: 00-00-00 | nome: Luis | 2FA: nome_da_mãe</p>
							<p>auth_when: 00-00-00 | nome: João | 2FA: data_nascimento</p>
						</output>
					</div>
					<form action="#" method="get">
						<label for="command">
							<line>
								<user> mastername@jogodobicho: </user>
								<path> /private/system_log/</path>
								<command_d-sign> $ </command_d-sign>
							</line>
						</label>
						<input type="text" name="command" placeholder="Digite um comando" />
						<!-- <button type="submit">Enviar</button> -->
					</form>
				</div>
			</div>
		</section>
	</main>

	<script>
		lucide.createIcons();
	</script>
</body>

</html>