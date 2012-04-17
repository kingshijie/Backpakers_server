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
	
	
}