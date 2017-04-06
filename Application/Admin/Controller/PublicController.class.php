<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function login(){
    	if(IS_POST){

    	}else{
    		$this->assign('meta_title', '管理员登录');
            $this->display();
    	}
    }
}