<?php
/**
检查登陆情况
**/
import (APP_PATH.'/controller/general.php');
class admin extends general
{
	//所调用的模块
	var $module;
	//数据操作的条件
	//var condition;
	//数据操作的列
	//var row; 
	
	//var $err_msg;
	
	function __construct(){
		parent::__construct();
		$this->err_msg = $this->spArgs('err_msg');
		//检查是否登陆
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
}