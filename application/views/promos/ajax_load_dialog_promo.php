<div class="dialog-promo" id="dialog-promo">

	<?php
		echo '<pre>';
		print_r($aPromo);
		echo '</pre>';
	?>
	<p>Nombre promo:<?=$aPromo['title']?></p>
	<p>Descripcion: <?=$aPromo['description']?></p>
	<p>Terminos y condiciones: <?=$aPromo['terms']?></p>
	<p>Fecha de inicio: <?=$aPromo['start_datetime']?></p>
	<p>Fecha de termino: <?=$aPromo['end_datetime']?></p>
	<?php
		if($aPromo['image'] == 1){ ?>
			<img src="<?php echo base_url();?>public/img/piscola.jpg" width="320" height="225">
		<?php } ?>
	</br>
	<div onclick="participate()" style="cursor: pointer; color:blue">Participar</div>

</div>

<script type="text/javascript">
	function participate()
	{
		$("#dialog-promo").empty().load("<?php echo base_url();?>competitor/participate/");
	}
</script>