<?php
/**
检查登陆情况
**/
import (APP_PATH.'/controller/general.php');
class admin extends general
{
	//所调用的模块
	var $module;
	//所需权限
	var $needed_abilities;
	//数据操作的条件
	//var condition;
	//数据操作的列
	//var row; 
	
	//var $err_msg;
	
	function __construct(){
		parent::__construct();
		$this->err_msg = $this->spArgs('err_msg');
		//检查是否登陆
		if(!$_SESSION['admin_info']){
			$this->login();
			$result = spClass('groups')->get_abilities($_SESSION['admin_info']['group_id']);
			foreach($result as $item){
				$tmp[$item['description']] = 1;
			}
			$_SESSION['abilities'] = $tmp;
		}
	}
	
	/*function _have_ability($params){
		$abilities = $params['abilities'];
		$ability = $params['ability'];
		return spClass('abilities')->have_ability($abilities,$ability);
	}*/
	
	/**
	 * 用户登陆
	 * 
	 */
	function login(){
		if($this->spArgs('username')){
			$result = spClass('admins')->login($this->spArgs());
			//dump($result);
			if(FALSE === $result){
				//用户名或密码错误
				$this->error('用户名或密码错误','login.html');
				exit;
			}else if($result['admin_id']){
				//登陆成功
				$_SESSION['admin_info'] = $result;//写入SESSION
			}else{
				//用户输入错误
				$this->error($this->get_first_error($result),'login.html');
				exit;
			}
		}else{
			$this->display('login.html');
			exit;
		}
	}
	
	function logout(){
		$_SESSION['admin_info'] = null;
		unset($_SESSION['user_info']);
		$this->jump('index.php');
	}
	
	function index(){
		$this->display('admin/index.html');
	}
	
	function show_add(){
		$this->op = 'add';
		$this->display('admin/'.$this->module.'.html');	
	}
	
	function do_add(){return;}
	
	function show_edit(){
		$this->op = 'edit';	
		$this->display('admin/'.$this->module.'.html');
	}
	
	function do_edit(){return;}
	
	function del(){return;}
	
	function check_ability($abilities){
		if(is_array($abilities)){
			$ok = 0;
			foreach($abilities as $item){
				if($_SESSION['abilities'][$item]){
					$ok = 1;	
					break;
				}
			}
			if(!$ok){
				$this->error('您无权限访问该页面','index.php');	
				exit;
			}
		}else{
			if(!$_SESSION['abilities'][$abilities]){
				$this->error('您无权限访问该页面','index.php');	
				exit;
			}
		}
	}
	
}