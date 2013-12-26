<?php 
	$timestamp = strtotime($aPromo['end_datetime']);
	$end_date = getdate($timestamp);
?>

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

	<div id="countdown"></div>

</div>


<script type="text/javascript">
	$("#countdown").countdown({ 
		layout:'<b>{d<}{dn} {dl} {d>}'+'{hn} {hl}, {mn} {ml}, {sn} {sl}</b>',
		labels: ['Años', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
    	until: new Date(<?=$end_date['year']?>, <?=$end_date['mon']?>-1, <?=$end_date['mday']?>, <?=$end_date['hours']?>,<?=$end_date['minutes']?>,<?=$end_date['seconds']?>)
	});
</script>



