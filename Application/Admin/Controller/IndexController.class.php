<?php
namespace Admin\Controller;
use Common\Controller\ControllerController;
class IndexController extends ControllerController {
    public function index(){
        \Think\Build::buildController('Admin','Public');
    }
}