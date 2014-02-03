<?php 
	if ($iResults > 0)
	{?>
		<h1>Validado el mail po campeón. Ahora puedes logearte</h1>		
	<?php 

		$aAttributes = array('id' => 'login-form', $aAttributes);
		echo form_open('owners/login');
			echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'class' => 'required'));
			echo '<br/>';
			echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'class' => 'required'));
			echo '<br/>';
			echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Ingresar'));
		echo form_close();
	}
	else
	{?>
		<h1>Email invalido</h1>
	<?php }
?>

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