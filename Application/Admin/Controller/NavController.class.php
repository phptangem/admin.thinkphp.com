<?php
namespace Admin\Controller;
use Common\Controller\ControllerController;
use Util\Tree;

class NavController extends ControllerController {
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
        $list = $tree->array2tree($list);

        $navGroupList = C('NAV_GROUP_LIST'); // 获取分类分组
        foreach($navGroupList as $key => $val){
            $tabList[$key]['title'] = $val;
            $tabList[$key]['href']  = U('index', array('group' => $key));
        }

        //使用Builder快速建立列表页面
    }
}