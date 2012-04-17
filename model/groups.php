<?php
class groups extends spModel
{
	var $pk = "group_id";
	var $table = "groups";	
	var $linker = array(
		array(
			'type'=>'manytomany',
			'map'=>'abilities',
			'midclass'=>'group_ability',
			'mapkey'=>'group_id',
			'fclass'=>'abilities',
			'fkey'=>'ability_id',
			'enabled'=>TRUE
		),	
	);
	var $verifier = array(
		"rules"=>array(
			'name'=>array(
				'notnull'=>TRUE,
				'maxlength'=>10,	
			),	
		),	
		"messages" => array( // 提示消息，从上面的rules复制下来，很快捷。
			'name' => array(  
				'notnull' => "[名称不能为空]",  
				'maxlength' => "[不能大于10个字符]", 
			),
		),
	);
}