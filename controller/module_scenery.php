<?php
import (APP_PATH.'/controller/module_basic.php');
class module_scenery extends module_basic
{
	public function __construct(){
		parent::__construct();
		$this->table = spClass('sceneries');
		$this->module_name = '旅游点';
	}
	
	function index(){
		echo "";
	}
	
	function edit(){
		
	}
}