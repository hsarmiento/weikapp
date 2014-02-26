<div class="container">
	<section>
		<div class="promo_title">
			Registro
		</div>
		<hr />
		<article>
			<?php
				echo validation_errors();

				$aAttributes = array('id' => 'login-form');
				echo form_open('owners/create', $aAttributes);
					?>
					<div class="input_a big_input">
						<?php 
							echo form_label('Nombres','names');
							echo form_input(array('name' => 'names', 'id' => 'names', 'value' => set_value('names'), 'class' => 'required'));
						?>
					</div>
					<div class="input_b big_input">
						<?php 
							echo form_label('Apellidos','last_name');
							echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'value' => set_value('last_name'), 'class' => 'required'));
						?>
					</div>
					<div class="input_a big_input">
						<?php
							echo form_label('Correo electrónico','email');
							echo form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email'), 'class' => 'required'));		
						?>
					<span id="email_message" style="color:#ff0000;"></span> 
					</div>
					<div class="input_b big_input">
						<?php
							echo form_label('Contraseña','password');
							echo form_password(array('name' => 'password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'required'));
						?>					
					</div>
					<hr>
					<div class="btn_box">
						<?php
							echo form_submit(array('name' => 'register_button', 'id' => 'register_button', 'value' => 'Crear cuenta', 'class' => 'form_btn'));
						?>					
					</div>
				<?php echo form_close(); ?>
		</article>
	</section>
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