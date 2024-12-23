<?php
session_start();
if (isset($_SESSION["rootuser"])) {
    switch ($_SESSION["rootuser"]) {
        case 0:
            // redirect and set the statuscode on the url to 403
            header(header: "Location: /pages/erro/erro.php?403", replace: true);
            exit();
        case 1:
            // no need to redirect the user is admin and can access the page
            break;
    }
} else {
    // redirect and set the statuscode on the url to 403
    header(header: "Location: /pages/erro/erro.php?403", replace: true);
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
	<link rel="stylesheet" href="console.css" />
	<link rel="stylesheet" href="/components/navbar/navbar.css">
	<!-- <script src="https://unpkg.com/lucide@latest"></script> -->
</head>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/components/navbar/navbar.php";
include_once $_SERVER["DOCUMENT_ROOT"] .
    "/components/acessibilidade/acessibilidade.php";
?>

<body>
	<?php if (isset($_GET["command"]) && !empty($_GET["command"])) {
     include_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/UserLog.php";

     $command = $_GET["command"];
     $command = explode(" ", $command);
     if (count($command) > 2) {
         echo '<script>alert("Comando inválido")</script>';
         exit();
     } elseif (count($command) === 1) {
         $queryOption = $command[0];
         $queryParam = "";
     } else {
         $queryOption = $command[0];
         $queryParam = $command[1];
     }
     $userLogs = (new controllers\UserLogController())->findUserLogs(
         queryOption: $queryOption,
         queryParam: $queryParam
     );
     if (!$userLogs) {
         echo "<script></script>";
     }
 } ?>
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
						<p>--nome &lt;nome:string&gt;</p>|
						<p>--cpf &lt;cpf:string&gt;</p>|
						<p>--all</p>
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
							<command>--all </command>
						</line>
						<output>

						<?php if (isset($userLogs) && !empty($userLogs)):
          foreach ($userLogs as $user): ?>
							<p>auth_when: <?= $user["login_at"] ?> | nome: <?= $user[
     "fullname"
 ] ?> | 2FA: <?= $user["TwoFaAnswer"] ?></p>
						<?php endforeach;
      else:
           ?>
						<p>Nenhum resultado encontrado</p>
						<?php
      endif; ?>
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

		document.addEventListener('DOMContentLoaded',() => document.querySelector('[name="command"]').focus());
	</script>
</body>

</html>
