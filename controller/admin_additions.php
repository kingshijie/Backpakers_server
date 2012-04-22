<?php
import (APP_PATH.'/controller/admin.php');
class admin_additions extends admin
{
	function __construct(){
		parent::__construct();
		//检查权限
		$this->needed_abilities[] = '审核新增的旅店';
		$this->needed_abilities[] = '审核新增的旅游点';
		$this->needed_abilities[] = '审核新增的露营点';
		$this->check_ability($this->needed_abilities);
		//有问题
		$this->selected = $this->spArgs('selected')?$this->spArgs('selected'):'旅店';
		//检查有无上次未批完的审核	
	}
	
	function index(){
		$this->display('admin/additions.html');
	}	
	
	/**
	取出下一条审核内容
	**/
	function next(){
		//如果有更新请求
		if($this->spArgs('approve')){
			if(!($this->do_permission())){
				$this->err_msg = '审核提交失败';	
			}
		}
		$this->op = 'show';
		$module_name = $this->spArgs('module_name');
		//获取module信息
		$module_id = spClass('modules')->get_module_id($module_name);
		//获取addition信息，并更新is_checking
		$condition = array('module_id'=>$module_id,'is_approve'=>0,'is_checking'=>0);
		$class = spClass('additions');
		;
		if($addition = $class->find($condition)){
			//更新is_checking,更新审核员
			$row = array('admin_id'=>$_SESSION['admin_info']['admin_id'],'is_checking'=>1);
			$condition = array('addition_id'=>$addition['addition_id']);
			$class->update($condition,$row);
			//根据module名称分别选定表
			$tbl_name = spClass('modules')->get_module_table_name_by_name($module_name);
			//注册additions信息
			$this->addition_id = $addition['addition_id'];
			//注册待审察内容
			$class = spClass($tbl_name);
			$condition = array($class->pk=>$addition['item']);
			$result = $class->find($condition);
			$result['item'] = $result[$class->pk];
			$this->item = $result;
			//注册用户信息
			$class = spClass('users');
			$condition = array('user_id'=>$addition['user_id']);
			$fields = 'user_id,username';
			$this->user = $class->find($condition,'',$fields);
		}else {
			$this->empty = 1;
		}
		$this->display('admin/additions.html');
	}
	
	function do_permission(){
		if($this->spArgs('approve') == '通过'){
			//addition表is_approve=1,相应数据表is_approve=1
			if($this->update_state(1)){
				return TRUE;
			}else{
				return FALSE;	
			}
		}else if($this->spArgs('approve') == '不通过'){
			//addition表is_approve=2,相应数据表is_approve=2
			if($this->update_state(2)){
				return TRUE;
			}else{
				return FALSE;	
			}
		}else{
			if($this->update_state(3)){
				return TRUE;
			}else{
				return FALSE;	
			}	
		}
	}
	
	/**
		更新审察状态
		state
		0-未审察
		1-通过
		2-不通过
		3-未确定
	**/
	function update_state($state){
		$condition = array('addition_id'=>$this->spArgs('addition_id'));
		$row = array('is_approve'=>$state);
		$tbl_name = spClass('modules')->get_module_table_name_by_name($this->spArgs('module_name'));
		if(spClass('additions')->update($condition,$row)){
			$class = spClass($tbl_name);
			$condition = array($class->pk=>$this->spArgs('item'));
			if($class->update($condition,$row)){
				return TRUE;	
			}else{
				return FALSE;	
			}
		}else{
			return FALSE;	
		}	
	}
}
?>