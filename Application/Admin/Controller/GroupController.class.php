<?php
namespace Admin\Controller;
use Think\Controller;
use Util\Tree;
use Common\Builder\ListBuilder;
class GroupController extends AdminController {
    public function index(){
        $keyword            = I('keyword', '', 'string');
        $where['id|title']  = array('like', '%' . $keyword . '%');
        $where['status']    = array('egt', '0');

        $dataList = D('Group')
            ->where($where)
            ->order('sort asc, id asc')
            ->select();
        $tree = new Tree();
        $dataList = $tree->array2tree($dataList);
        $rightButton['no']['title']     = '超级管理员无需操作';
        $rightButton['no']['attribute'] = 'class="label label-warning" href="#"';

        // 使用Builder快速建立列表页面。
        $builder = new ListBuilder();
        $builder->setMetaTitle('部门列表')  // 设置页面标题
            ->addRightButton('add')         // 添加新增按钮
            ->addRightButton('resume')      // 添加启用按钮
            ->addRightButton('forbid')      // 添加禁用按钮
            ->addRightButton('delete')      // 添加删除按钮
            ->setSearch('请输入ID/部门名称', U('index'))
            ->addTableColumn('id', 'ID')
            ->addTableColumn('title_show', '标题')
            ->addTableColumn('icon', '图标', 'icon')
            ->addTableColumn('sort', '排序')
            ->addTableColumn('status', '状态', 'status')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList) // 数据列表
            ->addRightButton('edit') // 添加编辑按钮
            ->addRightButton('forbid') // 添加禁用/启用按钮
            ->addRightButton('delete') // 添加删除按钮
            ->alterTableData( // 修改列表数据
                array('key' => 'id', 'value' => '1'),
                array('right_button' => $rightButton)
            )
            ->display();

    }
}