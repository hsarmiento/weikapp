<h1>Editar usuario</h1>
<?php
	if(isset($sSuccess)){ ?>
		<div class="success">Actualizado</div>
	<?php } ?>
<div class="container">
 <?php
 	echo form_open('user/update');

 		echo form_label('Nombres','names');
 		echo form_input(array('name'=>'names','id'=>'names','value'=>$aUserData['names']));
	 	echo '<br>';
	 	echo form_label('Apellidos','last_name');
 		echo form_input(array('name'=>'last_name','id'=>'last_name','value'=>$aUserData['last_name']));
	 	echo '<br>';
	 	echo form_label('Email','email');
 		echo form_input(array('name'=>'email','id'=>'email','value'=>$aUserData['email']));
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