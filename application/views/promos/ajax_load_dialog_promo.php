<div class="dialog-promo">
	<p>Nombre promo:<?=$aPromo['title']?></p>
	<p>Descripcion: <?=$aPromo['description']?></p>
	<p>Terminos y condiciones: <?=$aPromo['terms']?></p>
	<p>Fecha de inicio: <?=$aPromo['start_datetime']?></p>
	<p>Fecha de termino: <?=$aPromo['end_datetime']?></p>
	<?php
		if($aPromo['image'] == 1){ ?>
			<img src="<?php echo base_url();?>public/img/piscola.jpg" width="320" height="225">
		<?php } ?>

</div>