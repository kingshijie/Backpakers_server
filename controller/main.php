<?php
import (APP_PATH.'/controller/general.php');
class main extends general
{
	function index(){
		$this->display('index.html');
	}
	
	/**
	 * 用户登陆的基础方法，各平台的具体实现调用此方法
	 * 
	 */
	function login(){
		if($this->spArgs('username')){
			$result = spClass('users')->login($this->spArgs());
			//dump($result);
			if(FALSE === $result){
				//用户名或密码错误
				$response = $this->error_msg('用户名或密码错误');
			}else if($result['user_id']){
				//查询到结果，判断是否被禁言
				if($result['is_banned']){
					//被禁言
					$response = $this->error_msg('您已被禁言，请做遵纪守法的好公民');
				}else{
					//登陆成功
					$_SESSION['user_info'] = $result;//写入SESSION
					$response = $this->success_msg($result);
				}	
			}else{
				//用户输入错误
				$response = $this->error_msg($this->get_first_error($result));
			}
		}else{
			$response = $this->error_msg('请输入用户名');
		}
		return $response;
	}
	
	/**
	 * 登出
	 */
	public function logout()
	{
		$_SESSION['user_info'] = null;
		unset($_SESSION['user_info']);
	}
	
	/**
	 * 用户注册的基础方法，各平台的具体实现调用此方法
	 * 
	 */
	function register(){
		if($this->spArgs('username')){
			$result = spClass('users')->register($this->spArgs());
			if(TRUE === $result){
				//注册成功	
				$response = $this->success_msg();
			}else if(FALSE === $result){
				//注册失败
				$response = $this->error_msg('注册失败，请稍后再试');
			}else{
				$response = $this->error_msg($this->get_first_error($result));
			}
		}else{
			$response = $this->error_msg('请输入用户名');
		}
		return $response;
	}
	
	/**
	 * 设置用户的一些参数，包括on_travel,on_listening
	 * 
	 */
	function set_user_params(){
		if($this->spArgs('user_id')){
			
			$condition = array(spClass('users')->pk => $this->spArgs('user_id'));
			$row = array();
			
			$param = $this->spArgs('on_travel');
			if(isset($param)){
				$row['on_travel'] = $param;
			}
			
			$param = $this->spArgs('on_listening');
			if(isset($param)){
				$row['on_listening'] = $param;
			}
			
			if(spClass('users')->update($condition,$row)){
				return $this->success_msg();
			}else{
				return $this->error_msg('数据更新失败');
			}
		}else {
			return $this->error_msg('网络传输失败');
		}
	}
	
	function set_my_location(){
		$condition = array(spClass('users')->pk => $this->spArgs('user_id'));
		$row = array('my_x'=>$this->spArgs('x'),'my_y'=>$this->spArgs('y'),'device_id'=>$this->spArgs('device_id'));
		
		if(spClass('users')->update($condition,$row)){
			return $this->success_msg();
		}else{
			return $this->error_msg('数据更新失败');
		}
	}
	
	function fetch_near_user(){
		$range = $this->spArgs('range');
		$x = $this->spArgs('x');
		$y = $this->spArgs('y');
		$row = 'user_id,username,sex,my_x as x,my_y as y';
		$users = spClass('users')->near_users($x,$y,$range,$row,null,null,'user_id!='.$this->spArgs('user_id'));
		if($users){
			return $users;
		}else{
			$response = $this->error_msg('搜索结果为空');
			return $response;	
		}
	}
	
	function fetch_user_info(){
		$user_id = $this->spArgs('user_id');
		$condition = array('user_id'=>$user_id);
		$rows = 'username,credit';
		$user = spClass('users')->find($condition,null,$rows);
		$sql = 'SELECT COUNT(*) as addition_num FROM '.spClass('additions')->table.' WHERE user_id='.$user_id;
		$result = spClass('additions')->findSql($sql);
		$user['addition_num'] = $result[0]['addition_num'];
		$sql = 'SELECT COUNT(*) as report_num FROM '.spClass('reports')->table.' WHERE user_id='.$user_id;
		$result = spClass('reports')->findSql($sql);
		$user['report_num'] = $result[0]['report_num'];
		return $user;
	}

	/**
	 * Android平台的用户登陆
	 * 
	 */
	function android_login(){
		$response = $this->login();
		//dump($response);
		//返回json结果
		echo $this->json_response($response);
	}
	
	/**
	 * Android平台的用户登出
	 * 
	 */
	function android_logout(){
		$this->logout();
		echo $this->json_response($this->success_msg());
	}
	
	/**
	 * Android平台的用户注册
	 * 
	 */
	function android_register(){
		$response = $this->register();
		echo $this->json_response($response);
	}
	
	//设置user表的on_travel,on_listening参数
	function android_set_user_params(){
		$response = $this->set_user_params();
		echo $this->json_response($response);
	}
	
	//设置我的当前位置
	function android_set_my_location(){
		$response = $this->set_my_location();
		echo $this->json_response($response);
	}
	
	//获取我位置周围的用户
	function android_fetch_near_user(){
		$result = $this->fetch_near_user();
		$response['data'] = $result;
		echo $this->json_response($response);
	}
	
	//获取用户信息
	function android_fetch_user_info(){
		$result = $this->fetch_user_info();
		echo $this->json_response($result);
	}
	
	
}