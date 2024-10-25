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

	include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/controllers/User.php";
	$UserControllerInstance = new controllers\UserController(fullname: '', dob: '', gender: '', mothername: '', cpf: '', email: '', celular: '', fixo: '', address_id: '');

	if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["buscar"])) {

		$users = $UserControllerInstance->findUsers(queryParam: $_GET["query_string"]);
	$query = $_GET["query_string"];

	} else {
		$users = $UserControllerInstance->findUsers();
	$query = 'all';
}
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
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/components/navbar/navbar.php";
	include_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/components/acessibilidade/acessibilidade.php' ?>


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
						<button type="submit" name="buscar_todos">Buscar Todos <i
								data-lucide="text-search"></i></button>
					</fieldset>
					<fieldset class="m-l-auto">
						<button type="submit" name="gerar-pdf" id="gerar-pdf" value="<?= $query ?>"
							formaction="/jogodobicho/functions/gerar_pdf.php">Exportar busca como PDF <i
								data-lucide="file"></i></button>
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
							echo "<td>
									<form action='/jogodobicho/proxy/route_requests.php' method='POST' enctype='application/x-www-form-urlencoded'
										onsubmit='return confirm(\"Tem certeza que deseja excluir o usuário?\")'
									>
										<button type='submit' name='delete_user' value={$user['ID']}><i data-lucide='trash'></i></button>
										<input type='text' hidden name='url' value=delete-user>
									</form>
								</td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='6'>Nenhum usuário encontrado</td></tr>";
						echo "<script>jsToastMessage('A pesquisa não retornou resultados.','error')</script>";
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