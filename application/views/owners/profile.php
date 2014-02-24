<div class="container">
	<section>
		<article>
			<div class="company_logo">
				<!-- foto de la company -->
					<img src="img/company_big.png" alt="company" />		
			</div>
			<div class="company">
				<h3><?php echo $this->session->userdata('company_name'); ?></h3>
				<a href="<?php echo base_url().'owners/choose';?>">
					<img src="<?php echo base_url(); ?>public/img/change_company.png" alt="change_company" />
				</a>
			</div>
			<div class="create_promo">
				<div class="button_create">
					<a href="<?php echo base_url().'promos/add';?>">NUEVA PROMOCIÓN</a>
				</div>
			</div>
			<div class="company_type">
				<a href="<?php echo base_url().'subscriptions/edit'; ?>" alt="company_type"><?php echo $aPlan['name']; ?></a>
			</div>
		</article>
		<hr />
		<article>
			<h4>
				+ Últimas promociones
			</h4>
			<?php
				if (count($aPromos) > 0)
				{
					$count = 0;
					foreach ($aPromos as $key) { 
						$count++;
						if ($count%2 == 0) {?>
							<div class="promo_b">
								<a href="#"><?=$key['title']?></a>
							</div>
						<?php } else {?>
							<div class="promo_a">
								<a href="#"><?=$key['title']?></a>
							</div>
						<?php }	?>
					<?php } 
				}
				else
				{?>
					<div class="promo_a">
						<a href="#">No ha creado ninguna promoción aun</a>
					</div>					
			<?php }?>
			
		</article>
	</section>
</div>