<?php

// print_r($aWinners);
?>

<div class="container">
	<?php
		foreach ($aWinners as $winner) {?>
			<p>
				Nombre: <?=$winner['names'].' '.$winner['last_name']?>
				-
				<?php
					if($winner['notified'] != '0000-00-00 00:00:00'){ ?>
						notificado
				<?php }else{ ?>
						no notificado
				<?php } ?>
			</p>
		<?php }
	?>
	<a href="<?=base_url()?>winners/">Notificar a todos</a>
</div>