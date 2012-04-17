<?php
/**
检查登陆情况
**/
import (APP_PATH.'/controller/general.php');
class admin extends general
{
	function __construct(){
		//检查是否登陆
		parent::__construct();
	}
	
	function index(){
		$this->display('admin/index.html');
	}
}