<?php
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
$spConfig = array(
	"db"=>array(
		'host'=>'localhost',
		'login'=>'root',
		'password'=>'1111',
		'database'=>'backpackers',	
	),
);
require(SP_PATH."/SpeedPHP.php");
spRun();