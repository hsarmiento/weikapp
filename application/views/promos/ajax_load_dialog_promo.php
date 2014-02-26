<?php 
	$timestamp = strtotime($aPromo['end_datetime']);
	$end_date = getdate($timestamp);
?>

<?php if (isset($sPublishAction) && $sPublishAction == 'permissions_denied')
{ ?>
	<p style="color:#ff0000;border-style:solid;border-color:#00ff00;border-width:10px;">
		Para poder participar debe dar permisos de publicacion para postear en facebook automaticamente 
		<a href="<?php echo $sLoginUrl; ?>">Dar permisos</a>
	</p>
<?php } ?>
<a href="#create_promo" title="Cerrar" class="close" id="close_preview">X</a>
<h2><?=$aPromo['title']?></h2>
<div class="fleft">
	<div class="btns">
		<div class="number">1º</div>
		<div id="triangulo-right"></div>
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $aPromo['fanpage']['fanpage_fb']; ?>&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=trebuchet+ms&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:20px;" allowTransparency="true"></iframe>
	</div>
	<div class="btns">
		<div class="number">2º</div>
		<div id="triangulo-right"></div>
			<?php
			if ($aPromo['number_participants'] - $aPromo['count_competitors'] > 0 )
			{
				if ($aPromo['is_logged'] === true)
				{
					if ($aPromo['joined'] === false)
					{?>
						<a href="<?php echo base_url();?>competitor/participate/<?php echo $aPromo['id']; ?>/<?=$category?>">Participar</a>
					<?php }
					elseif($aPromo['ended'] == 0)
					{?>
						<span>Estás participando</span>
					<?php }elseif($aPromo['ended'] == 1){ ?>
						<span>Ya participaste</span>
					<?php }
				}
				else
				{ ?>
					<a onclick="participate();" href="#dialog_promo">Participar</a>
				<?php }
			}
			else
			{ ?>
				<p>Agotado</p>
			<?php } ?>
	</div>
	<div class="expire">
		<img src="<?=base_url()?>public/img/clock.png" alt="time" />
		<?php if($aPromo['ended'] == 0){ ?>
			<span id="countdown"></span>	
		<?php }else{ ?>
			<span>Finalizado</span>
		<?php } ?>
		
	</div>
	<div class="people">
		<img src="<?=base_url()?>public/img/user_img.png" alt="time" />
		<?=$aPromo['count_competitors']?> Participantes	
	</div>
	<?php if ($aPromo['count_competitors'] > 0)
	{ ?>
		<h4>Ellos tambien están participando:</h4>
		<div class="photo_people">
			<?php 
				for ($i=0; $i < count($aPromo['competitors']); $i++)
				{?>
					<figure><a href="http://www.facebook.com/<?=$aPromo['competitors'][$i]['fb_username']?>" target="_blank"><img src="http://graph.facebook.com/<?=$aPromo['competitors'][$i]['fb_uid']?>/picture"></a></figure>
				<?php } ?>
		</div>
		<?php }else{ ?>
			<h4>Puedes ser el primero en participar!</h4>
			<div class="photo_people">
				<figure></figure>
			</div>
		<?php	}?>
	<div class="dialog_text">
		<h3>Detalles</h3>
		<p><?=$aPromo['description']?></p>
	</div>
</div>
<div class="fright">
	<figure>
		<img src="<?=base_url()?>public/img/promos_medium/<?=md5($aPromo['id'])?>" alt="promo_img" />
	</figure>
	<div class="dialog_text">
		<h3>Términos y condiciones</h3>
		<p><?=$aPromo['terms']?></p>
	</div>
</div>


<script type="text/javascript">	
	function participate()
	{
		// $("#dialog").empty();
		$("#dialog").empty().load("<?php echo base_url();?>competitor/participate/<?php echo $aPromo['id']; ?>/<?=$category?>");
	}

	$("#countdown").countdown({ 
		layout:'Expira en {d<}{dn} {dl} {d>},'+'{hn}:{mn}:{sn}',
		labels: ['Años', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
		labels1: ['Año', 'Mes', 'Semana', 'Dia', 'Hora', 'Minuto', 'Segundo'],
    	until: new Date(<?=$end_date['year']?>, <?=$end_date['mon']?>-1, <?=$end_date['mday']?>, <?=$end_date['hours']?>,<?=$end_date['minutes']?>,<?=$end_date['seconds']?>)
	});

	$("#close_preview").click(function(){
		jQuery('#dialog').dialog('close');
	});
</script>



