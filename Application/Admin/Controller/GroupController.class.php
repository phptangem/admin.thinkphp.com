<?php
namespace Admin\Controller;
use Common\Builder\FormBuilder;
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
            ->addTopButton('add')         // 添加新增按钮
            ->addTopButton('resume')      // 添加启用按钮
            ->addTopButton('forbid')      // 添加禁用按钮
            ->addTopButton('delete')      // 添加删除按钮
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
    public function add(){
        if(IS_POST){

        }else{
            $where['status'] = array('egt', 0);
            $allGroup = select_list_as_tree('Group', $where, '顶级部门');

            // 获取功能模块的后台菜单列表
            $tree = new Tree();
            $moduleList = D('Module')
                ->where(array('status' => 1))
                ->select();
            $allModuleMenuList = array();
            foreach($moduleList as $key => $module){
                $temp   = json_decode($module['admin_menu'], true);
                $menuListItem = $tree->list2tree($temp);
                $allModuleMenuList[$module['name']] = $menuListItem[0];
            }
            $this->assign('all_module_menu_list', $allModuleMenuList);
            $this->assign('all_group', $allGroup);
            $this->assign('meta_title', '新增部门');
            $this->display('add_edit');
        }
    }

    public function edit($id){
        if(IS_POST){

        }else{
            // 获取部门信息
            $group              = D('Group')->find($id);
            $group['menu_auth'] = json_decode($group['menu_auth'], true);

            // 获取现有部门
            $where['status']    = array('egt', 0);
            $allGroup           = select_list_as_tree('Group', $where, '顶级部门');

            // 获取所有安装并启用的功能模块
            $moduleList = D('Module')
                ->where(array('status' => 1))
                ->select();
            // 获取功能模块的后台菜单列表
            $tree                 = new Tree();
            $allModuleMenuList = array();
            foreach ($moduleList as $key => $val) {
                $temp                               = json_decode($val['admin_menu'], true);
                $menuListItem                       = $tree->list2tree($temp);
                $allModuleMenuList[$val['name']]    = $menuListItem[0];
            }

            $this->assign('info', $group);
            $this->assign('all_module_menu_list', $allModuleMenuList);
            $this->assign('all_group', $allGroup);
            $this->assign('meta_title', '编辑部门');
            $this->display('add_edit');
        }
    }
}