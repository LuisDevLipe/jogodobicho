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
} else {
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
	<link rel="stylesheet" href="style.css" />
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


	<main class="consulta-usuario">
		<h1>Consulta</h1>
		<section class="busca">
			<form action="#" method="get" enctype="application/x-www-form-urlencoded">
				<fieldset>
					<label for="query_string">Buscar Usuário</label>
					<input type="text" name="query_string" placeholder="Digite o nome do usuário" />
				</fieldset>
				<fieldset>
					<button type="submit">Buscar <i data-lucide="search"></i></button>
				</fieldset>
			</form>
		</section>
		<section class="usuarios">
			<table>
				<thead>
					<tr>
						<th>Nome</th>
						<th>CPF</th>
						<th>Email</th>
						<th>Telefone</th>
						<th>created_at</th>
						<th>Excluir</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>João da Silva</td>
						<td>123.456.789-00</td>
						<td>joao@jogodobicho.com</td>
						<td>(21)9 9999-9999</td>
						<td>16-09-2024</td>
						<td>
							<button><i data-lucide="trash"></i></button>
						</td>
					</tr>
					<tr>
						<td>Maria da Silva</td>
						<td>123.456.789-00</td>
						<td>maria@jogodobicho.com</td>
						<td>(21)9 9999-9999</td>
						<td>16-09-2024</td>
						<td>
							<button><i data-lucide="trash"></i></button>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
	</main>

	<script>
		lucide.createIcons();
	</script>
</body>

</html>