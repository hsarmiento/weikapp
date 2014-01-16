<?php 
	$timestamp = strtotime($aPromo['end_datetime']);
	$end_date = getdate($timestamp);
?>

<div class="dialog-promo" id="dialog-promo">
	<?php if (isset($sPublishAction) && $sPublishAction == 'permissions_denied')
	{ ?>
		<p style="color:#ff0000;border-style:solid;border-color:#00ff00;border-width:10px;">Para poder participar debe dar permisos de publicacion para postear en facebook automaticamente <a href="<?php echo $sLoginUrl; ?>">Dar permisos</a></p>
	<?php } ?>
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
	<?php 
		if ($aPromo['is_logged'] === true)
		{
			if ($aPromo['joined'] === false)
			{?>
				<a href="<?php echo base_url();?>competitor/participate/<?php echo $aPromo['id']; ?>/<?=$category?>">Participar</a>
			<?php }
			else
			{?>
				<p>Ya estas particando campeón</p>
			<?php }
		}
		else
		{ ?>
			<a onclick="participate();" href="#">Participar</a>
		<?php } ?>

	<div id="countdown"></div>
	<p>Participantes: <?=$aPromo['count_competitors']?></p>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacus felis, consequat condimentum nulla a, luctus placerat dui. Maecenas at aliquam libero, semper consequat turpis. Vivamus rhoncus egestas imperdiet. Integer sed lectus volutpat, scelerisque velit vulputate, malesuada nibh. Vestibulum nisi felis, vestibulum laoreet eros at, bibendum porta ante. Integer pellentesque dui nisi, eget semper eros ullamcorper sed. In tortor lacus, facilisis vel interdum mattis, eleifend nec ipsum.

		Aenean eu purus convallis odio vehicula tristique quis quis leo. Aenean et tincidunt magna. Suspendisse suscipit tempor eros quis auctor. Aliquam at feugiat orci. Quisque quis gravida magna. Maecenas consequat diam odio. Proin tincidunt placerat malesuada. Sed viverra, felis eget pharetra facilisis, sapien diam luctus risus, elementum venenatis velit massa vitae arcu. Donec ac porta augue, eget pretium nisi. Vestibulum tristique est sapien, laoreet accumsan quam venenatis vel. Nullam at tristique purus. Fusce nec lacus suscipit, convallis augue sit amet, scelerisque nisl. Suspendisse potenti. Cras varius magna at elit ornare convallis.
	</p>
</div>

<script type="text/javascript">	
	function participate()
	{
		$("#dialog-promo").empty().load("<?php echo base_url();?>competitor/participate/<?php echo $aPromo['id']; ?>/<?=$category?>");
	}

	$("#countdown").countdown({ 
		layout:'<b>{d<}{dn} {dl} {d>}'+'{hn} {hl}, {mn} {ml}, {sn} {sl}</b>',
		labels: ['Años', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
    	until: new Date(<?=$end_date['year']?>, <?=$end_date['mon']?>-1, <?=$end_date['mday']?>, <?=$end_date['hours']?>,<?=$end_date['minutes']?>,<?=$end_date['seconds']?>)
	});
</script>



