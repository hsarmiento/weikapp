<h1>Crear empresa</h1>
<?php 
	$aAttributes = array('id' => 'create-form');
	echo form_open_multipart('companies/create', $aAttributes);
		echo '*'.form_input(array('name' => 'name', 'id' => 'name', 'placeholder' => 'Nombre', 'value' => set_value('name'), 'class' => 'required'));
		echo '<br/>';
		echo '*'.form_input(array('name' => 'city', 'id' => 'city', 'placeholder' => 'Ciudad', 'value' => set_value('city'), 'class' => 'required'));
		echo '<br/>';
		echo '*'.form_input(array('name' => 'company_logo', 'id' => 'company_logo', 'placeholder' => 'Imagen corporativa', 'type' => 'file', 'class' => 'required'));
		echo '<br/>';
		echo form_submit(array('name' => 'create_button', 'id' => 'create_button', 'value' => 'Crear empresa'));
	echo form_close();
?>

<script type="text/javascript">
	$(function(){
		 $("#create-form").validate({
		 	errorElement: "div",
		 	rules:{
		 		name: {
		 			required: true
		 		},
		 		city: {
		 			required: true
		 		},
		 		company_logo: {
		 			required: true
		 		}		 		
		 	},
		 	messages:{
		 		name: {
		 			required: "Ingresa el nombre de tu empresa"
		 		},
		 		city: {
		 			required: "Ingresa la ciudad donde se encuentra"
		 		},
		 		company_logo: {
		 			required: "Selecciona una imagen para tu empresa"
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