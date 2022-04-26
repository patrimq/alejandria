

	<head>
		
		<?php require_once('head.php');?>

	</head><!-- end of head-->

	<body class="body-grid">
		<header>
			<?php require_once('header.php');?>
		</header> <!-- end of header-->

	
	
	

		<main>

			<div class="main-contenedor">


					<h3>registro</h3>

						<form id="register-form" method="post" role="form" >
						<section class="cuadro-contacto">
								<?php validar_registro_usuario();?>
						<p class="text-mini-registro">Si aún no estás registrado, comienza por aquí:</p>
						<br>	
						<h4>nombre</h4>
						<input type="text" name="nombre" id="nombre" class="addsearch"  value="" required />
						<h4>apellidos</h4>
						<input type="text" name="apellidos" id="apellidos" class="addsearch"  value="" required />
						<h4>usuario (mail)</h4>
						<input type="text" name="mail" id="mail" class="addsearch"  value="" required />
						<h4>password</h4>
						<input type="password" name="pass" id="pass" class="addsearch"  value="" required />
						<h4>confirmar</h4>
						<input type="password" name="passconfirmar" id="passconfirmar" class="addsearch" />
						<div class="texto-boton">
						<button  type="submit" id="register-submit" name="register-submit" class="texto-boton">Registrar</button>
						<br>


					</form>

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