<?php
import (APP_PATH.'/controller/module_basic.php');
class module_camping extends module_basic
{
	public function __construct(){
		parent::__construct();
		$this->table = spClass('campings');
		$this->module_name = '露营点';
	}
	
	function index(){
		echo "";
	}
	
	function edit(){
		
	}
}