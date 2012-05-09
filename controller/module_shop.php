<?php
import (APP_PATH.'/controller/module_basic.php');
class module_shop extends module_basic
{
	public function __construct(){
		parent::__construct();
		$this->table = spClass('shops');
		$this->module_name = '购物点';
	}
	
	function index(){
		echo "";
	}
	
	function edit(){
		
	}
}