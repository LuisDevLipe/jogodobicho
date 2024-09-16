<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Consulta de usuários</title>
		<link rel="stylesheet" href="console.css" />
		<script src="https://unpkg.com/lucide@latest"></script>
	</head>
	<body>
		<nav class="private-nav">
			<a href="./consulta_usuarios.php">Consulta Usuarios</a>
			<a href="./system_log.php">Log do Sistema</a>
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
