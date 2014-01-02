<?php
	$count = count($aData);
?>


<style>
p{margin: 10px;
	padding: 5px;}
#finalResult{
	list-style-type: none;
	margin: 10px;
	padding: 5px;
	width:300px;
}
</style>

<h1>SE VE?</h1>



<ul>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>
	<?php foreach ($aData as $value) { ?>
		<li><?=$value['name']?></li>
	<?php } ?>

<h3>hasta aqui llega</h3>
</ul>
<ul id="finalResult">
</ul>


<script>
	var offset = <?=$count+1?>;
	$(document).ready(function () {
	    $(window).scroll(function () {        	
	        if ($(window).scrollTop() == ( $(document).height() - $(window).height())) {
	            loadData();
	        }
	 	});

	    function loadData() {
	    	
	    	$.ajax({
				type: "post",
				url: "<?php echo base_url();?>categories/ajax_load/"+offset.toString(),
				cache: false,				
				data:'',
				success: function(response){	
					offset = offset + 1;	
	    			var obj = JSON.parse(response);
					try{
						var str = '';
						var items=[]; 	
						$.each(obj[0], function(i,val){														
							    items.push($('<li/>').text(val.name));
						});	
						if(offset%2==0){
							color = 'green';
						}else{
							color = 'yellow';
						}
						$('#finalResult').append("<div id='div"+offset+"' style='background-color:"+color+";'></div>");
						
						$('#div'+offset).show('slow',function(){
							$(this).append.apply($('#div'+offset), items);
						});
						// $('#finalResult').fadeOut('slow', function() {
						// 	$('#finalResult').append(str).fadeIn('slow').fadeIn(3000);
						// 	$('#finalResult').css({backgroundColor: ''});
						// 	$('#finalResult').append.apply($('#finalResult'), items);
						// }).css({backgroundColor: '#D4ED91'});							
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