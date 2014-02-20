<h1>crear promo</h1>


<?php 
	$aAttributes = array('id' => 'create-form-promo');
	echo form_open_multipart('promos/create', $aAttributes);
		echo form_label('Titulo','title');
		echo form_input(array('name' => 'title', 'id' => 'title', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('Descripcion','description');
		echo form_textarea(array('name' => 'description', 'id' => 'description', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('Términos y condiciones','terms');
		echo form_textarea(array('name' => 'terms', 'id' => 'terms', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('Inicia','start_datetime');
		echo form_input(array('name' => 'start_datetime', 'id' => 'start_datetime', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('Finaliza','end_datetime');
		echo form_input(array('name' => 'end_datetime', 'id' => 'end_datetime', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('N° participantes','number_participants');
		$options = array('select' => 'Selecciona',$aPlan[0]['users'] => 'hasta '.$aPlan[0]['users']);
		echo form_dropdown('number_participants', $options, 'select', 'id = number_participants');
		echo '<br/>';
		echo form_label('N° ganadores','number_winners');
		$options = array('select' => 'Selecciona',1 => 1);
		echo form_dropdown('number_winners', $options, 'select', 'id = number_winners');
		echo '<br/>';
		echo form_label('Imagen','image');
		echo form_input(array('name' => 'image', 'id' => 'image', 'type' => 'file', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('Categorias');
		echo form_dropdown('category1', $aOptionsCategories, 0);
		echo '<br/>';
		echo form_dropdown('category2', $aOptionsCategories, 0);
		echo '<br/>';
		echo form_dropdown('category3', $aOptionsCategories, 0);
		echo '<br/>';
		echo form_submit(array('name' => 'create_promo', 'id' => 'create_promo', 'value' => 'Crear campaña'));

	echo form_close();
?>



<script type="text/javascript">
	$(function() {
	    $('#start_datetime').datetimepicker({
	    	dateFormat: "dd-mm-yy",
	    	timeFormat: 'HH:mm'
    	});
    	$( "#start_datetime" ).datepicker( "option", "closeText", "Cerrar" );
    	$( "#start_datetime" ).datepicker( "option", "currentText", "Fecha actual" );
 		
 		$('#end_datetime').datetimepicker({
	    	dateFormat: "dd-mm-yy",
	    	timeFormat: 'HH:mm'
    	});

    	$( "#end_datetime" ).datepicker( "option", "closeText", "Cerrar" );
    	$( "#end_datetime" ).datepicker( "option", "currentText", "Fecha actual" );
 	});
</script>