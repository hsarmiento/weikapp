
<h1> PERFIL </h1>

<div class="container">
	<div class="promo-participate">
		<h2>Promos que participa el rey</h2>
		<ul>
			<?php
				foreach ($aUserPromosCompetitor as $user_promo) {
					$date = date('Y-m-d H:i:s', time());
					if($user_promo['promo_end_datetime'] > $date)
					{ ?>
						<li><?=$user_promo['promo_title']?>&nbsp <span class="see_more" onclick="open_promo(<?=$user_promo['promo_id']?>, '<?=$user_promo['promo_title']?>'); return false;">ver promo</span></li>
					<?php }				
				 } ?>	
		</ul>
	</div>
	<div class="promo-expired">
		<h2>Promos que participo el rey</h2>
		<ul>
			<?php
				foreach ($aUserPromosCompetitor as $user_promo) {
					if($user_promo['promo_end_datetime'] < $date)
					{ ?>
						<li><?=$user_promo['promo_title']?>&nbsp <span class="see_more" onclick="open_promo(<?=$user_promo['promo_id']?>, '<?=$user_promo['promo_title']?>'); return false;">ver promo</span></li>
					<?php }				
				 } ?>	
		</ul>
	</div>
	<div id="dialog"></div>
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

	function open_promo(id,title)
	{
		settings_dialog();
		$("#dialog").dialog("option","title", title);
		$("#dialog").dialog("open");
		$("#dialog").dialog("option","title", title);
		$("#dialog").dialog("open");
		$("#dialog").empty().load("<?php echo base_url();?>promos/ajax_load_dialog_promo/null/"+id);	
	
	}

	$(document).ready(function () {
		settings_dialog();
	});
</script>
