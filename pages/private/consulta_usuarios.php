<?php
session_start();
if (isset($_SESSION['rootuser'])) {

	switch (($_SESSION['rootuser'])) {
		case 0:
			// redirect and set the statuscode on the url to 403
			header(header: "Location: /jogodobicho/pages/erro/erro.php?403", replace: true);
			exit();
		case 1:
			// no need to redirect the user is admin and can access the page
			break;
	}
} else {
	// redirect and set the statuscode on the url to 403
	header(header: "Location: /jogodobicho/pages/erro/erro.php?403", replace: true);
	exit();
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
	<?php
	include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/User.php";
	$UserControllerInstance = new controllers\UserController(fullname: '', dob: '', gender: '', mothername: '', cpf: '', email: '', celular: '', fixo: '');

	if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["buscar"])) {

		$users = $UserControllerInstance->findUsers(queryParam: $_GET["query_string"]);

	} else if( $_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["buscar_todos"])) {

		$UserControllerInstance->findUsers();
		$users = $UserControllerInstance->findUsers();
	} else {
		$users = $UserControllerInstance->findUsers();
	}
	?>
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
				<div class="actions">

					<fieldset>
						<button type="submit" name="buscar">Buscar <i data-lucide="search"></i></button>
					</fieldset>
					<fieldset>
						<button type="submit" name="buscar_todos">Buscar Todos <i data-lucide="text-search"></i></button>
					</fieldset>
				</div>
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
					<?php if (!empty($users)) {
						foreach ($users as $user) {
							echo "<tr>";
							echo "<td>{$user['fullname']}</td>";
							echo "<td>{$user['cpf']}</td>";
							echo "<td>{$user['email']}</td>";
							echo "<td>{$user['celular']}</td>";
							echo "<td>{$user['created_at']}</td>";
							echo "<td><form><button type='submit' name='delete_user' value={$user['id']}><i data-lucide='trash'></i></button></form></td>";
							echo "</tr>";
						}
					}




					?>


					<tr></tr>
				</tbody>
			</table>
		</section>
	</main>

	<script>
		lucide.createIcons();
	</script>
</body>

</html>