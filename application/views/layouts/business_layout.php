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
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/style.css">
	    <!--*************auxiliares*****************-->

		<?php echo $this->layout->css; ?>

		<?php echo $this->layout->js; ?>

		<!--**********fin auxiliares*****************-->		
	</head>

	<body>
		<header> 
			<div class="home-logo">
				<a href="<?=base_url()?>">WEIKAPP Empresas</a>
			</div>
			<?php
				if($this->session->userdata('uname') !== false){ ?>
					<div class="profile-container">
						<a href="<?=base_url()?>owners/profile">
							<img src="http://graph.facebook.com/<?=$this->session->userdata('fbuid')?>/picture" alt="profile_photo">
							<?=$this->session->userdata('uname')?>
						</a>
						<!-- <a href="<?=base_url()?>user/edit">
							editar
						</a> -->
						<a href="<?=base_url()?>owners/logout">
							salir
						</a>
					</div>
				<?php } else{ ?>
					<div class="profile-container">
						<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,publish_stream,publish_actions,manage_pages','redirect_uri' => base_url().'owners/fblogin'))?>">Login</a>
					</div>
				<?php } ?>
		</header>

		<?php echo $content_for_layout; ?>
		<footer>
		</footer>
	</body>
</html>