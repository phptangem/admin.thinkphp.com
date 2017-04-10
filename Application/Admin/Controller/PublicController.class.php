<?php
namespace Admin\Controller;
use Common\Controller\ControllerController;
class PublicController extends ControllerController {

	/**
	 * 后台登录
	 */
    public function login(){
    	if(IS_POST){
			$username = I('username');
			$password = I('password');

			//验证用户名密码是否正确
			$userObj 	= D('Admin/User');
			$userInfo  	= $userObj->login($username, $password);
			if(! $userInfo){
				$this->error($userObj->getError());
			}

			// 验证管理员表里是否有该用户
			$accessObj 		= D('Admin/Access');
			$where['uid'] 	= $userInfo['id'];
			$accessInfo		= $accessObj->where($where)->find();
			if(! $accessInfo){
				$this->error('该用户没有管理员权限');
			}

			// 设置登录状态
			$uid = $userObj->autoLogin($userInfo);

			//跳转
			if(0 < $accessInfo['uid'] && $accessInfo['uid'] === $uid){
				$this->success('登录成功!', U('Admin/Index/index'));
			} else {
				$this->logout();
			}
    	}else{

			$this->assign('meta_title', '管理员登录');
			$this->display();
    	}
    }

	/**
	 * 注销
	 */
	public function logout(){
		session('user_auth', null);
		session('user_auth_sign', null);
		session('user_group', null);
		$this->success('退出成功!', U('login'));
	}
}