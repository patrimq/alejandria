
	

	<head>
		
		<?php require_once('head.php');?>


	</head><!-- end of head-->

	

	<body class="body-grid">
		<header>
			<?php require_once('header.php');?>
		</header> <!-- end of header-->
		<main>

			<div class="main-contenedor">
				<?php validate_login_in(); ?>

				<section class="libreria">
					
				<?php libreria(); ?>	
					
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