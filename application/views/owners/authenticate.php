<h1>Entra en mi</h1>
<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,publish_stream,publish_actions,manage_pages','redirect_uri' => base_url().'owners/fblogin'))?>">Inicia sesión con Facebook</a>
<p>Inicia sesión con correo electrónico</p>
<?php 
		$aAttributes = array('id' => 'login-form');
		echo form_open('owners/login',$aAttributes);
			echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => set_value('email'), 'class' => 'required'));
			echo '<br/>';
			echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'value' => set_value('password'), 'class' => 'required'));
			echo '<br/>';
			echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Ingresar'));
		echo form_close();
?>
<a href="#">Olvidé la contraseña</a>

<script type="text/javascript">
	$(function(){
		 $("#login-form").validate({
		 	errorElement: "div",
		 	rules:{
		 		email: {
		 			required: true,
		 			email: true
		 		},
		 		password: {
		 			required: true
		 		}
		 	},
		 	messages:{
		 		email: {
		 			required: "Ingresa tu email",
		 			email: "Email incorrecto"
		 		},
		 		password: {
		 			required: "Ingresa una contraseña"
		 		}
		 	},
			submitHandler: function(form) {
			   form.submit();
			  }
			});
	});

	$(".required").blur(function(){
		$(this).valid();
    });

</script>