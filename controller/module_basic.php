<?php
import (APP_PATH.'/controller/general.php');
class module_basic extends general
{
	//所操作的数据库对象
	var $table;
	//所操作的模块名
	var $module_name;
	
	function index(){
		echo "Enjoy, Speed of PHP!";
	}
	
	function insert(){
		$creation = array();
		$additions = array();
		$creation['user_id'] = $this->spArgs('user_id');//创建者
		$creation['name'] = $this->spArgs('name');//名称
		$creation['description'] = $this->spArgs('description');//描述
		$creation['notice'] = $this->spArgs('notice');//注意
		$creation['x'] = $this->spArgs('x');//坐标x
		$creation['y'] = $this->spArgs('y');//坐标y
		$item = $this->table->create($creation);
		if($item){
			$module_id = spClass('modules')->get_module_id($this->module_name);
			$additions['user_id'] = $_SESSION['user_info']['user_id'];
			$additions['module_id'] = $module_id;
			$additions['item'] = $item;
			$addition_id = spClass('additions')->create($additions);
			if($addition_id){
				$response = $this->success_msg();
			}else{
				$response = $this->error_msg('数据库操作失败');
			}
		}else 
			$response = $this->error_msg('数据库操作失败');
		return $response;
	}
	
	function add(){
		if($_SESSION['user_info']){
			//如果登陆的SESSION在	
			if($this->spArgs('name')){
				//添加操作
				$response = $this->insert();
			}else{
				$response = $this->error_msg('未知错误,错误号CH2');
			}
		}else{
			//SESSION不在
			if($this->spArgs('user_id')){
				//如果客户端有发送重新登陆信息
				if(spClass('users')->user_validation($this->spArgs('user_id'),$this->spArgs('username'))){
					//用户id与username合法,is_banned==0
					$_SESSION['user_info'] = array('user_id'=>$this->spArgs('user_id'),'username'=>$this->spArgs('username'));
					//添加操作
					$response = $this->insert();
				}else{
					// 不合法，返回错误,客户端应该清空登陆情况，有盗号风险
					$response = $this->error_msg('添加失败，您的帐号有异常，请重新登陆');	
				}
			}else{
				//没有SESSION，且无登陆信息，返回错误
				$response = $this->error_msg('请再次登陆');	
			}
		}
		return $response;
	}
	
	function edit(){
		
	}
}