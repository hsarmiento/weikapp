<h1>Editar usuario</h1>
<?php
	if(isset($sSuccess)){ ?>
		<div class="success">Actualizado</div>
	<?php } ?>
<div class="container">
 <?php
 	$aAttributes = array('id' => 'edit-user-form');
 	echo form_open('user/update', $aAttributes);

 		echo form_label('Nombres','names');
 		echo form_input(array('name'=>'names','id'=>'names','value'=>$aUserData['names'], 'class' => 'required'));
	 	echo '<br>';
	 	echo form_label('Apellidos','last_name');
 		echo form_input(array('name'=>'last_name','id'=>'last-name','value'=>$aUserData['last_name'], 'class' => 'required'));
	 	echo '<br>';
	 	echo form_label('Email','email');
 		echo form_input(array('name'=>'email','id'=>'email','value'=>$aUserData['email'], 'class' => 'required'));
	 	echo '<br>';
	 	foreach ($aCategories as $category) {
	 		$aOptions = array('name' => $category['name'], 'id' => $category['name'], 'value' =>$category['id']);
			if($category['exist'] === 1){
	 			$aOptions['checked'] = 'TRUE';
	 		}
	 		echo form_label($category['name'],$category['name']);
	 		echo form_checkbox($aOptions);
	 		echo '<br>';
	 	}
	 	echo form_hidden('user_id', $iUid);
 		echo form_submit('update_user','Guardar');
 	echo form_close();
 ?>
</div>

<script type="text/javascript">
	$(function(){
		 $("#edit-user-form").validate({
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
