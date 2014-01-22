<style type="text/css">
	.award_container{
		width: 80%;
		border:1px solid red;
		margin-left: 10%;
		margin-right: 10%;
	}

	.award-container h1{
		text-align: center;
	}

	.wrap-agree{
		width: 80%;
		border:1px solid green;
		margin-left: 10%;
		margin-right: 10%;
		text-align: center;
	}

	.form-agree{
		width: 80%;
		border:1px solid blue;
		margin-left: 10%;
		margin-right: 10%;
		text-align: center;
	}

</style>

<div class="award-container">
	<h1>Aceptar premio</h1>
	<div class="wrap-agree">
		El rey <?=$aUserWinner['names'].' '.$aUserWinner['last_name']?> ha ganado la promoción
		<?=$aUserWinner['promo_title']?>
		<div class="form-agree">
		<?php
			// echo form_open('http://sandbox1.backfront.cl/weikapp/winners/congrats');
			echo form_open('winners/congrats');
				echo form_hidden('winner_id', $aUserWinner['winner_id']);
				echo form_hidden('user_fbuid', $aUserWinner['fb_uid']);
				echo form_hidden('promo_id', $aUserWinner['promo_id']);
				echo form_submit('agree','Aceptar');
			echo form_close();
		?>
		</div>
	</div>
	
	
</div>



