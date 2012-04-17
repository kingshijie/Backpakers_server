<?php
import (APP_PATH.'/controller/admin.php');
class admin_abilities extends admin
{
	function index(){
		$this->op = 'index';	
		$this->ability_list = spClass('abilities')->findAll();
		$this->display('admin/abilities.html');
	}
	
	function add_ability_show(){
		$this->op = 'add';
		$this->display('admin/abilities.html');	
	}
	
	function add_ability_do(){
		$des = array('description'=>$this->spArgs('description'));
		if(spClass('abilities')->create($des)){
			//添加成功	
			$this->jump(spUrl('admin_abilities'));
		}else{
			//添加失败	
			$this->jump(spUrl('admin_abilities','add_ability_show'));
		}
	}
	
	function edit_ability_show(){
		$this->op = 'edit';	
		$condition = array('ability_id'=>$this->spArgs('ability_id'));
		$this->ability = spClass('abilities')->find($condition);
		$this->display('admin/abilities.html');
	}
	
	function edit_ability_do(){
		$condition = array('ability_id'=>$this->spArgs('ability_id'));
		$row = array('description'=>$this->spArgs('description'));
		if(!(spClass('abilities')->update($condition,$row))){
			//修改失败	
			$this->err_msg = '修改失败';
		}
		$this->jump(spUrl('admin_abilities'));
	}
	
	function del_ability(){
		if(!(spClass('abilities')->deleteByPk($this->spArgs('ability_id')))){
			$this->err_msg = '删除失败';
		}
		$this->jump(spUrl('admin_abilities'));
	}
}
?>