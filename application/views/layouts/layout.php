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

			<?php
				if($this->session->userdata('uname') !== false){ ?>
					<div class="option right_login">
						<input placeholder="Buscar" type="search" />
						<a href="#" onclick="$('#header_login_menu').toggle('');">
							<img src="<?php echo base_url()?>public/img/users/<?=md5($this->session->userdata('uid'))?>.png">
							<?=$this->session->userdata('uname')?>
						</a>
					</div>
				<?php } else{ ?>
					<div class="option right">
						<input placeholder="Buscar" type="search" />
						<a href="<?=base_url()?>companies" title="Crear promoción!">
							<img src="<?php echo base_url();?>public/img/ticket.png" alt="ticket" />
						</a>
						<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,user_birthday,publish_stream,publish_actions','redirect_uri' => base_url().'user/login'))?>">
							<img src="<?php echo base_url();?>public/img/fb_login.png" alt="login" />
						</a>
						<a class="star" onclick="$('#header_menu').toggle('');">
							<img src="<?php echo base_url();?>public/img/menu.png" alt="menu" />
						</a>
					</div>
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
						<li><a href="<?=base_url()?>user/profile">Perfil</a></li>
						<li><a href="<?=base_url()?>user/edit">Editar</a></li>
						<li><a href="<?=base_url()?>user/logout">Salir</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<?php echo $content_for_layout; ?>
		<footer>
			<?php 
				if (strpos(current_url(), '/promos/index') === false)
				{ ?>
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
				<?php }
			?>
		</footer>
		<script>
		  $(function() {
		    $( document ).tooltip({
		      position: {
		        my: "center bottom-20",
		        at: "center top",
		        using: function( position, feedback ) {
		          $( this ).css( position );
		          $( "<div>" )
		            .addClass( "arrow" )
		            .addClass( feedback.vertical )
		            .addClass( feedback.horizontal )
		            .appendTo( this );
		        }
		      }
		    });
		  });
  </script>
	</body>
</html>