<?php
namespace Admin\Controller;
use Common\Builder\ListBuilder;
use Think\Controller;
use Think\Page;
class UploadController extends AdminController {
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

        // 使用Builder快速建立列表页面
        $builder = new ListBuilder();
        $builder->setMetaTitle('上传列表')
            ->addTopButton('resume')
            ->addTopButton('forbid')
            ->addTopButton('delete')
            ->setSearch('请输入ID/上传关键字', U('index'))
            ->addTableColumn('id', 'ID')
            ->addTableColumn('show', '文件')
            ->addTableColumn('name', '文件名及路径')
            ->addTableColumn('size', '大小', 'byte')
            ->addTableColumn('create_time', '创建时间', 'time')
            ->addTableColumn('sort', '排序')
            ->addTableColumn('status', '状态', 'status')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList) // 数据列表
            ->setTableDataPage($page->show()) // 数据列表分页
            ->addRightButton('forbid') // 添加禁用/启用按钮
            ->addRightButton('delete') // 添加删除按钮
            ->display();
    }

    /**
     * 上传
     */
    public function upload(){
        $ret = json_encode(D('Upload')->upload());
        exit($ret);
    }
}