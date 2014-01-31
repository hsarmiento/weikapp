<?php 
	if ($iResults > 0)
	{?>
		<h1>Validado el mail po campeón. Ahora puedes logearte</h1>		
	<?php 
		echo form_open('owners/login');			
			echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => set_value('email'), 'onblur' => 'validate_email()'));
			echo '<br/>';
			echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña', 'value' => set_value('password')));
			echo '<br/>';
			echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Ingresar'));
		echo form_close();
	}
	else
	{?>
		<h1>Email invalido</h1>
	<?php }
?>

