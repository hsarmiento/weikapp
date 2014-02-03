<h1>Registrate papi</h1>

<div class="container">
<?php
	echo validation_errors();

	$aAttributes = array('id' => 'login-form');
	echo form_open('owners/create', $aAttributes);
		echo form_input(array('name' => 'names', 'id' => 'names', 'placeholder' => 'Nombre', 'value' => set_value('names'), 'class' => 'required'));
		echo '<br/>';
		echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'Apellidos', 'value' => set_value('last_name'), 'class' => 'required'));
		echo '<br/>';
		echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => set_value('email'), 'class' => 'required'));
		?> <span id="email_message" style="color:#ff0000;"></span> <?php
		echo '<br/>';
		echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'value' => set_value('password'), 'class' => 'required'));
		echo '<br/>';
		echo form_submit(array('name' => 'register_button', 'id' => 'register_button', 'value' => 'Crear cuenta'));
	echo form_close();
?>
</div>

<script type="text/javascript">
	$(function(){
		 $("#login-form").validate({
		 	errorElement: "div",
		 	rules:{
		 		names: {
		 			required: true
		 		},
		 		last_name: {
		 			required: true
		 		},
		 		email: {
		 			required: true,
		 			email: true
		 		},
		 		password: {
		 			required: true
		 		}
		 	},
		 	messages:{
		 		names: {
		 			required: "Ingresa tus nombres"
		 		},
		 		last_name: {
		 			required: "Ingresa tus apellidos"
		 		},
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