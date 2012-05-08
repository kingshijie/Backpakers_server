<?php
class modulesModle extends spModel
{
	var $linker = array(
		array(
			'type'=>'hasone',
			'map'=>'user',
			'mapkey'=>'user_id',
			'fclass'=>'users',
			'fkey'=>'user_id',
			'enabled'=>TRUE
		),	
	);
}
?>
