<?php
	$count = count($aData);
	// echo $count;
	// print_r($aData);	
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
	/*float:left;*/
	display: inline-block;
	/*display: inline;*/
}

</style>

<h1>HOME PROMOS</h1>


<div class="container" id="container-promos">
		<?php foreach ($aData as $value) { ?>
				<div class="promo">
					<?=$value['title']?>
					<img src="<?php echo base_url();?>public/img/piscola.jpg" width="320" height="225">
				</div>
		<?php } ?>
		
</div>


<script>
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
				url: "<?php echo base_url();?>promos/ajax_load/"+offset.toString(),
				cache: false,				
				data:'',
				success: function(response){	
						
	    			var obj = JSON.parse(response);
					try{
						var str = '';
						var items=[]; 	
						$.each(obj[0], function(i,val){													
								$('#container-promos').append("<div class='promo'>"+val.title+"<img src='<?php echo base_url();?>public/img/piscola.jpg' width='320' height='225'></div>");	
							    // items.push($('<li/>').text(val.title));
							    offset = offset + 1;
						});	
						
						console.log(items);
						// if(offset%2==0){
						// 	color = 'green';
						// }else{
						// 	color = 'yellow';
						// }
						// $('#finalResult').append("<div id='div"+offset+"' style='background-color:"+color+";'></div>");
						
						// $('#div'+offset).show('slow',function(){
						// 	$(this).append.apply($('#div'+offset), items);
						// });
						// $('#finalResult').fadeOut('slow', function() {
						// 	$('#finalResult').append(str).fadeIn('slow').fadeIn(3000);
						// 	$('#finalResult').css({backgroundColor: ''});
							// $('#finalResult').append.apply($('#finalResult'), items);
						// }).css({backgroundColor: '#D4ED91'});		
						// $('#container-promos').append("<div class='promo><img src='' width='320' height='225'></div>");
						// $('#container-promos').append.apply($('#container-promos'), items);
					
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