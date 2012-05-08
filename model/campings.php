<?php
import (APP_PATH.'/model/modulesModle.php');
class campings extends modulesModle
{
	var $pk = "camping_id";
	var $table = "campings";
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
				'notnull'=>'露营点名称不能为空',
			),
			'description'=>array(
				'notnull'=>'露营点的简介不能为空',
			),
		),
	);	
}