<?php 

class BaseAction extends Action {
	/**
	    * 后台控制器初始化
	    */
	   protected function _initialize(){

	   		if (false ===$settings = F('settings')) {
	   			$settings =  D('Settings')->getSettings();
	   		}
	   		C($settings);
	   		
	       $this->mid =  is_login();
	       if (!session('is_admin')) {
	    		$this->redirect('Public/login');
	       }
	   }
	
}
?>