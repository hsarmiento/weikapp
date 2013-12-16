<?php

if($fb_profile != null)
{
	echo '<h1>Bienvenido '.$user.'</h1>';
	echo '<a href="'.$logout_url.'">Logout</a>';
}
else
{
	echo '<h1>Logeate ctm</h1>';
	echo '<a href="'.$login_url.'">Login with facebook</a>';
}
?>