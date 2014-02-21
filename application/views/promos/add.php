<style type="text/css">

.ui-widget-content {
	border: 1px solid #dddddd;
	background: #eeeeee url(../img/ui-bg_highlight-soft_100_eeeeee_1x100.png) 50% top repeat-x;
	color: #333333;
}

</style>


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
		$options = array('0' => 'Selecciona',$aPlan[0]['users'] => 'hasta '.$aPlan[0]['users']);
		echo form_dropdown('number_participants', $options, 'select', 'id = number_participants class = required');
		echo '<br/>';
		echo form_label('N° ganadores','number_winners');
		$options = array('0' => 'Selecciona',1 => 1);
		echo form_dropdown('number_winners', $options, 'select', 'id = number_winners class = required');
		echo '<br/>';
		echo form_label('Imagen','image');
		echo form_input(array('name' => 'image', 'id' => 'image', 'type' => 'file', 'class' => 'required')).'*';
		echo '<br/>';
		echo form_label('Categorias');
		echo form_dropdown('category1', $aOptionsCategories, 0, 'id = category1 class = required');
		echo '<br/>';
		echo form_dropdown('category2', $aOptionsCategories, 0, 'id = category2 class = required');
		echo '<br/>';
		echo form_dropdown('category3', $aOptionsCategories, 0, 'id = category3 class = required');
		echo '<br/>';
		echo form_submit(array('name' => 'create_promo', 'id' => 'create_promo', 'value' => 'Crear campaña'));

	echo form_close();
?>



<script type="text/javascript">
	$(function() {
	    $('#start_datetime').datetimepicker({
	    	dateFormat: "dd-mm-yy",
	    	timeFormat: 'HH:mm',
	    	onSelect: function (selectedDateTime){
	    		$("#end_datetime").datetimepicker('option', 'minDate', $('#start_datetime').datetimepicker('getDate') );
			}
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

	$.validator.addMethod("notEqualTo", function(value,elemtent){
		if ($("#category1").val() != $("#category2").val() && $("#category1").val() != $("#category3").val() && $("#category2").val() != $("#category3").val()) {
			return true;
		}
		else
		{
			return false;
		}
	},"Las categorías deben ser distintas");

 	$(function(){
		 $("#create-form-promo").validate({
		 	errorElement: "div",
		 	rules:{
		 		title: {
		 			required: true
		 		},
		 		description: {
		 			required: true
		 		},
		 		terms: {
		 			required: true
		 		},
		 		start_datetime: {
		 			required: true
		 		},
		 		end_datetime: {
		 			required: true
		 		},
		 		number_participants: {
		 			required: true,
		 			min: 1
		 		},
		 		number_winners: {
		 			required: true,
		 			min: 1
		 		},
		 		image: {
		 			required: true
		 		},
		 		category1: {
		 			required: true,
		 			min: 1,
		 			notEqualTo: true
		 		},
		 		category2: {
		 			required: true,
		 			min: 1,
		 			notEqualTo: true
		 		},
		 		category3: {
		 			required: true,
		 			min: 1,
		 			notEqualTo: true
		 		}
		 	},
		 	messages:{
		 		title: {
		 			required: "Es necesario un título para su promoción"
		 		},
		 		description: {
		 			required: "Es necesaria una descripción para su promoción"
		 		},
		 		terms: {
		 			required: "Son necesarios los términos y condiciones para su promoción"
		 		},
		 		start_datetime: {
		 			required: "Es necesaria una fecha de inicio para su promoción"
		 		},
		 		end_datetime: {
		 			required: "Es necesaria una fecha de término para su promoción"
		 		},
		 		number_participants: {
		 			min: "Es necesario el número de participantes para su promoción"
		 		},
		 		number_winners: {
		 			min: "Es necesario el número de ganadores para su promoción"
		 		},
		 		image: {
		 			required: "Es necesaria una imagen para su promoción"
		 		},
		 		category1: {
		 			min: "Es necesaria una categoría para su promoción"
		 		},
		 		category2: {
		 			min: "Es necesaria una categoría para su promoción"		 			
		 		},
		 		category3: {
		 			min: "Es necesaria una categoría para su promoción"
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