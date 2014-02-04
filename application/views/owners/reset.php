<?php 
	if ($iResults > 0)
	{?>
		<h2>Ingrese nueva contraseña</h2>
	<?php 

		$aAttributes = array('id' => 'pass-form');
		$aHiddenInputs = array('email' => $sEmail);
		echo form_open('owners/change', $aAttributes,$aHiddenInputs);
			echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'class' => 'required'));
			echo '<br/>';
			echo form_password(array('name' => 'password_repeat', 'id' => 'password_repeat', 'placeholder' => 'Repita contraseña', 'class' => 'required'));
			echo '<br/>';
			echo form_submit(array('name' => 'change_pass_button', 'id' => 'change_pass_button', 'value' => 'Cambiar contraseña'));
		echo form_close();
	}
	else
	{?>
		<h1>Email invalido</h1>
	<?php }
?>

<script type="text/javascript">
	$(function(){
		 $("#pass-form").validate({
		 	errorElement: "div",
		 	rules:{
		 		password: {
		 			required: true
		 		},
		 		password_repeat: {
		 			required: true,
		 			equalTo: "#password"	
		 		}
		 	},
		 	messages:{
		 		password: {
		 			required: "Ingresa una contraseña"
		 		},
		 		password_repeat: {
		 			required: "Ingrese una contraseña",
		 			equalTo: "Por favor ingrese la misma contraseña de nuevo"
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