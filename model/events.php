<?php
class events extends spModel
{
	var $pk = "event_id";
	var $table = "events";
	
	//获取附近事件
	function near_event($x,$y,$range,$row=null){
		$sql = 'x>'.($x-$range).' AND x<'.($x+$range).' AND y>'.($y-$range).' AND y<'.($y+$range).' AND time>NOW()';
		return $this->findAll($sql,'time',$row);
	}	
	
	//获取特定事件
	function fetch_event($event_id){
		$event_tbl = $this->table;
		$user_tbl = spClass('users')->table;
		$sql = "SELECT $event_tbl.*,username FROM $event_tbl,$user_tbl WHERE event_id=$event_id AND $event_tbl.user_id=$user_tbl.user_id";
		if($result = $this->findSql($sql)){
			return $result[0];
		}	else{
			return false;	
		}
	}
}