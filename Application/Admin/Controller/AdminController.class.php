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
            //还没有登录跳转到登录页
            $this->redirect('Admin/Public/login');
        }

        C('PARSE_VAR', true);

        $currentUrl = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

        if("Admin/Index/index" !== $currentUrl){

        }
    }
}