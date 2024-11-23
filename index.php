<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Jogo do Bicho</title>
	<!-- <link rel="stylesheet" href="/components/acessibilidade/acessibilidade.css"> -->
	<link rel="stylesheet" href="styles.css" />

</head>

<body>
<?php
 session_start();
 echo '<pre>';
 var_dump($_SESSION);
 echo '</pre>';
 session_commit();
 ?>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] .
	"/components/navbar/navbar.php";
include_once $_SERVER["DOCUMENT_ROOT"] .
	"/components/acessibilidade/acessibilidade.php";
?>

	<main class="index-content">
		<section class="hero" id="inicio">
			<div class="about-the-game">
				<h1>Bem Vindo ao Jogo Do Bicho <span>Online</span>.</h1>
				<p>
					Se vocẽ ainda não sabe o que é o jogo bicho,<a
						href="https://pt.wikipedia.org/wiki/Jogo_do_bicho">Wikipedia</a>leia a história por trás.
				</p>
				<!-- <figure> -->
				<!-- <img
								src="https://pbs.twimg.com/media/EZbzPErWAAM0dNd?format=jpg&name=large"
								alt="Bichos do jogo do bicho"
								/> -->
				<!-- <img src="https://lottocap.com.br/blog/wp-content/uploads/2021/06/iStock-915871398-1-1024x382.jpg" alt="Gato jogando jogo com fichas de apostas"> -->
				<!-- <figcaption>Quadro com os Bichos e os números associados.</figcaption> -->
				<!-- <figcaption>Você sabe porquê os gatos não podem jogar o Jogo Do Bicho? Porque eles não...</figcaption> -->
				<!-- </figure> -->
			</div>
			<div class="how-to-play">
				<div>
					<h2>Como Jogar o Jogo Do Bicho?</h2>
					<p>
						Se você ainda não conhece, ou conhece mas não sabe como jogar o Jogo. Verá como é simples e
						fácil.
					</p>
					<p>
						É tão simples quanto escolher 4 números e o valor da sua aposta. E então esperar o
						resultado.
					</p>
				</div>

				<a href="#">
					<p>Jogar</p>
					<i data-lucide="dice-6"></i>
				</a>
			</div>
		</section>
		<section class="hero-products">
			<div class="title-wrapper">
				<h3>Tipos de aposta</h3>
			</div>
			<div class="wrapper">
				<article>
					<p>Grupo</p>
					<p>Aposte em um grupo específico e ganhe de acordo com a posição do bicho na tabela</p>
					<div class="grupo">
						<div class="image">
							<i data-lucide="dices"></i>
							<img src="public/assets/coelho.png" alt="Silhueta de um coelho." />
						</div>

						<div class="info">
							<!-- <p>Grupo</p> -->
							<p>Coelho</p>
							<p>dezenas:</p>
							<div>
								<span>37</span>
								<span>38</span>
								<span>39</span>
								<span>40</span>
							</div>
						</div>
					</div>
				</article>
				<article>
					<p>Duque</p>
					<p>
						Aposte em 2 animais e ganhe de acordo com a posição dos dois se forem sorteados na tabela.
					</p>

					<div class="grupo">
						<div class="image">
							<i data-lucide="dices"></i>
							<img src="public/assets/dog_cat.png" alt="Um gato e um cachorro. Dois animais." />
						</div>
						<div class="info">
							<!-- <p>Duque</p> -->
							<p>Animais</p>
							<p>dezenas:</p>
							<div>
								<span class="cachorro">18</span>
								<span class="cachorro">20</span>
								<span class="gato">55</span>
								<span class="gato">56</span>
							</div>
						</div>
					</div>
				</article>

				<article>
					<p>Terno</p>
					<p>
						Aposte em 3 animais e ganhe de acordo com a posição dos três se forem sorteados na tabela.
					</p>

					<div class="grupo">
						<div class="image">
							<i data-lucide="dices"></i>
							<img src="public/assets/3_animais.png" alt="3 animais." />
						</div>

						<div class="info">
							<!-- <p>Terno</p> -->
							<p>Animais</p>
							<p>dezenas:</p>
							<div>
								<span class="urso">90</span>
								<span class="coelho">40</span>
								<span class="cachorro">18</span>
								<span class="nulo">00</span>
							</div>
						</div>
					</div>
				</article>

				<article>
					<p>Quadra</p>
					<p>
						Aposte em 4 animais e ganhe de acordo com a posiçao dos três se forem sorteados na tabela.
					</p>
					<div class="grupo">
						<div class="image">
							<i data-lucide="dices"></i>
							<img src="public/assets/4_animais.png"
								alt="4 animais. Um Urso, um cachorro, um porco e um coelho." />
						</div>
						<div class="info">
							<!-- <p>Quadra</p> -->
							<p>Animais</p>
							<p>dezenas:</p>
							<div>
								<span class="urso">90</span>
								<span class="coelho">40</span>
								<span class="cachorro">18</span>
								<span class="porco">69</span>
							</div>
						</div>
					</div>
				</article>

				<article>
					<p>Quina</p>
					<p>
						Aposte em 5 animais e ganhe de acordo com a posição dos cinco se forem sorteados na tabela.
					</p>
					<div class="grupo">
						<div class="image">
							<i data-lucide="dices"></i>
							<img src="public/assets/5_animais.png" alt="5 animais." />
						</div>
						<div class="info">
							<!-- <p>Quina</p> -->
							<p>Animais</p>
							<p>dezenas:</p>
							<div>
								<span class="urso">90</span>
								<span class="coelho">40</span>
								<span class="cachorro">18</span>
								<span class="porco">69</span>
								<span class="galo">50</span>
							</div>
						</div>
					</div>
				</article>
				<!-- <article class="aposta-em-numeros">
						<div class="milhar">
							<p>Milhar</p>
							<p>Ganhe acertando o número da aposta com 4 casas</p>
							<span>0000</span>
						</div>
						<div class="centena">
							<p>Centena</p>
							<p>Ganhe acertando o número da aposta com 3 casas</p>
							<span>x000</span>
						</div>
						<div class="dezena">
							<p>Dezena</p>
							<p>Ganhe acertando o número da aposta com 2 casas</p>
							<span>xx00</span>
						</div>
					</article> -->
			</div>
		</section>

		<section class="results">
			<header>
				<h1>Horários</h1>

				<div>
					<a href="#">10:00</a>
					<a href="#">15:00</a>
					<a href="#">18:00</a>
				</div>
			</header>

			<main>
				<h1>Resultados</h1>
				<div>
					<article>results</article>
					<article>TBD</article>
					<article>TBD</article>
				</div>
			</main>
		</section>
		<section class="how-to-play" id="how-to-play">
			<div class="actions">
				<span><i data-lucide="home"></i><a href="#inicio">Voltar ao Início</a></span>
			</div>
			<div class="text">
				<h3>Como jogar ?</h3>
				<ul>
					<li>Clique em jogar</li>
					<li>
						Se identifique com o CPF
						<small> (Seu CPF só será usado para verificação do ganhando ao final.) </small>
					</li>
					<li>Escolha o tipo de aposta</li>
					<ul>
						<li>Milhar 1º x4000</li>
						<li>Dezena 1º x800</li>
						<li>Centena 1º x50</li>
					</ul>
					<li>
						Escolha o tipo de jogo
						<ul>
							<li>Grupo 1º x10</li>
							<li>Duque até x95</li>
							<li>Terno até x700</li>
							<li>Quadra até x4000</li>
							<li>Quina até x17000</li>
						</ul>
					</li>
					<li>Escolha o valor da aposta</li>
					<li>Clique em Jogar</li>
					<li>Aguarde o resultado</li>
				</ul>
				<small>
					*Os jogos feitos contarão somente para os resultados que forem sorteados no mesmo dia e após o
					horário em que foi feita aposta.*
				</small>
			</div>
		</section>
	</main>
	<footer>
		<a href="https://github.com/LuisDevLipe/repositories">LuisDevLipe</a>
		<a href="#">2024</a>
		<a href="pages/db-model/index.html">Veja o Modelo do Banco de Dados desse site.</a>
	</footer>
	
	<!-- <script src="components/acessibilidade/acessibilidade.js" defer></script> -->
	<script>
		lucide.createIcons();
	</script>
</body>

</html>
