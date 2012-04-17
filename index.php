<?php
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
require(APP_PATH.'/config.php');
require(SP_PATH."/SpeedPHP.php");
spRun();