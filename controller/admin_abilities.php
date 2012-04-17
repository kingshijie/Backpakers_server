<?php
import (APP_PATH.'/controller/admin.php');
class admin_abilities extends admin
{
	function __construct(){
		parent::__construct();
		$this->module = "abilities";	
	}
	
	function index(){
		$this->op = 'index';	
		$this->list = spClass('abilities')->findAll();
		$this->display('admin/abilities.html');
	}
	
	function show_add(){
		parent::show_add();	
	}
	
	function do_add(){
		$tbl = spClass('abilities');
		//验证
		$result = $tbl->spVerifier($this->spArgs());
		if(FALSE == $result){
			$row = array('description'=>$this->spArgs('description'));
			if($tbl->create($row)){
				//添加成功	
				$this->jump(spUrl('admin_abilities'));
			}else{
				//添加失败	
				$this->jump(spUrl('admin_abilities','show_add',array('err_msg'=>'添加失败')));
			}
		}else{
			$err = $this->get_first_error($result);
			$this->jump(spUrl('admin_abilities','',array('err_msg'=>$err)));
		}
	}
	
	function show_edit(){
		$condition = array('ability_id'=>$this->spArgs('ability_id'));
		$this->ability = spClass('abilities')->find($condition);
		parent::show_edit();
	}
	
	function do_edit(){
		$tbl = spClass('abilities');
		//验证
		$result = $tbl->spVerifier($this->spArgs());
		if(FALSE == $result){
			$condition = array('ability_id'=>$this->spArgs('ability_id'));
			$row = array('description'=>$this->spArgs('description'));
			if(!(spClass('abilities')->update($condition,$row))){
				//修改失败	
				$this->jump(spUrl('admin_abilities','',array('err_msg'=>'修改失败')));
			}
			$this->jump(spUrl('admin_abilities'));
		}else{
			$err = $this->get_first_error($result);
			$this->jump(spUrl('admin_abilities','',array('err_msg'=>$err)));
		}
	}
	
	function del(){
		if(!(spClass('abilities')->deleteByPk($this->spArgs('ability_id')))){
			$this->jump(spUrl('admin_abilities','',array('err_msg'=>'删除失败')));
		}
		$this->jump(spUrl('admin_abilities'));
	}
}
?>