<?php
import (APP_PATH.'/controller/admin.php');
class admin_admins extends admin
{
	function __construct(){
		parent::__construct();
		$this->module = "admins";	
	}
	
	function index(){
		$this->op = 'index';	
		$this->list = spClass('admins')->spLinker()->findAll();
		$this->display('admin/admins.html');
	}
	
	function show_add(){
		$this->groups = spClass('groups')->findAll();
		parent::show_add();	
	}
	
	function do_add(){
		$tbl = spClass('admins');
		//dump($this->spArgs());
		$result = $tbl->is_validate('add',$this->spArgs());
		//dump($result);
		if(FALSE == $result){
			//表单验证成功
			$row = array(
				'username'=>$this->spArgs('username'),
				'password'=>md5($this->spArgs('password')),
				'group_id'=>$this->spArgs('group_id')
			);
			if(spClass('admins')->create($row)){
				//添加成功	
				$this->jump(spUrl('admin_admins'));
			}else{
				//添加失败	
				$this->jump(spUrl('admin_admins','show_add',array('err_msg'=>'添加管理员失败')));
			}
		}else{
			$err = $this->get_first_error($result);
			$this->jump(spUrl('admin_admins','',array('err_msg'=>$err)));
		}
	}
	
	function show_edit(){
		$this->groups = spClass('groups')->findAll();
		$condition = array('admin_id'=>$this->spArgs('admin_id'));
		$this->admin = spClass('admins')->find($condition);
		parent::show_edit();
	}
	
	function do_edit(){
		//表单验证成功 
		$condition = array('admin_id'=>$this->spArgs('admin_id'));
		$pwd = trim($this->spArgs('password'));
		$admin = spClass('admins');
		if('' == $pwd){
			$row['group_id'] = $this->spArgs('group_id');
			if(!($admin->update($condition,$row))){
				//修改失败	
				$this->jump(spUrl('admin_admins','',array('err_msg'=>'修改失败')));
			}
		}else{
			$result = $admin->is_validate('edit',$this->spArgs());
			if(FALSE == $result){
				$row['group_id'] = $this->spArgs('group_id');
				if(!($admin->update($condition,$row))){
					//修改失败	
					$this->jump(spUrl('admin_admins','',array('err_msg'=>'修改失败')));
				}
			}else{
				$err = $this->get_first_error($result);
				$this->jump(spUrl('admin_admins','',array('err_msg'=>$err)));
			}
		}
		$this->jump(spUrl('admin_admins'));
	}
	
	function del(){
		if(!(spClass('admins')->deleteByPk($this->spArgs('admin_id')))){
			$this->jump(spUrl('admin_admins','',array('err_msg'=>'删除失败')));
		}
		$this->jump(spUrl('admin_admins'));
	}
	
}
?>