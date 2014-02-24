<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->layout->getTitle(); ?></title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
		<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cantarell">
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-1.10.2.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/json2.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-ui-1.10.3.custom.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.countdown.js"></script> 
	    <!--*************auxiliares*****************-->

		<?php echo $this->layout->css; ?>

		<?php echo $this->layout->js; ?>

		<!--**********fin auxiliares*****************-->		
	</head>

	<body>
		<header> 
			<a href="#" class="logo left">
				<figure>
					<img src="<?php echo base_url(); ?>public/img/logo_emp.png" alt="WeikApp" />
				</figure>
			</a>
			<?php
				if($this->session->userdata('logged_in') == true){ ?>
					<div class="menu">
						<img src="<?php echo base_url()?>public/img/owners/<?=md5($this->session->userdata('oid'))?>.png" alt="menu" />
						<a class="star" onclick="$('#header_company_menu').toggle('');">
							<div class="company_name"><?php echo $this->session->userdata('company_name'); ?></div>
							<div class="triangle_down"></div>
						</a>
						<nav class="show" id="header_company_menu">
							<ul>
								<li><a href="#">uno</a></li>
								<li><a href="#">dos</a></li>
								<li><a href="#">tres</a></li>
								<li><a href="#">cuatro</a></li>
								<li><a href="#">cinco</a></li>
							</ul>
						</nav>
					</div>
					<div class="promos_btn">
						<a href="#">Mis promociones</a>
					</div>
					<div class="option right">
						<a href="#" >
							<img src="<?php echo base_url(); ?>public/img/ticket.png" alt="ticket" />
						</a>
						<a href="#" onclick="$('#header_owner_menu').toggle('');">
							<img src="<?php echo base_url()?>public/img/owners/<?=md5($this->session->userdata('oid'))?>.png" alt="user_company" />
							<?=$this->session->userdata('uname')?>
						</a>
						<nav class="show" id="header_owner_menu">
							<ul >
								<li><a href="<?=base_url()?>owners/logout">Salir</a></li>
							</ul>
						</nav>
					</div>
				<?php } else{ ?>
					<div class="profile-container">
						<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,publish_stream,publish_actions,manage_pages','redirect_uri' => base_url().'owners/fblogin'))?>">Login</a>
					</div>
				<?php } ?>
		</header>

		<?php echo $content_for_layout; ?>
		<footer>
			<div class="footer_left">
				<p>WEIKAPP © 2014</p>
			</div>
			<div class="footer_right">
				<a href="#">Como funciona</a>
				<a href="#">Preguntas frecuentes</a>
				<a href="#">Soy empresa</a>
				<a href="#">Términos y condiciones</a>
				<a href="#">Contacto</a>
			</div>
		</footer>
	</body>
</html>