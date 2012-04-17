function del_confirm(){
	if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) {
		return false;
	}	
}