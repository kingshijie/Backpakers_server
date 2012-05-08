<?php
import (APP_PATH.'/controller/general.php');
class event extends general
{
	
	function fetch_near_event(){
		$range = $this->spArgs('range');
		$x = $this->spArgs('x');
		$y = $this->spArgs('y');
		$row = 'event_id,name,x,y';
		$events = spClass('events')->near_event($x,$y,$range,$row);
		if($events){
			return $events;
		}else{
			$response = $this->error_msg('搜索结果为空');
			return $response;	
		}
	}
	
	function fetch_event(){
		$id = $this->spArgs('id');
		if($result = spClass('events')->fetch_event($id)){
			return $result;
		}else{
			return $this->error_msg('没有找到该事件');	
		}
	}
	
	function publish_event(){
		$x = $this->spArgs('x');
		$y = $this->spArgs('y');
		$range = $this->spArgs('range');
		$newrow = array(
			'name'=>	$this->spArgs('name'),
			'destination'=>$this->spArgs('destination'),
			'time'=>$this->spArgs('time'),
			'spot'=>$this->spArgs('spot'),
			'contact'=>$this->spArgs('contact'),
			'content'=>$this->spArgs('content'),
			'x'=>$x,
			'y'=>$y,
			'user_id'=>$this->spArgs('user_id'),
		);
		if($event_id = spClass('events')->create($newrow)){
			//push给周围用户
			$users = spClass('users')->near_users($x,$y,$range,'device_id',null,1,'user_id!='.$this->spArgs('user_id'));
			$this->push_event($users,$event_id);
			return $this->success_msg();
		}else{
			return $this->error_msg('新建失败，请重试');	
		}
	}
	
	function push_event($users,$event_id){
		require(APP_PATH.'/SAM/php_sam.php');
		
		//dump($users);
		
		//create a new connection object
		$conn = new SAMConnection();
		
		//start initialise the connection 209.124.50.174
		$conn->connect(SAM_MQTT, array(SAM_HOST => '209.124.50.174',
		                               SAM_PORT => 1883));      
		//create a new MQTT message with the output of the shell command as the body
		$msgCpu = new SAMMessage('有新事件[点击察看],'.$event_id);
		
		foreach($users as $user){
			//send the message on the topic cpu
			$conn->send('topic://tokudu/'.$user['device_id'], $msgCpu);
		}
		         
		$conn->disconnect();  
		//echo 'MQTT Message to ' . $_REQUEST['target'] . ' sent: ' . $_REQUEST['message']; 	
	}
	
	/**
	* Android
	**/
	//获取当前位置周围的事件
	function android_fetch_near_event(){
		$result = $this->fetch_near_event();
		$response['data'] = $result;
		echo $this->json_response($response);
	}
	
	//获取某个事件
	function android_fetch_event(){
		$result = $this->fetch_event();
		echo $this->json_response($result);
	}
	
	//添加事件
	function android_publish_event(){
		$reuslt = $this->publish_event();
		echo $this->json_response($reuslt);
	}
	
	
}