<?php
import (APP_PATH.'/controller/general.php');
class module_basic extends general
{
	//所操作的数据库对象
	var $table;
	//所操作的模块名
	var $module_name;
	
	public function __construct(){
		parent::__construct();
		if(empty($_SESSION['user_info'])){
			//没有登陆信息		
			//如果客户端有发送重新登陆信息
			if(spClass('users')->user_validation($this->spArgs('user_id'),$this->spArgs('username'))){
				//用户id与username合法,is_banned==0
				$_SESSION['user_info'] = array('user_id'=>$this->spArgs('user_id'),'username'=>$this->spArgs('username'));		
			}else{
				// 不合法，返回错误,客户端应该清空登陆情况，有盗号风险
				$response = $this->error_msg('请求失败，您的帐号有异常，请重新登陆');	
				echo json_encode($response);
				exit;
			}
		}
	}
	
	function index(){
		echo "Enjoy, Speed of PHP!";
	}
	
	//插入一条item
	function add(){
		//验证表单
		$verifier_result = $this->table->spVerifier($this->spArgs());
		if(FALSE == $verifier_result){
			//往对应模块中添加数据
			$creation = array();
			$additions = array();
			$creation['user_id'] = $this->spArgs('user_id');//创建者
			$creation['name'] = $this->spArgs('name');//名称
			$creation['description'] = $this->spArgs('description');//描述
			$creation['notice'] = $this->spArgs('notice');//注意
			$creation['x'] = $this->spArgs('x');//坐标x
			$creation['y'] = $this->spArgs('y');//坐标y
			$creation['city'] = $this->spArgs('city');
			$item = $this->table->create($creation);
			if($item){
				//往addition表中添加数据
				$module_id = spClass('modules')->get_module_id($this->module_name);
				$additions['user_id'] = $_SESSION['user_info']['user_id'];
				$additions['module_id'] = $module_id;
				$additions['item'] = $item;
				$addition_id = spClass('additions')->create($additions);
				if($addition_id){
					//给用户加分
					if(spClass('users')->add_credit($_SESSION['user_info']['user_id'])){
						$response = $this->success_msg();
					}else{
						$response = $this->error_msg('数据库操作失败');
					}
				}else{
					$response = $this->error_msg('数据库操作失败');
				}
			}else 
				$response = $this->error_msg('数据库操作失败');
		}else{
			//表单验证失败，返回第一条错误信息
			$response = $this->error_msg($this->get_first_error($verifier_result));
		}
		return $response;
	}
	
	function edit(){
		
	}
	
	//查询身边
	function search_near(){
		$range = $this->spArgs('range');
		$x = $this->spArgs('x');
		$y = $this->spArgs('y');
		$key_word = $this->spArgs('key_word');
		$con = '';
		if($key_word != ''){
			$con = " AND name LIKE '%$key_word%'";
		}
		$result = $this->table->findAll('is_approve=1 AND x>'.($x-$range).' AND x<'.($x+$range).' AND y>'.($y-$range).' AND y<'.($y+$range).$con,null,$this->table->pk.' as id,name,x,y');
		if($result){
			return $result;
		}else{
			$response = $this->error_msg('搜索结果为空');
			return $response;	
		}
	}
	
	//获取项目
	function fetch_item(){
		$id = $this->spArgs('id');
		if($id){
			$condition = array($this->table->pk => $id);
			$sql = 'SELECT '.$this->table->pk.' as id,name,score,voted,x,y,city,description,notice,'.$this->table->table.'.user_id,username 
			FROM '.$this->table->table.','.spClass('users')->table.' 
			WHERE '.$this->table->table.'.user_id='.spClass('users')->table.'.user_id 
			AND '.$this->table->pk.'='.$id.' LIMIT 1';
			$result = $this->table->findSql($sql);
			if($result){
				return $result;	
			}	else{
				$response = $this->error_msg('没有查询到对应的项目');
			}
		}	
	}
	
	function report(){
		$user_id = $this->spArgs('user_id');
		$item = $this->spArgs('id');
		$contents = $this->spArgs('contents');
		$sql = 'insert into '.spClass('reports')->table." (report_id,user_id,module_id,item,contents)values(NULL,$user_id,(SELECT module_id FROM ".(spClass('modules')->table).' WHERE name=\''.$this->module_name."'),$item,'$contents')";
		if($this->table->runSql($sql)){
			return $this->success_msg();
		}else {
			return $this->error_msg('操作失败');
		}
	}
	
	function scoring(){
		$item = $this->spArgs('id');
		$score = $this->spArgs('score');
		$sql = 'update '.$this->table->table.' set score=score+'.$score.',voted=voted+1 where '.$this->table->pk.'='.$item;
		if($this->table->runSql($sql)){
			return $this->success_msg();
		}else {
			return $this->error_msg('操作失败');
		}
	}

	//
	//Android APIs
	//	
	function android_add(){
		$response = $this->add();
		echo $this->json_response($response);
	}
	
	function android_search_near(){
		$result = $this->search_near();
		$response['data'] = $result;
		echo $this->json_response($response);
	}
	
	function android_fetch_item(){
		$response = $this->fetch_item();
		echo $this->json_response($response[0]);
	}
	
	function android_report(){
		$response = $this->report();
		echo $this->json_response($response);
	}
	
	function android_scoring(){
		$response = $this->scoring();
		echo $this->json_response($response);
	}
}