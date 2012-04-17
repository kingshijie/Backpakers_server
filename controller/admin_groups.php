<?php
import (APP_PATH.'/controller/admin.php');
class admin_groups extends admin
{
	function __construct(){
		parent::__construct();
		$this->module = "groups";	
		spAddViewFunction('is_checked',array('admin_groups','_is_checked'));
	}
		
	function index(){
		$this->op = 'index';
		$this->list = spClass('groups')->spLinker()->findAll();
		//dump($this->group_list);
		$this->display('admin/groups.html');
	}
	
	function show_list(){
		$this->index();
	}
	
	function show_add(){
		$this->abilities = spClass('abilities')->findAll();
		parent::show_add();
	}
	
	function do_add(){
		$groups = spClass('groups');
		$result = $groups->spVerifier($this->spArgs());
		if(FALSE == $result && count($this->spArgs('abilities'))){
			$row = array('name'=>$this->spArgs('name'));
			if($group_id = $groups->create($row)){
				//添加组成功	
				$tbl = spClass('group_ability');
				$ok = 1;
				foreach($this->spArgs('abilities') as $ability){
					$row = array('group_id'=>$group_id,'ability_id'=>$ability);
					if(!$tbl->create($row)) $ok = 0;
				}
				if(!$ok){
					$this->jump(spUrl('admin_groups','',array('err_msg'=>'用户组添加异常')));
				}
				$this->jump(spUrl('admin_groups'));
			}else{
				//添加失败	
				$this->jump(spUrl('admin_groups','show_add',array('err_msg'=>'添加失败')));
			}
		}else{
			if($result){
				//表单验证失败
				$err = $this->get_first_error($result);
				$this->jump(spUrl('admin_groups','',array('err_msg'=>$err)));	
			}else{
				//权限选择为空
				$this->jump(spUrl('admin_groups','',array('err_msg'=>'您未选择权限')));	
			}
		}
	}
	
	function show_edit(){
		$condition = array('group_id'=>$this->spArgs('group_id'));
		$this->group = spClass('groups')->spLinker()->find($condition);
		//dump($this->group);
		$this->abilities = spClass('abilities')->findAll();
		parent::show_edit();
	}
	
	function do_edit(){
		$groups = spClass('groups');
		$result = $groups->spVerifier($this->spArgs());
		if(FALSE == $result && count($this->spArgs('abilities'))){
			$group_id = $this->spArgs('group_id');
			$row = array('name'=>$this->spArgs('name'));
			$condition = array('group_id'=>$group_id);
			if(spClass('groups')->update($condition,$row)){
				//修改成功	
				$tbl = spClass('group_ability');
				//删除旧的权限
				$ok = $tbl->deleteByPk($group_id);
				//添加新权限
				foreach($this->spArgs('abilities') as $ability){
					$row = array('group_id'=>$group_id,'ability_id'=>$ability);
					if(!$tbl->create($row)) $ok = FALSE;
				}
				if(!$ok){
					$this->jump(spUrl('admin_groups','',array('err_msg'=>'用户组编辑异常')));
				}
				$this->jump(spUrl('admin_groups'));
			}else{
				$this->jump(spUrl('admin_groups','',array('err_msg'=>'编辑用户组失败')));
			}
		}else{
			if($result){
				//表单验证失败
				$err = $this->get_first_error($result);
				$this->jump(spUrl('admin_groups','',array('err_msg'=>$err)));	
			}else{
				//权限选择为空
				$this->jump(spUrl('admin_groups','',array('err_msg'=>'您至少要选一个权限')));	
			}
		}
	}
	
	function del(){
		$group_id = $this->spArgs('group_id');
		$ok1 = spClass('group_ability')->deleteByPk($group_id);
		$ok2 = spClass('groups')->deleteByPk($group_id);
		if(!($ok1 && $ok2)){
			$this->jump(spUrl('admin_groups','',array('err_msg'=>'删除失败')));
		}
		$this->jump(spUrl('admin_groups'));
	}
	
	/**
		SMARTY注册函数，判断用户组是否有该权限
	**/
	function _is_checked($param){
		$abs = $param['abilities'];
		$ab = $param['ability'];
		foreach($abs as $item){
			if($item['ability_id'] == $ab)
				return 'checked="checked"';
		}
	}
}