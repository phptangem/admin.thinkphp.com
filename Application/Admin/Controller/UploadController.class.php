<?php
namespace Admin\Controller;
use Think\Controller;
class UploadController extends Controller {
    public function index(){

    }

    /**
     * 上传
     */
    public function upload(){
        $ret = json_encode(D('Upload')->upload());
        exit($ret);
    }
}