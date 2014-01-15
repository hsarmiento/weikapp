<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>

	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	    <title><?php echo $this->layout->getTitle(); ?></title>
	    
		<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
		<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-1.10.2.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/json2.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-ui-1.10.3.custom.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.countdown.js"></script>
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/style.css">
	    <!--*************auxiliares*****************-->

		<?php echo $this->layout->css; ?>

		<?php echo $this->layout->js; ?>

		<!--**********fin auxiliares*****************-->		
	</head>

	<body>
		<header> 
			<div class="home-logo">
				<a href="<?=base_url()?>">WEIKAPP</a>
			</div>
			<div class="categories">
				ACA ESTARA EL DIV DE CATEGORIAS
			</div>
			<?php
				if($this->session->userdata('uname') !== false){ ?>
					<div class="profile-container">
						<a href="<?=base_url()?>user/profile">
							<img src="http://graph.facebook.com/<?=$this->session->userdata('fbuid')?>/picture">
							<?=$this->session->userdata('uname')?>
						</a>
						<a href="<?=base_url()?>user/edit">
							editar
						</a>
						<a href="<?=base_url()?>user/logout">
							salir
						</a>
					</div>
				<?php } else{ ?>
					<div class="profile-container">
						<a href="<?=base_url()?>user/login">Login</a>
					</div>
				<?php } ?>
		</header>

		<?php echo $content_for_layout; ?>
		<footer>
			<a href="<?=base_url()?>companies">Soy empresa</a>
		</footer>
	</body>
</html>