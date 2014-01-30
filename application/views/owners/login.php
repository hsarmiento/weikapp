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
		
		echo form_open('owners/login');			
			echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Tu correo electrónico', 'value' => $sEmail));
			echo '<br/>';
			echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña'));
			echo '<br/>';
			echo form_submit(array('name' => 'login_button', 'id' => 'login_button', 'value' => 'Ingresar'));
		echo form_close();
	}
?>
