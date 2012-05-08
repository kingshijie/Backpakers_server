<?php
import (APP_PATH.'/model/modulesModle.php');
class sceneries extends modulesModle
{
	var $pk = "scenery_id";
	var $table = "sceneries";	
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
				'notnull'=>'旅游点名称不能为空',
			),
			'description'=>array(
				'notnull'=>'旅游点的简介不能为空',
			),
		),
	);
}