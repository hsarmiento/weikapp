
<div class="container">
	<section>
		<div class="promo_title">
			Crear promoción				
		</div>
		<hr />
		<article>
			<?php
				$aAttributes = array('id' => 'create-form-promo');
				echo form_open_multipart('promos/create', $aAttributes);
			?>
					<div class="input_a big_input">
						<?php 
							echo form_label('Título','title');
							echo form_input(array('name' => 'title', 'id' => 'title', 'class' => 'required'));
						?>
						<!-- <div class="warning">*Este campo es obligatorio</div> -->
					</div>
					<div class="input_b">
						<?php
							echo form_label('Descripción','description');
							echo form_textarea(array('name' => 'description', 'id' => 'description', 'class' => 'required', 'rows' => '10', 'cols' => '50', 'placeholder' => 'Describe tu promoción'));
						?>
						<!-- <div class="warning">*Este campo es obligatorio</div> -->
					</div>
					<div class="input_a">
						<?php 
							echo form_label('Términos y condiciones','terms');
							echo form_textarea(array('name' => 'terms', 'id' => 'terms', 'class' => 'required', 'rows' => '10', 'cols' => '50', 'placeholder' => 'Describe los términos y condiciones'));
						?>
					</div>
					<div class="input_b">
						<?php
							echo form_label('Inicia','start_datetime');
							echo form_input(array('name' => 'start_datetime', 'id' => 'start_datetime', 'class' => 'required', 'placeholder' => 'Fecha de inicio'));
						?>
						<a href="#start_datetime" id="open_start_dt">
							<img src="<?=base_url()?>public/img/calendar.png">
						</a>
					</div>
					<div class="input_a">
						<?php
							echo form_label('Finaliza','end_datetime');
							echo form_input(array('name' => 'end_datetime', 'id' => 'end_datetime', 'class' => 'required', 'placeholder' => 'Fecha de término'));
						?>
						<a href="#end_datetime" id="open_end_dt">
							<img src="<?=base_url()?>public/img/calendar.png">
						</a>
						Si quieres mas tiempo, <a href="#">click aquí.</a>
					</div>
					<div class="input_b">
						<?php
							echo form_label('N° participantes','number_participants');
							$options = array('0' => 'Selecciona',$aPlan[0]['users'] => 'hasta '.$aPlan[0]['users']);
							echo form_dropdown('number_participants', $options, 'select', 'id = number_participants class = required');
						?>

						Si quieres mejorar tu alcance, <a href="#">click aquí.</a>
					</div>
					<div class="input_a">
						<?php 
							echo form_label('N° ganadores','number_winners');
							$options = array('0' => 'Selecciona',1 => 1);
							echo form_dropdown('number_winners', $options, 'select', 'id = number_winners class = required');
						?>
						Si quieres premiar a mas personas, <a href="#">click aquí.</a>
					</div>
					<div class="input_b">
						<?php
							echo form_label('Cargar imagen','image');
							echo form_input(array('name' => 'image', 'id' => 'image', 'type' => 'file', 'class' => 'required'));
						?>
					</div>
					<div class="input_a">
						<?php
							echo form_label('Categorias');
							echo form_dropdown('category1', $aOptionsCategories, 0, 'id = category1 class = required');
							echo form_dropdown('category2', $aOptionsCategories, 0, 'id = category2 class = required');
							echo form_dropdown('category3', $aOptionsCategories, 0, 'id = category3 class = required');
						?>
					</div>
					<div class="input_b big_input">
						<?php
							echo form_label('Etiquetas','tags');
							echo form_input(array('name' => 'tags', 'id' => 'tags', 'class' => 'required', 'placeholder' => 'Escribir separado por comas. Max 100 caracteres'));
						?>
					</div>
					<div class="input_a">
						<?php
							echo form_label('Sexo', 'gender').'   ';
							foreach ($aGender as $id => $gender) {
								echo form_radio('gender',$id,NULL, 'id="'.$gender.'" class="required"'.set_radio('gender', $id)).ucfirst($gender);
							}
						?>
					</div>
					<div class="input_b">
						<?php
							echo form_label('Localidad');
							echo form_dropdown('township', $aOptionsTownships, 0, 'id = township');
						?>
					</div>
					<div class="input_c">
						<?php
							echo form_label('No está tu ciudad? Solicítala acá','new_city');
							echo form_input(array('name' => 'new_city', 'id' => 'new_city'));
						?>
					</div>
					<hr>
					<div class="btn_box">

						<?php
							echo form_submit(array('name' => 'create_promo', 'id' => 'create_promo', 'value' => 'Crear campaña', 'class' => 'form_btn'));
							$aButton = array(
								'name' => 'preview',
								'id' => 'preview',
								'content' => 'Previsualizar',
								'class' => 'form_btn'
								);
								echo form_button($aButton);
						?>
					</div>

			<?php
				echo form_close();
			?>
		
		</article>

	</section>
</div>


<div class="ui-dialog" id="dialog_preview">
	<a href="#create_promo" title="Cerrar" class="close" id="close_preview">X</a>
	<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h2>
	<div class="fleft">
		<div class="btns">
			<div class="number">1º</div>
			<div id="triangulo-right"></div>
			<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.bufa.es&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=trebuchet+ms&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:20px;" allowTransparency="true"></iframe>
		</div>
		<div class="btns">
			<div class="number">2º</div>
			<div id="triangulo-right"></div>
			<a href="#">Participa</a>
		</div>
		<div class="expire">
			<img src="<?=base_url()?>public/img/clock.png" alt="time" />
			Expira en <span>29:30:45</span>	
		</div>
		<div class="people">
			<img src="<?=base_url()?>public/img/user_img.png" alt="time" />
			203 Participantes	
		</div>
		<h4>Ellos tambien están participando:</h4>
		<div class="photo_people">
			<figure><img src="<?=base_url()?>public/img/fb_01.png" alt="ok" /></figure>
			<figure><img src="<?=base_url()?>public/img/fb_02.png" alt="ok" /></figure>
			<figure><img src="<?=base_url()?>public/img/fb_03.png" alt="ok" /></figure>
			<figure><img src="<?=base_url()?>public/img/fb_04.png" alt="ok" /></figure>
			<figure><img src="<?=base_url()?>public/img/fb_05.png" alt="ok" /></figure>
		</div>
		<div class="dialog_text">
			<h3>Detalles</h3>
			<p></p>
		</div>
	</div>
	<div class="fright">
		<figure>
			<img src="<?=base_url()?>public/img/piscola.jpg" id="preview_img" alt="promo_img" />
		</figure>
		<div class="dialog_text">
			<h3>Términos y condiciones</h3>
			<p></p>
		</div>
	</div>
</div>

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

 	$("#open_start_dt").click(function(){
 		$("#start_datetime").datepicker("show");
 	});

 	$("#open_end_dt").click(function(){
 		$("#end_datetime").datepicker("show");
 	});

	$.validator.addMethod("notEqualToCateg1", function(value,elemtent){
		if ($("#category1").val() != $("#category2").val() && $("#category1").val() != $("#category3").val()) {
			return true;
		}
		else
		{
			return false;
		}
	},"Las categorías deben ser distintas");

	$.validator.addMethod("notEqualToCateg2", function(value,elemtent){
		if ($("#category1").val() != $("#category2").val() && $("#category2").val() != $("#category3").val()) {
			return true;
		}
		else
		{
			return false;
		}
	},"Las categorías deben ser distintas");

	$.validator.addMethod("notEqualToCateg3", function(value,elemtent){
		if ($("#category1").val() != $("#category3").val() && $("#category2").val() != $("#category3").val()) {
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
		 	errorClass: "warning",
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
		 			min: 1,
		 			notEqualToCateg1: true
		 		},
		 		category2: {
		 			min: 1,
		 			notEqualToCateg2: true
		 		},
		 		category3: {
		 			min: 1,
		 			notEqualToCateg3: true
		 		},
		 		tags:{
		 			required:true
		 		},
		 		gender:{
		 			required: true
		 		}

		 	},
		 	messages:{
		 		title: {
		 			required: "*Este campo es obligatorio"
		 		},
		 		description: {
		 			required: "*Este campo es obligatorio"
		 		},
		 		terms: {
		 			required: "*Este campo es obligatorio"
		 		},
		 		start_datetime: {
		 			required: "*Este campo es obligatorio"
		 		},
		 		end_datetime: {
		 			required: "*Este campo es obligatorio"
		 		},
		 		number_participants: {
		 			min: "*Este campo es obligatorio"
		 		},
		 		number_winners: {
		 			min: "*Este campo es obligatorio"
		 		},
		 		image: {
		 			required: "*Este campo es obligatorio"
		 		},
		 		category1: {
		 			min: "*Este campo es obligatorio"
		 		},
		 		category2: {
		 			min: "*Este campo es obligatorio"		 			
		 		},
		 		category3: {
		 			min: "*Este campo es obligatorio"
		 		},
		 		tags:{
		 			required: "*Este campo es obligatorio"
		 		},
		 		gender: {
		 			required: "*Este campo es obligatorio"
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

		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview_img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image").change(function(){
        readURL(this);
    });

    $("#preview").click(function(){
    	$("#dialog_preview h2").text($("#title").val());
    	$(".fleft .dialog_text p").text($("#description").val());
    	$(".fright .dialog_text p").text($("#terms").val());
    	var style = {"background-image": "none", "background-color": "grey"};
    	$("body").css(style);
    	$(".container").css("opacity", "0.1");
    	$("#dialog_preview").show(400,function(){
			location.href="#dialog_preview";
    	});
    	

    });

    $("#close_preview").click(function(){
    	$("#dialog_preview").hide(300);
    	var style = {"background": "#fff url('<?=base_url()?>public/img/bg.png')", }
    	$("body").css(style);
    	$(".container").css("opacity", "1");
    });
</script>