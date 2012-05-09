<?php
import (APP_PATH.'/model/modulesModle.php');
class shops extends modulesModle
{
	var $pk = "shop_id";
	var $table = "shops";	
	var $verifier = array(
		"rules"=>array(
			'name'=>array(
				'notnull'=>TRUE,
			),
			'description'=>array(
				'notnull'=>TRUE,
			),
		),
		"messages"=>array(
			'name'=>array(
				'notnull'=>'购物点名称不能为空',
			),
			'description'=>array(
				'notnull'=>'购物点的简介不能为空',
			),
		),
	);
}