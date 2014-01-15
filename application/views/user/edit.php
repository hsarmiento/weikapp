<h1>Editar usuario</h1>
<div class="container">
 <?php
 	echo form_open('user/update');
	 	foreach ($aCategories as $category) {
	 		$aOptions = array('name' => $category['name'], 'id' => $category['name'], 'value' =>'checked');
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