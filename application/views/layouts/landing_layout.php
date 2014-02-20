<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->layout->getTitle(); ?></title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
		<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
		<meta charset="UTF-8">
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/style.css"> -->
	    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cantarell">
	    <!--*************auxiliares*****************-->

		<?php echo $this->layout->css; ?>

		<?php echo $this->layout->js; ?>

		<!--**********fin auxiliares*****************-->		
	</head>

	<body>
		<header>
				<a href="#">
					<img src="<?=base_url()?>public/img/landing_logo.png" alt="WeikApp" />
				</a>
		</header>

		<?php echo $content_for_layout; ?>
		<footer>
			<div class="footer_left">
			<p>WEIKAPP © 2014</p>
			</div>
			<div class="footer_right">
					<a href="">Como funciona</a>
					<a href="">Preguntas frecuentes</a>
					<a href="">Soy empresa</a>
					<a href="">Términos y condiciones</a>
					<a href="">Contacto</a>
			</div>
		</footer>
	</body>
</html>