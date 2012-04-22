<?php
class abilities extends spModel
{
	var $pk = "ability_id";
	var $table = "abilities";	
	var $verifier = array(
		"rules"=>array(
			'description'=>array(
				'notnull'=>TRUE,
				'maxlength'=>25,	
			),	
		),	
		"messages" => array( // 提示消息，从上面的rules复制下来，很快捷。
			'description' => array(  
				'notnull' => "[权限名称不能为空]",  
				'maxlength' => "[不能大于25个字符]", 
			),
		),
	);
	
	function have_ability($abilities,$ability){
		foreach($abilities as $item){
			if($item['description'] == $ability){
				return TRUE;	
			}
		}
		return FALSE;
	}
}