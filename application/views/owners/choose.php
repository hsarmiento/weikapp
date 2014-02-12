<ul>
	<?php 
		foreach ($aCompanies as $key)
		{ ?>
			<li><a href="<?php echo base_url().'owners/select/'.$key['id'];?>"><?php echo $key['name']?></a></li>
		<?php }

	?>
</ul>