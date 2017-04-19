<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class UploadController extends Controller {
    public function index(){
        $keyword = I('keyword', '', 'string');
        $where['id|name'] = array('like', '%' . $keyword . '%');
        $where['status']  = array('egt', '0');
        $p             = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $uploadObj = D('Admin/Upload');
        $dataList  = $uploadObj
            ->page($p, C('ADMIN_PAGE_ROWS'))
            ->where($where)
            ->order('sort desc,id desc')
            ->select();
        $page = new Page(
            $uploadObj->where($where)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        foreach($dataList as &$data){
            $data['name'] = cut_str($data['name'], 0, 30) . '<input class="form-control input-sm" value="'. $data['path'] . '">';
        }

    }

    /**
     * 上传
     */
    public function upload(){
        $ret = json_encode(D('Upload')->upload());
        exit($ret);
    }
}