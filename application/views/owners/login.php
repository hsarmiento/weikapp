<?php
	if (!isset($sEmail)) 
	{
		redirect(base_url());
	}
	else
	{ 
		if ($sEmail != '')
		{?>
			<p>El correo electrónico o la contraseña son incorrectos</p>
		<?php }
		
		$aAttributes = array('id' => 'login-form');
		echo form_open('owners/login', $aAttributes);			
			echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => $sEmail, 'class' => 'required'));
			echo '<br/>';
			echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'class' => 'required'));
			echo '<br/>';
			echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Ingresar'));
		echo form_close();
	}
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