<?php
if($sIsNotified === 'is_notified'){ ?>
			<div class="success">Notificados</div>
<?php }  ?>
<div class="container">
	<?php
		$is_notified = 0;
		foreach ($aWinners as $winner) {?>
			<p>
				Nombre: <?=$winner['names'].' '.$winner['last_name']?>
				-
				<?php
					if($winner['notified_at'] != '0000-00-00 00:00:00'){ ?>
						notificado
				<?php }else{ 
						$is_notified = $is_notified + 1;
					?>
						no notificado
				<?php } ?>
			</p>
		<?php }
	?>
	<?php if($is_notified > 0){ ?>
		<a href="<?=base_url()?>winners/notify_winners/<?=$iPromoId?>">Notificar a todos</a>
	<?php } ?>
</div>