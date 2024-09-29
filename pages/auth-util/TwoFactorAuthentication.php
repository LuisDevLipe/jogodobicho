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
<nav class="main-navigation closed">
		<span class="toggle"><i data-lucide="menu"></i></span>
		<a href="/jogodobicho/">Jogo Do Bicho Online</a>
		<div class="sub-menu-items">
			<!-- <a href="/jogodobicho/pages/placar-de-lideres/">Placar de Líderes</a> -->
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
       <a href='/jogodobicho/pages/login/login.php' class='login-btn'>Login/Cadastro <i data-lucide='circle-user-round'></i></a>
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
	<script src="/jogodobicho/components/navbar/scripts.js" defer></script>

	<main class="TwoFacAuth">
		<form action="#" method="post">
			<div>
				<h1>Autenticação de 2 Fatores</h1>
				<p>Responda a estas perguntas para garantirmos a sua segurança</p>
			</div>

			<!-- Somente uma pergunta gerada aleatoriamente deverá ser respondida
				3 tentativas falhas deve apresentar a mensagem '3 tentativas sem sucesso! Favor realizar login novamente'  
				 e redirecionar para a página de login -->
			<fieldset>
				<label for="mothername">Qual o nome da sua mãe ?</label>
				<input type="text" name="mothername" id="" required placeholder="Digite aqui" />
			</fieldset>
			<fieldset>
				<label for="dob">Qual a data do seu nascimento</label>
				<input type="date" name="dob" id="" required />
			</fieldset>
			<fieldset>
				<label for="cep">Qual o CEP do seu endereço</label>
				<input type="text" name="cep" id="" maxlength="8" required placeholder="Digite aqui" />
			</fieldset>
			<fieldset>
				<button type="submit">Enviar</button>
			</fieldset>
			<div>
				<p style="text-align: justify;">Se você estiver enfrentando problemas para
					entrar na sua conta entre em contato pelo link abaixo</p>
				<a href="mailto:suporte@jogodobicho.com?subject=Problemas com autenticação"> suporte@jogodobicho.com</a>
			</div>
		</form>
	</main>
	<script>lucide.createIcons();</script>
</body>

</html>