<?php
	$count = count($aData);
?>


<style>



.header{
	width: 80%;
	margin-left: 10%;
	margin-right: 10%;
	border: green solid 1px;
	margin-bottom: 50px;
}

.container{
	width: 80%;
	margin-left: 10%;
	margin-right: 10%;
	border: blue 1px solid;
	height: auto;
	padding-bottom: 45px;
	/*padding-left: 100px;*/
}

.box-promos{
	width: 80%;
	height: auto;
	margin-right: 10%;
	margin-left: 10%;
	margin-top: 20px;
	border: green 1px solid;
	margin-bottom: 20px;
}

.promo{
	width: 350px;
	height: 250px;
	margin-left: 100px;
	margin-right: 20px;
	margin-top: 45px;
	border: 1px solid red;
	display: inline-block;
	cursor: pointer;
}


</style>

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
						<img src="<?php echo base_url();?>public/img/piscola.jpg" width="320" height="225">
					</div>
			<?php } 

		} ?>	
</div>


<script>

    $(".promo").hover(function() {
        $(this).animate({
            opacity: 0.5
        });
    }, function() {
        $(this).stop(true, true).animate({
            opacity: 1
        });
    });

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
	      minWidth:($( window ).width())*0.9,
	      minHeight: ($( window ).height())*0.9
	    });
    }

	$(function() {
	    settings_dialog();
	});
 
	function open_promo(id,title)
	{
		settings_dialog();
		$("#dialog").dialog("option","title", title);
		$("#dialog").dialog("open");
		$("#dialog").empty().load("<?php echo base_url();?>promos/ajax_load_dialog_promo/"+id);	
	}

	var offset = <?=$count?>;
	$(document).ready(function () {
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
	    	$(".promo").hover(function() {
		        $(this).animate({
		            opacity: 0.5
		        });
		    }, function() {
		        $(this).stop(true, true).animate({
		            opacity: 1
		        });
		    });
	    }
	});
</script>