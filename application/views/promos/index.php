<?php
	$count = count($aData);
	if(count($aPromo) == 0){
		$aPromo = null;
	}
?>

<div class="tabs">
	<a href="#" onclick="$('').toggle('');">Concepción</a>
	<img src="<?php echo base_url()?>public/img/tabs.png" alt="tabs">
	<a href="#" onclick="$('#category_menu').toggle('');"><?php echo $category; ?></a>
	<img src="<?php echo base_url()?>public/img/tabs.png" alt="tabs">
</div>

<div id="dialog">
</div>

<div id="category_menu" class="submenu">
	<h2>
		Categorías
	</h2>
	<?php
		foreach ($aCategories as $value) { ?>
			<div class="links">
				<a href="<?php echo base_url();?>promos/index/<?=$value['name']?>"><?=ucfirst($value['name'])?></a>				
			</div>
		<?php } ?>	
</div>

<div class="container" id="container-promos">
	<?php if($count == 0){ ?>
		<h3>No existen promociones para esta categoría</h3>
	<?php }else{ ?>
		<section> 
			<?php 
			$all_promos = 0;
			$little_promos = 0;
			foreach ($aData as $value) {				
				if($all_promos %3 == 0){ ?>
					<article onclick="open_promo(<?=$value['id']?>, '<?=$value['title']?>', '<?=$sPublishAction?>'); return false;">
						<figure>
							<img src="<?php echo base_url();?>public/img/promos_big/<?=md5($value['id'])?>" alt="foto_promo">
							<figcaption>
								<?=strtoupper($value['title'])?>	
							</figcaption>
							<div class="left">
								<a href="#"><?=ucfirst($value['company_name'])?></a>
							</div>
							<div class="icon_right">
								<img src="<?php echo base_url()?>public/img/time.png" alt="time" />
								<?php if ($value['remaining_days'] == 0)
								{
									if ($value['remaining_hours'] == 0)
									{ ?>
									 	QUEDA MENOS DE 1 HORA
									<?php } 
									else
									{ ?>
									 	QUEDAN <?php echo $value['remaining_hours']; ?> HORAS
									<?php }	?>									
								<?php } else { ?>
									QUEDAN <?=$value['remaining_days']?> DIAS
								<?php } ?>								
							</div>
							<div class="icon_right">
								<img src="<?php echo base_url()?>public/img/people.png" alt="people" />
								<?=$value['number_participants']?>
							</div>						
						</figure>
					</article>
					<hr />
				<?php }else{ ?>
					<article class="w50" onclick="open_promo(<?=$value['id']?>, '<?=$value['title']?>', '<?=$sPublishAction?>'); return false;">
						<figure>
							<img src="<?php echo base_url();?>public/img/promos_small/<?=md5($value['id'])?>" alt="foto_promo">
							<figcaption>
								<?=strtoupper($value['title'])?>	
							</figcaption>
							<div class="left">
								<a href="#"><?=ucfirst($value['company_name'])?></a>
							</div>
							<div class="icon_right">
								<img src="<?php echo base_url()?>public/img/time.png" alt="time" />
								QUEDAN <?=$value['remaining_days']?> DÍAS
							</div>
							<div class="icon_right">
								<img src="<?php echo base_url()?>public/img/people.png" alt="people" />
								<?=$value['number_participants']?>
							</div>						
						</figure>
					</article>
					<?php
						if($little_promos%2==0){ ?>
							<div class="w5">&nbsp;</div>
						<?php
						}else{ ?>
							<hr /> 
						<?php }
					$little_promos = $little_promos + 1;
					} ?>	
				<?php 
				$all_promos  = $all_promos  + 1;		
			} ?>
		</section>
	<?php } ?>	
</div>

<script>

    function settings_dialog()
    {
    	$( "#dialog" ).dialog({
	      modal:true,
	      autoOpen: false,
	      sticky: true,
	      resizable: false,
	      show: {
	        effect: "blind",
	        duration: 300
	      },
	      hide: {
	        effect: "explode",
	        duration: 300
	      },
	      dialogClass: 'fixed-dialog',
			beforeClose: function() {
				$('body').css('overflow','auto'); 
			},
	      open: function(){
	      		$('body').css('overflow','hidden');
		        jQuery('.ui-widget-overlay').bind('click',function(){
		            jQuery('#dialog').dialog('close');
		        });
    	  },
    	  width: 800,
    	  minHeight: 540,
    	  dialogClass: 'noTitleStuff'
	      // minWidth:($( window ).width())*0.9,
	      // minHeight: ($( window ).height())*0.9,
	      // maxHeight: ($( window ).height())*0.95
	    });
    }

	function open_promo(id,title,publish_actions)
	{
		settings_dialog();
		$("#dialog").dialog("open");
		$("#dialog").empty().load("<?php echo base_url();?>promos/ajax_load_dialog_promo/<?=$category?>/"+id+'/'+publish_actions);	
	}

	var offset = <?=$count?>;
	$(document).ready(function () {
		$.ui.dialog.prototype._focusTabbable = function(){};
		settings_dialog();
		if("<?=$aPromo['id']?>"){
			open_promo("<?=$aPromo['id']?>","<?=$aPromo['title']?>","<?=$sPublishAction;?>");
		}
		
	    $(window).scroll(function () {        	
	        if ($(window).scrollTop() == ( $(document).height() - $(window).height())) {
	            if(!$("#dialog").dialog("isOpen")){
	            	loadData();
	            }
	            
	        }
	 	});

	    function loadData() {
	    	$.ajax({
				type: "post",
				url: "<?php echo base_url();?>promos/ajax_load_scrolling/"+offset.toString()+"/<?=$category?>",
				cache: false,				
				data:'',
				success: function(response){	
						
	    			var obj = JSON.parse(response);
					try{
						var str = '';
						var items=[]; 	
						$.each(obj[0], function(i,val){	
								title = val.title.toString();
								if(i == 0){
									$('section').append("<article onclick='open_promo("+val.id+",\"" +val.title+" \")'><figure><img src='<?php echo base_url();?>public/img/promos_big/<?php echo md5("+val.id+");?>'><figcaption>"+val.title.toUpperCase()+"</figcaption><div class='left'><a href='#'>"+val.company_name.charAt(0).toUpperCase() + val.company_name.slice(1)+"</a></div><div class='icon_right'><img src='<?php echo base_url()?>public/img/time.png' alt='time'>QUEDAN "+val.remaining_days+" DÍAS</div><div class='icon_right'><img src='<?php echo base_url()?>public/img/people.png' alt='people'>"+val.number_participants+"</div></figure></article><hr />");
								}else{
									$('section').append("<article class='w50' onclick='open_promo("+val.id+",\"" +val.title+" \")'><figure><img src='<?php echo base_url();?>public/img/promos_small/<?php echo md5("+val.id+");?>'><figcaption>"+val.title.toUpperCase()+"</figcaption><div class='left'><a href='#'>"+val.company_name.charAt(0).toUpperCase() + val.company_name.slice(1)+"</a></div><div class='icon_right'><img src='<?php echo base_url()?>public/img/time.png' alt='time'>QUEDAN "+val.remaining_days+" DÍAS</div><div class='icon_right'><img src='<?php echo base_url()?>public/img/people.png' alt='people'>"+val.number_participants+"</div></figure></article>");
									if(i==1){
										$('section').append("<div class='w5'>&nbsp;</div>");
									}else if(i == 2){
										$('section').append("<hr />");
									}
								}												
							    offset = offset + 1;
						});	
					
					}catch(e) {		
						alert('Exception while request..');
					}		
				},
				error: function(){						
					alert('Error while request..');
				}
			 });
	    }
	});
</script>