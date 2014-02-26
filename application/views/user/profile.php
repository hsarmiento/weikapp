<?php
	$date = date('Y-m-d H:i:s', time());
?>
<div class="container">
	<section>
		<div class="promo_title">
			+ Mis promociones.				
		</div>

		<hr />
		<article>
				<div class="promoleft">
					<div class="ftitle">
						Estás participando							
					</div>
					<?php
						$i = 0;
						foreach ($aUserPromosCompetitor as $user_promo) { 
							if($user_promo['promo_end_datetime'] > $date) { 
								if($i%2==0){ ?>
									<div class="text_a">
										<a href="#" onclick="open_promo(<?=$user_promo['promo_id']?>, '<?=$user_promo['promo_title']?>',null); return false;">* <?=$user_promo['promo_title']?></a>
									</div>
								<?php }else{ ?>
									<div class="text_b">
										<a href="#" onclick="open_promo(<?=$user_promo['promo_id']?>, '<?=$user_promo['promo_title']?>',null); return false;">* <?=$user_promo['promo_title']?></a>
									</div>
								<?php } 
							 	$i = $i + 1;
							 	if($i >= 5){
							 		break;
							 	}
							 } ?>

					<?php } ?>
					<div class="btn_box">
					<a href="#" class="fbtn">Ver más</a>
					</div>				
				</div>
				<div class="promoright">
					<div class="ftitle">
						Ya participaste
					</div>
					<?php
						$i = 0;
						foreach ($aUserPromosCompetitor as $user_promo) { 
							if($user_promo['promo_end_datetime'] < $date) { 
								if($i%2==0){ ?>
									<div class="text_a">
										<a href="#" onclick="open_promo(<?=$user_promo['promo_id']?>, '<?=$user_promo['promo_title']?>',null); return false;">* <?=$user_promo['promo_title']?></a>
									</div>
								<?php }else{ ?>
									<div class="text_b">
										<a href="#" onclick="open_promo(<?=$user_promo['promo_id']?>, '<?=$user_promo['promo_title']?>',null); return false;">* <?=$user_promo['promo_title']?></a>
									</div>
								<?php } 
							 	$i = $i + 1;
							 	if($i >= 5){
							 		break;
							 	}
							 } ?>

					<?php } ?>
					<div class="btn_box">
					<a href="#" class="fbtn">Ver mas</a>
					</div>
				</div>
		</article>
		<hr />
	</section>
</div>
<div id="dialog"></div>


<script>
	$(document).ready(function () {
		settings_dialog();
	});

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

	    $(".ui-dialog").attr("id","dialog_promo");
    }

	function open_promo(id,title,publish_actions)
	{
		console.log("rey");
		settings_dialog();
		$("#dialog").dialog("open");
		$("#dialog").empty().load("<?php echo base_url();?>promos/ajax_load_dialog_promo/null/"+id+'/'+publish_actions);	
	}

</script>