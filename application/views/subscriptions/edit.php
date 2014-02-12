<h1>Elija un plan</h1>
<form action="<?php echo base_url().'subscriptions/update'; ?>" method="post">
<?php
	foreach ($aPlans as $key)
	{?>
		 <div style="border:solid;border-color:blue;">
			<b><?php echo $key['name'];?></b>
			<ul>
				<?php if ($key['campaigns'] == -1)
				{?>
					<li>Número ilimitado de campañas</li>
				<?php }
				else
				{?>
					<li>Sólo <?php echo $key['campaigns'];?> campaña</li>
				<?php }
				if ($key['campaign_duration'] == -1)
				{?>
					<li>Duración ilimitada de las campañas</li>
				<?php }
				else
				{?>
					<li>La campaña puede durar hasta <?php echo $key['campaign_duration'];?> días</li>
				<?php }
				if ($key['users'] == -1)
				{?>
					<li>Número ilimitado de participantes</li>
				<?php }
				else
				{?>
					<li><?php echo $key['users'];?> participantes máximo</li>
				<?php }
				if ($key['reports'] == 1)
				{?>
					<li>Reportes y análisis</li>
				<?php }
				else
				{?>
				No entrega reportes
				<?php } 
				if ($key['price'] == 0)
				{?>
					<li>Gratis</li>
				<?php }
				elseif ($key['price'] == 4990)
				{ ?>
					<li>$ <?php echo $key['price']; ?> /campaña</li>
				<?php }
				else
				{ ?>
					<li>$ <?php echo $key['price']; ?> /año</li>
				<?php }
			  
			  ?>
			</ul>
			<?php if ($key['id'] == $aSubscription[0]['plan_id'])
			{?>
				<input type="radio" id="<?php echo $key['id'];?>" name="select_plan_radio" value="<?php echo $key['id'];?>" checked>				
			<?php }
			else
			{?>
				<input type="radio" id="<?php echo $key['id'];?>" name="select_plan_radio" value="<?php echo $key['id']; ?>">
			<?php } ?>
				<label for="<?php echo $key['id'];?>">Elegir plan</label><br>
		</div>
		<br>
	<?php }
?>
	<input type="submit" name="change_plan" value="Cambiar plan">
</form>