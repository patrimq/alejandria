	
	<head>

		
		<?php require_once('head.php');?>


	</head><!-- end of head-->

	<body class="body-grid">
		<header>
			<?php require_once('header.php');?>
		</header> <!-- end of header-->


		<main>

		<?php display_message(); ?>
		<?php validar_login(); ?>


			<div class="main-contenedor">


					<h3>Inicio</h3>
					
					<section class="cuadro-contacto">
						<form id="register-form" method="post" role="form" >

						<h4>usuario (mail)</h4>
						<input type="text" name="mail" id="mail" class="addsearch" />
						<h4>pass</h4>
						<input type="password" name="pass" id="pass" class="addsearch" />
						<h4></h4>
						<button  type="submit" id="login" name="login" class="texto-boton">envío</button>

						</form>			

						<h4></h4>
						<button  type="submit" id="recuperarpass" name="recuperarpass" class="texto-boton" onclick="location.href='recuperarpass.php';">Recuperar Password</button>

					</section>
	
					
			</div>

		</main>

		<footer>
			<?php require_once('footer.php');?>
		</footer> <!-- end of footer-->

		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
		<script src="script/script-menu.js"></script> <!-- El codigo Personal que abre y Cierra el Menu -->




	  	<!-- End of Scripts -->


	</body> <!-- end of body-->

</html>