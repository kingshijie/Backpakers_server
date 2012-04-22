<?php

/**
 * 全部控制器页面的父类
 * 
 * 实现一些全局的页面显示
 */
class general extends spController
{
	
	/**
	 * 站点配置
	 */
	var $defined = "";
	
	/**
	 * 当前页面title
	 */
	var $title = "";
	
	
	/**
	 * 覆盖控制器构造函数，进行相关的赋值操作
	 */
	public function __construct()
	{
		parent::__construct();
		
		// 用户未登录和登录后的分别，对$sidebar_uid赋值
		/*if(isset($_SESSION['winblognow']) && $_SESSION['winblognow']['uid'] > 0){
			$this->site_user = $_SESSION['winblognow'];
		}
		$this->defined = $GLOBALS['G_SP']['winblog_defined'];
		// 将站点配置输入模板中
		$this->winblog = $this->defined;*/
	}
	
	
	
	/**
	 * 显示模板的同时将输出侧栏
	 */
	public function display($tplname, $output = FALSE)
	{
		if( FALSE == $output)return parent::display($tplname);
		
		// 侧栏
		$this->template_sidebar = $this->sidebar();
		// 页面title
		$this->template_title = $this->title. ( ($this->title != "") ? " - " : "" );

		parent::display($tplname, $output);
	}

	/**
	 * 错误提示程序  应用程序的控制器类可以覆盖该函数以使用自定义的错误提示
	 * @param $msg   错误提示需要的相关信息
	 * @param $url   跳转地址
	 * 
	 * @param msg
	 * @param url
	 */
	public function error($msg, $url)
	{
		$this->msg = $msg;
		$this->url = $url;
		$this->display("error.html");
		exit();
	}

	

	/**
	 * 成功提示程序  应用程序的控制器类可以覆盖该函数以使用自定义的成功提示
	 * @param $msg   成功提示需要的相关信息
	 * @param $url   跳转地址
	 * 
	 * @param msg
	 * @param url
	 */
	public function success($msg, $url)
	{
		$this->msg = $msg;
		$this->url = $url;
		$this->display("success.html");
		exit();
	}
	
	
	
	/**
	 * 供继承的侧栏
	 */
	public function sidebar(){return;}
	
	
	public function json_response($result)
	{
		return json_encode($result);;
	}
	
	
	public function error_msg($err_msg){
		return array('stat'=>'fail','err_msg'=>$err_msg);	
	}
	
	public function success_msg($result){
		$arr = array('stat'=>'success');
		foreach($result as $key=>$value){
			$arr[$key] = $value;	
		}
		return $arr;
	}
	
	public function get_first_error($result){
		$first_error = reset($result);
		return $first_error[0];
	}

}
?>