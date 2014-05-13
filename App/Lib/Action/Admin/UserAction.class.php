<?php

class UserAction  extends BaseAction{

	public  function  index(){
		$users = D('User')->getAllUsers();
		$this->assign('users',$users);
		$this->display();
	}

	public  function del(){
		$uid = I('get.uid', 0, 'intval');
		$result = D('User')->where(array('uid'=>$uid))->setField('is_active', '-1');
		if ($result) {
			$this->success('操作成功');
		} else {
			$this->error('操作失败');
		}
	}

} 
?>