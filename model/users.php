<?php
class users extends spModel
{
	var $pk = "user_id";
	var $table = "users";
	var $addrules = array(
		// 自定义验证规则的函数名可以有两种形式
		// 第一种是 '规则名称' => '验证函数名'，这是当函数是一个单纯的函数时使用
		// 第二种是‘规则名称’=> array('类名', '方法函数名')，这是当函数是一个类的某个方法函数时候使用。
		// 'checkusername' => 'checkname', //  '规则名称' => '验证函数名'
		'rule_checkusername' => array('users', 'checkusername'),  //‘规则名称’=> array('类名', '方法函数名')
		// 当然我们还可以定义更多的自定义规则
	);
	//登陆的验证规则
	var $verifier_login = array(
		"rules"=>array(
			'username'=>array(
				'notnull'=>TRUE,
				'email' => TRUE,   // 必须要是电子邮件格式
				'minlength'=>6,
				'maxlength'=>100,
			),
			'password'=>array(
				'notnull'=>TRUE,
				'minlength'=>6,
				'maxlength'=>30,	
			),		
		),	
		"messages" => array( // 提示消息，从上面的rules复制下来，很快捷。
			'username' => array(  
				'notnull' => "用户名不能为空", 
				'email' => "电子邮箱格式错误",
				'minlength' => "用户名长度不能少于6个字符",  
				'maxlength' => "用户名长度不能大于100个字符",
			),

			'password' => array(  
				'notnull' => "密码不能为空", 
				'minlength' => "密码长度不能少于6个字符",  
				'maxlength' => "密码长度不能大于30个字符", 
			),
		),
	);	
	//注册的验证规则
	var $verifier_register = array(
		"rules"=>array(
			'username'=>array(
				'notnull'=>TRUE,
				'email' => TRUE,   // 必须要是电子邮件格式
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
				'email' => "电子邮箱格式错误",
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
	
	/**
	 * 用户登陆
	 * 
	 * 
	 */
	public function login($values)
	{
		$this->verifier = $this->verifier_login; 
		//验证登陆信息
		$verifier_result = $this->spVerifier($values);
		if(FALSE === $verifier_result){
			//验证成功
			$condition = array('username'=>$values['username'],'password'=>md5($values['password']));
			$result = $this->find($condition,null,'user_id,username,is_banned');
			if(FALSE == $result){
				//登陆失败
				return FALSE;
			}else return $result;
		}else {
			//验证不成功，返回错误信息
			return $verifier_result;
		}
	}
	
		/**
	 * 注册用户
	 * 
	 * @param values    注册输入的数据
	 */
	public function register($values)
	{
		$this->verifier = $this->verifier_register; // 使用注册的验证规则
		//验证注册信息
		$verifier_result = $this->spVerifier($values);
		if( FALSE === $verifier_result ){
			// false是通过验证，然后开始写入数据
			// 本系统登录时需要用到spAcl加密密码框，所以密码还要MD5一下。
			$values["password"] = md5($values["password"]);
			$uid = $this->create($values);
			if($uid <= 0) { // 没有返回用户ID，注册不成功
				return FALSE;
			}else{
				return TRUE;
			}
		}else{
			// true不能通过验证，这里直接返回给控制器处理
			return $verifier_result;
		}
	}

	
	/** 
	 * 增加的验证器，检查用户名是否存在
	 * @param val    待验证字符串
	 * @param right    正确值
	 */
	public function checkusername($val, $right) // 注意，这里的$right就是TRUE
	{
		if($this->find(array('username'=>$val))){ 
			return FALSE; 
		}else{
			return TRUE; 
		}
	}
	
	public function user_validation($user_id,$username)
	{
		if($this->find(array('user_id'=>$user_id,'username'=>$username,'is_banned'=>0))){
			return TRUE;	
		}else{
			return FALSE;	
		}
	}
}