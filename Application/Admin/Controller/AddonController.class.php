<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Builder\ListBuilder;
class AddonController extends AdminController {
    public function index(){
        // 获取所有插件信息
        $addObj = D('Addon');
        $addons = $addObj
            ->getAllAddon();

        // 使用Builder快速建立列表页面
        $builder = new ListBuilder();
        $builder->setMetaTitle('插件列表')
            ->addTopButton('resume')
            ->addTopButton('forbid')
            ->addTableColumn('name', '标识')
            ->addTableColumn('title', '名称')
            ->addTableColumn('description', '描述')
            ->addTableColumn('status', '状态')
            ->addTableColumn('author', '作者')
            ->addTableColumn('version', '版本')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($addons) // 数据列表
            ->display();
    }

}