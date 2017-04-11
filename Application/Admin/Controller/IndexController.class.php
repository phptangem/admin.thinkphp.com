<?php
namespace Admin\Controller;

class IndexController extends AdminController {
    /**
     * 默认方法
     */
    public function index(){
        \Think\Build::buildModel('Admin','Group');
        $this->assign('meta_title', '后台首页');
        $this->display();
    }
}