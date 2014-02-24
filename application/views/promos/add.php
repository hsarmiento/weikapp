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
		echo form_label('Etiquetas','tags');
		echo form_input(array('name' => 'tags', 'id' => 'tags', 'class' => 'required', 'placeholder' => 'Escribir separado por comas. Max 100 caracteres')).'*';
		echo '<br/>';
		echo form_label('Sexo', 'gender').'   ';
		foreach ($aGender as $id => $gender) {
			echo form_radio('gender',$id,NULL, 'id="'.$gender.'" class="required"'.set_radio('gender', $id)).ucfirst($gender);
		}
		echo '<br/>';
		echo form_label('Localidad');
		echo form_dropdown('township', $aOptionsTownships, 0, 'id = township');
		echo '<br/>';
		echo form_label('No está tu ciudad? Solicítala acá','new_city');
		echo form_input(array('name' => 'new_city', 'id' => 'new_city')).'*';
		echo '<br/>';
		$aButton = array(
			'name' => 'preview',
			'id' => 'preview',
			'content' => 'Preview'
			);
		echo form_button($aButton);
		echo form_submit(array('name' => 'create_promo', 'id' => 'create_promo', 'value' => 'Crear campaña'));

	echo form_close();
?>


<div class="ui-dialog" id="dialog_preview">
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


</script>



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
		 		},
		 		tags:{
		 			required:true,
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
		 		},
		 		tags:{
		 			required: "Es necesaria al menos 1 etiqueta"
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
    	$("#dialog_preview").show();

    });
</script>