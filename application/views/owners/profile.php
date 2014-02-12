<h1>Perfil de empresa</h1>

<h3>Empresa</h3>
<a href="#">Cambiar empresa</a> <a href="<?php echo base_url().'companies/add' ?>">Crear empresa</a>
<hr>
<?php if ($this->session->userdata('company_fbpid') == null)
{?>
	<img src="#" alt="company_photo">
<?php }
else
{ ?>
	<img src="http://graph.facebook.com/<?php echo $this->session->userdata('company_fbpid'); ?>/picture" alt="company_photo">
<?php }
 ?>
<h2><?php echo $aCompany['name']; ?></h2>
<a href="<?php echo base_url().'subscriptions/edit'; ?>"><?php echo $aPlan['name']; ?></a> <a href="#">Editar empresa</a>
<a href="#">Crear campaña</a>
<hr>