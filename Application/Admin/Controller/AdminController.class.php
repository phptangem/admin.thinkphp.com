<?php
namespace Admin\Controller;
use Common\Controller\ControllerController;
class AdminController extends ControllerController {
    /**
     * 初始化方法
     */
    protected function _initialize(){
        //检查登录
        if(!is_login()){
            $this->redirect('Admin/Public/login');
        }
    }
}