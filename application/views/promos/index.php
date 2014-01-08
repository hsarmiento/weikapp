<?php
	$count = count($aData);
	if(count($aPromo) == 0){
		$aPromo = null;
	}
?>

<div class="header">
	<h2>Categorias</h2>
	<?php
		foreach ($aCategories as $value) { ?>
			<p><a href="<?php echo base_url();?>promos/index/<?=$value['name']?>"><?=ucfirst($value['name'])?></a></p>
		<?php } ?>
</div>

<h1>HOME PROMOS</h1>

<div id="dialog" title="Basic dialog">
  <p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
 
<div class="container" id="container-promos">
		<?php if($count == 0){ ?>
			<h3>No existen promociones para esta categoría</h3>
		<?php }else{
				foreach ($aData as $value) { ?>
					<div class="promo" onclick="open_promo(<?=$value['id']?>, '<?=$value['title']?>'); return false;">
						<?=$value['title']?>
						<img src="<?php echo base_url();?>public/img/piscola.jpg" width="320" height="225" alt="foto_promo">
					</div>
			<?php } 

		} ?>	
</div>


<script>

    function settings_dialog()
    {
    	$( "#dialog" ).dialog({
	      modal:true,
	      autoOpen: false,
	      show: {
	        effect: "blind",
	        duration: 300
	      },
	      hide: {
	        effect: "explode",
	        duration: 300
	      },
	      open: function(){
		        jQuery('.ui-widget-overlay').bind('click',function(){
		            jQuery('#dialog').dialog('close');
		        })
    	  },
	      minWidth:($( window ).width())*0.9,
	      minHeight: ($( window ).height())*0.9
	    });
    }

	function open_promo(id,title)
	{
		settings_dialog();
		$("#dialog").dialog("option","title", title);
		$("#dialog").dialog("open");
		$("#dialog").empty().load("<?php echo base_url();?>promos/ajax_load_dialog_promo/<?=$category?>/"+id);	
	}

	var offset = <?=$count?>;
	$(document).ready(function () {
		settings_dialog();
		if("<?=$aPromo['id']?>"){
			open_promo("<?=$aPromo['id']?>","<?=$aPromo['title']?>")
		}
		
	    $(window).scroll(function () {        	
	        if ($(window).scrollTop() == ( $(document).height() - $(window).height())) {
	            loadData();
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