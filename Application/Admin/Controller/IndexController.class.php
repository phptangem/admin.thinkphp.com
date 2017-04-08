<?php
namespace Admin\Controller;

class IndexController extends AdminController {
    public function index(){
        $this->assign('meta_title', '后台首页');
        $this->display();
    }
}