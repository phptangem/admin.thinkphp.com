<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Builder\ListBuilder;
class ModuleController extends AdminController {
    public function index(){
        $dataList = D('Module')->getAll();

        // 使用Builder快速建立列表页面
        $builder  = new ListBuilder();
        $builder->setMetaTitle('模块列表')
            ->addTopButton('resume')
            ->addTopButton('forbid')
            ->setSearch('请输入ID/标题', U('index'))
            ->addTableColumn('name', '名称')
            ->addTableColumn('title', '标题')
            ->addTableColumn('description', '描述')
            ->addTableColumn('developer', '开发者')
            ->addTableColumn('version', '版本')
            ->addTableColumn('create_time', '创建时间', 'time')
            ->addTableColumn('status_icon', '状态', 'text')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList) // 数据列表
            ->display();
    }
}