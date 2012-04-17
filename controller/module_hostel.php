<?php
import (APP_PATH.'/controller/module_basic.php');
class module_hostel extends module_basic
{
	public function __construct(){
		parent::__construct();
		$this->table = spClass('hostels');
		$this->module_name = '旅店';
		//TO DELETE
		//dump($this->table);
		//$_SESSION['user_info'] = null;
		//TO DELETE
	}
	
	function index(){
		echo "Enjoy, Speed of PHP!";
	}
	
	function add_hostel(){
		//验证表单
		$verifier_result = spClass('hostels')->spVerifier($this->spArgs());
		if(FALSE == $verifier_result){
			//表单验证成功
			$response = $this->add();//调用basic_module方法
		}else{
			//表单验证失败，返回第一条错误信息
			$response = $this->error_msg($this->get_first_error($verifier_result));
		}
		//dump($response);
		return $response;
	}
	
	function edit(){
		
	}
	
	function android_add_hostel(){
		$response = $this->add_hostel();
		echo $this->json_response($response);
	}
}