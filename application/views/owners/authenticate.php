<div class="container">
	<section>
		<div class="promo_title">
			Login
		</div>
		<hr />
		<article>
			<a href="<?= $this->facebook_utils->get_login_url(array('scope' => 'email,publish_stream,publish_actions,manage_pages','redirect_uri' => base_url().'owners/fblogin'))?>">Inicia sesión con Facebook</a>
			<br /><br />
			<span>o con los siguientes datos:</span>
			<?php
				echo validation_errors();

				$aAttributes = array('id' => 'login-form');
				echo form_open('owners/login',$aAttributes);
					?>
					<div class="input_a big_input">
						<?php 
							echo form_label('Email','email');
							echo form_input(array('name' => 'email', 'id' => 'email',  'value' => set_value('email'), 'class' => 'required'));
						?>
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
							echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Ingresar', 'class' => 'form_btn'));
						?>					
					</div>
					<a href="<?php echo base_url().'owners/recovery' ?>" id="forgot_password">Olvidé la contraseña</a>

				<?php echo form_close(); ?>
		</article>
	</section>
</div>

<script type="text/javascript">
	$(function(){
		 $("#login-form").validate({
		 	errorElement: "div",
		 	errorClass: "warning",
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