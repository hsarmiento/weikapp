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
			<?php foreach ($aData as $value) { ?>
				<article onclick="open_promo(<?=$value['id']?>, '<?=$value['title']?>', '<?=$sPublishAction?>'); return false;">
					<figure>
						<img src="<?php echo base_url();?>public/img/piscola.jpg" alt="foto_promo">
						<figcaption>
							<?=$value['title']?>	
						</figcaption>
						<div class="left">
							<a href="#"><?=$value['company_name']?></a>
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
				<?php } ?>
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
	      minWidth:($( window ).width())*0.9,
	      minHeight: ($( window ).height())*0.9,
	      maxHeight: ($( window ).height())*0.95
	    });
    }

	function open_promo(id,title,publish_actions)
	{
		settings_dialog();
		$("#dialog").dialog("option","title", title);
		$("#dialog").dialog("open");
		$("#dialog").empty().load("<?php echo base_url();?>promos/ajax_load_dialog_promo/<?=$category?>/"+id+'/'+publish_actions);	
	}

	var offset = <?=$count?>;
	$(document).ready(function () {
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
								$('#container-promos').append("<div class='promo' onclick='open_promo("+val.id+",\"" +val.title+" \")'>"+val.title+"<img src='<?php echo base_url();?>public/img/piscola.jpg' width='320' height='225'></div>");	
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