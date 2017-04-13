<?php
namespace Admin\Controller;

class IndexController extends AdminController {
    /**
     * 默认方法
     */
    public function index(){
//        \Think\Build::buildModel('Admin','Group');
//        \Think\Build::buildController('Admin','Config');
//        \Think\Build::buildController('Admin','Nav');
//        \Think\Build::buildController('Admin','Upload');
//        \Think\Build::buildController('Admin','User');
//        \Think\Build::buildController('Admin','Access');
//        \Think\Build::buildController('Admin','Module');
//        \Think\Build::buildController('Admin','Addon');
        $this->assign('meta_title', '后台首页');
        $this->display();
    }
}