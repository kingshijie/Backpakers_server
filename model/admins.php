<?php
class admins extends spModel
{
	var $pk = "admin_id";
	var $table = "admins";	
	var $linker = array(
		array(
			'type'=>'hasone',
			'map'=>'group',
			'mapkey'=>'group_id',
			'fclass'=>'groups',
			'fkey'=>'group_id',
			'enabled'=>TRUE
		),		
	);
	var $addrules = array(
		// 自定义验证规则的函数名可以有两种形式
		// 第一种是 '规则名称' => '验证函数名'，这是当函数是一个单纯的函数时使用
		// 第二种是‘规则名称’=> array('类名', '方法函数名')，这是当函数是一个类的某个方法函数时候使用。
		// 'checkusername' => 'checkname', //  '规则名称' => '验证函数名'
		'rule_checkusername' => array('admins', 'checkusername'),  //‘规则名称’=> array('类名', '方法函数名')
		// 当然我们还可以定义更多的自定义规则
	);
	//注册的验证规则
	var $verifier_add = array(
		"rules"=>array(
			'username'=>array(
				'notnull'=>TRUE,
				'minlength'=>6,
				'maxlength'=>100,
				'rule_checkusername' => TRUE, // 用rule_checkemail规则验证电子邮件			
			),
			'password'=>array(
				'notnull'=>TRUE,
				'minlength'=>6,
				'maxlength'=>30,	
			),		
			'confirm_password'=>array(
				'equalto'=>'password',		
			),
		),	
		"messages" => array( // 提示消息，从上面的rules复制下来，很快捷。
			'username' => array(  
				'notnull' => "用户名不能为空", 
				'minlength' => "用户名长度不能少于6个字符",  
				'maxlength' => "用户名长度不能大于100个字符",
				'rule_checkusername' => "用户名已存在", 
			),

			'password' => array(  
				'notnull' => "密码不能为空", 
				'minlength' => "密码长度不能少于6个字符",  
				'maxlength' => "密码长度不能大于30个字符", 
			),
			'confirm_password'=>array(
				'equalto'=> "两次密码输入不匹配",		
			),
		),
	);
	
	var $verifier_edit = array(
		"rules"=>array(
			'password'=>array(
				'notnull'=>TRUE,
				'minlength'=>6,
				'maxlength'=>30,	
			),		
			'confirm_password'=>array(
				'equalto'=>'password',		
			),
		),	
		"messages" => array( // 提示消息，从上面的rules复制下来，很快捷。

			'password' => array(  
				'notnull' => "密码不能为空", 
				'minlength' => "密码长度不能少于6个字符",  
				'maxlength' => "密码长度不能大于30个字符", 
			),
			'confirm_password'=>array(
				'equalto'=> "两次密码输入不匹配",		
			),
		),
	);
	
	public function checkusername($val, $right) // 注意，这里的$right就是TRUE
	{
		if($this->find(array('username'=>$val))){ 
			return FALSE; 
		}else{
			return TRUE; 
		}
	}
	function is_validate($ac,$value){
		$action = 'verifier_'.$ac;
		$this->verifier = $this->$action;
		return $this->spVerifier($value);
	}
}