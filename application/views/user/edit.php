<?php
	if(isset($sSuccess)){ ?>
		<div class="success">Actualizado</div>
<?php } ?>
<div class="container">
	<section>
		<div class="promo_title">
			Editar perfil
		</div>
		<hr />
		<article>			
			 <?php
			 	$aAttributes = array('id' => 'edit-user-form');
			 	echo form_open('user/update', $aAttributes); ?>
					<div class="input_a big_input">
				 		<?php
					 		echo form_label('Nombres','names');
					 		echo form_input(array('name'=>'names','id'=>'names','value'=>$aUserData['names'], 'class' => 'required'));
					 	?>
				 	</div>
				 	<div class="input_b big_input">
				 		<?php
				 			echo form_label('Apellidos','last_name');
			 				echo form_input(array('name'=>'last_name','id'=>'last-name','value'=>$aUserData['last_name'], 'class' => 'required'));
				 		?>
				 	</div>
				 	<div class="input_a big_input">
				 		<?php 
						 	echo form_label('Email','email');
					 		echo form_input(array('name'=>'email','id'=>'email','value'=>$aUserData['email'], 'class' => 'required'));
			 			?>
				 	</div>
				 	<div class="input_b">
					 	<?php
					 		echo form_label('Preferencias','preferencias');
						 	foreach ($aCategories as $category) {
						 		$aOptions = array('name' => $category['name'], 'id' => $category['name'], 'value' =>$category['id']);
								if($category['exist'] === 1){
						 			$aOptions['checked'] = 'TRUE';
						 		}
						 		echo form_checkbox($aOptions).ucfirst($category['name']).' ';
						 	}
					 	?>
					 </div>
					 <hr>
					 <?php
				 	echo form_hidden('user_id', $iUid);
				 	?>
				 	<div class="btn_box">
				 		<?php
				 			echo form_submit(array('name' => 'update_user', 'id' => 'update_user', 'value' => 'Guardar', 'class' => 'form_btn'));
				 		?>			 		
			 		</div>
			 		<?php
			 	echo form_close();
			 ?>
		</article>
	</section>
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
