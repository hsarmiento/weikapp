<h1>Registrate papi</h1>

<div class="container">
<?php
	echo validation_errors();
	echo form_open('owners/create');
		echo form_input(array('name' => 'names', 'id' => 'names', 'placeholder' => 'Nombre', 'value' => set_value('names')));
		echo '<br/>';
		echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'Apellidos', 'value' => set_value('last_name')));
		echo '<br/>';
		echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => set_value('email'), 'onblur' => 'validate_email()'));
		?> <span id="email_message" style="color:#ff0000;"></span> <?php
		echo '<br/>';
		echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'value' => set_value('password')));
		echo '<br/>';
		echo form_submit(array('name' => 'register_button', 'id' => 'register_button', 'value' => 'Crear cuenta'));
	echo form_close();
?>
</div>

<div class="container">
	<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,publish_stream,publish_actions,manage_pages','redirect_uri' => base_url().'owners/login'))?>">Login con facebook</a>
</div>

<script type="text/javascript">
function validate_email()
{
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test($("#email").html))
  {
  	$("#email_message").html("Email invalido");
  }
  else
  {
  	$("#email_message").html("Email válido");	
  }
}
</script>