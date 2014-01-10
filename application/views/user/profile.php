
<h1> PERFIL </h1>

<div class="container">
	<div class="promo-participate">
		<h2>Promos que participata el rey</h2>
		<ul>
			<?php
				foreach ($aUserPromosCompetitor as $user_promo) {
					if($user_promo['promo_end_datetime'] < $date = date('Y/m/d H:i:s', time()))
					{ ?>
						<li><?=$user_promo['promo_title']?>&nbsp <a href="#">ver promo</a></li>
					<?php }				
				 } ?>	
		</ul>
	</div>
	<div class="promo-expired">
		<h2>Promos que participo el rey</h2>
		<ul>
			<?php
				foreach ($aUserPromosCompetitor as $user_promo) {
					if($user_promo['promo_end_datetime'] > $date = date('Y/m/d H:i:s', time()))
					{ ?>
						<li><?=$user_promo['promo_title']?>&nbsp <a href="#">ver promo</a></li>
					<?php }				
				 } ?>	
		</ul>
	</div>

</div>