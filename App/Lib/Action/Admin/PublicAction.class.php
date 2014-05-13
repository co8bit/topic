<?php

class PublicAction extends Action {
	public  function login() {
		if ( IS_POST ) {
			$email   = I( 'post.email', '', 'trim' );
			$password   = I( 'post.password', '', 'safe' );
			$verify   = I( 'post.verify', '', 'safe' );

			empty( $email ) && $this->error( '邮箱不能为空' );
			empty( $password ) && $this->error( '密码不能为空' );

			$User =  D( 'User' );
			$user =  $User->login( $email, $password, true );
			if ( $user ) {
				$this->success( '登录成功', U( 'index/index' ) );
			} else {
				$this->error( $User->getError() );
			}
		} else {

			if (session('is_admin') ==true) {
				$this->redirect('Index/index');
			}
			$this->display();
		}
	}

	public function logout() {

		if ( session('is_admin') ) {
			session( 'is_admin', null );
			$this->success( '退出成功！', U( 'login' ) );
		} else {
			$this->redirect( 'login' );
		}
	}
}
?>
