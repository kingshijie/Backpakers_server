<?php
import (APP_PATH.'/controller/module_basic.php');
class module_hostel extends module_basic
{
	public function __construct(){
		parent::__construct();
		$this->table = spClass('hostels');
		$this->module_name = '旅店';
	}
	
	function index(){
		echo "";
	}
	
	function edit(){
		
	}
}