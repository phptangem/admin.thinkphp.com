<?php
namespace Admin\Controller;
use Util\Tree;
use Common\Builder\ListBuilder;
class NavController extends AdminController {
    public function index($group = 'main'){

        $keyword    = I('keyword', '', 'string');
        $condition  = array('like', '%' . $keyword . '%');

        $where['group']     = $group;
        $where['status']    = array('egt', 0);
        $where['id|title']  = $condition;
        $navObj = D('Admin/Nav');

        //获取所有导航
        $list = $navObj
            ->where($where)
            ->order('sort asc,id asc')
            ->select();

        // 给文章列表加上链接
        foreach($list as $val){
            if($val['type'] == 'post'){
                $val['title'] = '<a href="' . U('Admin/Post/index', array('cid' => $val['id'])) . '">' . $val['title'] . '</a>';
            }
        }

        // 转换成树状列表
        $tree = new Tree();
        $dataList = $tree->array2tree($list);

        $navGroupList = C('NAV_GROUP_LIST'); // 获取分类分组
        foreach($navGroupList as $key => $val){
            $tabList[$key]['title'] = $val;
            $tabList[$key]['href']  = U('index', array('group' => $key));
        }

        //使用Builder快速建立列表页面
        $builder = new ListBuilder();
        $builder->setMetaTitle('导航列表')
            ->addTopButton('add', array('href' => U('Admin/Nav/add', array('group' => $group)))) // 添加新增按钮
            ->addTopButton('resume') // 添加启用按钮
            ->addTopButton('forbid') // 添加禁用按钮
            ->addTopButton('delete') // 添加删除按钮
            ->setSearch('请输入ID/导航名称', U('index', array('group' => $group)))
            ->setTabNav($tabList, $group) // 设置页面Tab导航
            ->addTableColumn('id', 'ID')
            ->addTableColumn('icon', '图标', 'icon')
            ->addTableColumn('title_show', '标题')
            ->addTableColumn('sort', '排序')
            ->addTableColumn('status', '状态', 'status')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList) // 数据列表
            ->addRightButton('edit',  array('href' => U('edit', array('group' => $group, 'id' => '__data_id__')))) // 添加编辑按钮
            ->addRightButton('forbid') // 添加禁用/启用按钮
            ->addRightButton('delete') // 添加删除按钮
            ->display();

    }
}