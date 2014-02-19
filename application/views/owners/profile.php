<h1>Perfil de empresa</h1>

<h3>Empresa</h3>
<a href="<?php echo base_url().'owners/choose';?>">Cambiar empresa</a> <a href="<?php echo base_url().'companies/add' ?>">Crear empresa</a>
<hr>
<?php if ($this->session->userdata('company_fbpid') == null)
{?>
	<img src="<?php echo base_url().'public/img/companies/'.md5($this->session->userdata('company_id'));?>.png" alt="company_photo">
<?php }
else
{ ?>
	<img src="http://graph.facebook.com/<?php echo $this->session->userdata('company_fbpid'); ?>/picture" alt="company_photo">
<?php } 
 ?>
<h2><?php echo $this->session->userdata('company_name'); ?></h2>
<a href="<?php echo base_url().'subscriptions/edit'; ?>"><?php echo $aPlan['name']; ?></a> <!-- <a href="#">Editar empresa</a> -->
<a href="<?php echo base_url().'promos/add';?>">Crear campaña</a>
<hr>

<h4>Ultimas campañas</h4>
<hr>
<ul>
	<?php
	if (count($aPromos) > 0)
	{
		foreach ($aPromos as $key) { ?>
			<li><?=$key['title']?></li>
		<?php } 
	}
	else
	{?>
		No ha creado ninguna campaña aun
	<?php }?>
</ul>
