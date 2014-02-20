<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->layout->getTitle(); ?></title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
		<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
		<meta charset="UTF-8">
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-1.10.2.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/json2.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-ui-1.10.3.custom.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.countdown.js"></script>
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/style.css"> -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/cc_layout.css">
	    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cantarell">
	    <!--*************auxiliares*****************-->

		<?php echo $this->layout->css; ?>

		<?php echo $this->layout->js; ?>

		<!--**********fin auxiliares*****************-->		
	</head>

	<body>
		<header>
			<a href="<?=base_url().'promos/index'?>" class="home-logo left">
				<figure>
					<img src="<?php echo base_url()?>public/img/logo.png" alt="WeikApp" />
				</figure>
			</a> 

			<div class="option right">
				<input placeholder="Buscar" type="search" />
				<?php
				if($this->session->userdata('uname') !== false){ ?>
					<div class="profile-container">
						<a href="#" onclick="$('#header_login_menu').toggle('');">
							<img src="http://graph.facebook.com/<?=$this->session->userdata('fbuid')?>/picture">
							<?=$this->session->userdata('uname')?>
						</a>
					</div>
				<?php } else{ ?>
					<a href="<?=base_url()?>companies" >
						<img src="<?php echo base_url()?>public/img/ticket.png" alt="ticket" />
					</a>
					<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,user_birthday,publish_stream,publish_actions','redirect_uri' => base_url().'user/login'))?>">
						<img src="<?php echo base_url()?>public/img/fb_login.png" alt="login" />
					</a>
					<a class="star" onclick="$('#header_menu').toggle('');">
						<img src="<?php echo base_url()?>public/img/menu.png" alt="menu" />
					</a>
				<?php } ?>				
				
				<nav id="header_menu" class="show">
				<ul>
					<li><a href="#">uno</a></li>
					<li><a href="#">uno</a></li>
					<li><a href="#">uno</a></li>
					<li><a href="#">uno</a></li>
					<li><a href="#">uno</a></li>
				</ul>
				</nav>
				<nav id="header_login_menu" class="show">
					<ul>
						<li><a href="<?=base_url()?>user/edit">Editar</a></li>
						<li><a href="<?=base_url()?>user/logout">Salir</a></li>
					</ul>
				</nav>	
			</div>			
		</header>

		<?php echo $content_for_layout; ?>
		<footer>
		</footer>
	</body>
</html>