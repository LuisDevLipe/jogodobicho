<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Consulta de usuários</title>
		<link rel="stylesheet" href="style.css" />
		<script src="https://unpkg.com/lucide@latest"></script>
	</head>
	<body>
		<nav class="private-nav">
			<a href="./consulta_usuarios.php">Consulta Usuarios</a>
			<a href="./system_log.php">Log do Sistema</a>
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
