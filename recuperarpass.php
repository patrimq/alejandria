	
	<head>

		
		<?php require_once('head.php');?>


	</head><!-- end of head-->

	<body class="body-grid">
		<header>
			<?php require_once('header.php');?>
		</header> <!-- end of header-->


		<main>

		<?php display_message(); ?>
		<?php recuperar_password(); ?>


			<div class="main-contenedor">


					<h3>Recuperar password</h3>
					<form id="register-form" method="POST" role="form" >

					<section class="cuadro-contacto">

						<h4>usuario (mail)</h4>
						<input type="text" name="mail" id="mail" class="addsearch" />
						<button  type="submit" id="recuperarpass" name="recuperarpass" class="texto-boton">Recuperar Password</button>
						
					</section>

				</form>

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