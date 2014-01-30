<h1>Soy empresa</h1>

<div class="container">
	<p>
		ACA HABRA MUCHO TEXTO Y FOTOS
	</p>
	<a href="<?php echo base_url().'owners/signup'?>" >Regístrate con un correo electrónico</a><br><br>
	<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,publish_stream,publish_actions,manage_pages','redirect_uri' => base_url().'owners/fblogin'))?>" >Regístrate con Facebook</a>
	<p>
		¿Ya tienes cuenta?
		<a href="<?php echo base_url().'owners/authenticate'?>">Andate a la chucha</a>
	</p>
</div>