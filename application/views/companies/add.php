<h1>Crear empresa</h1>
<?php 
	$aAttributes = array('id' => 'create-form');
	echo form_open('companies/create', $aAttributes);
		echo '*'.form_input(array('name' => 'name', 'id' => 'name', 'placeholder' => 'Nombre', 'value' => set_value('name'), 'class' => 'required'));
		echo '<br/>';
		echo '*'.form_input(array('name' => 'city', 'id' => 'city', 'placeholder' => 'Ciudad', 'value' => set_value('city'), 'class' => 'required'));
		echo '<br/>';
		echo form_input(array('name' => 'website', 'id' => 'website', 'placeholder' => 'Página web', 'value' => set_value('website')));
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
		 		}		 		
		 	},
		 	messages:{
		 		name: {
		 			required: "Ingresa el nombre de tu empresa"
		 		},
		 		city: {
		 			required: "Ingresa la ciudad donde se encuentra"
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