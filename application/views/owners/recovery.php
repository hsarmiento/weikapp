<p>Ingrese su correo electrónico</p>

<?php
	echo validation_errors();

	$aAttributes = array('id' => 'email-form');
	echo form_open('owners/send', $aAttributes);
		echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => set_value('email'), 'class' => 'required'));
		echo '<br/>';		
		echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Recuperar contraseña'));
	echo form_close();
?>

<script type="text/javascript">
	$(function(){
		 $("#email-form").validate({
		 	errorElement: "div",
		 	rules:{
		 		email: {
		 			required: true,
		 			email: true
		 		}
		 	},
		 	messages:{
		 		email: {
		 			required: "Ingresa tu email",
		 			email: "Email incorrecto"
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