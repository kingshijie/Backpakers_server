<?php
class hostels extends spModel
{
	var $pk = "hostel_id";
	var $table = "hostels";	
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
				'notnull'=>'旅店名不能为空',
			),
			'description'=>array(
				'notnull'=>'旅店简介不能为空',
			),
		),
	);
}