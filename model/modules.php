<?php
class modules extends spModel
{
	var $pk = "module_id";
	var $table = "modules";	
	
	function get_module_id($name){
		$condition = array('name'=>$name);
		$result = $this->find($condition);
		return $result['module_id'];
	}
}