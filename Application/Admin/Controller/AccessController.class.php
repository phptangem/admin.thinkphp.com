<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
use Common\Builder\ListBuilder;
use Common\Builder\FormBuilder;
class AccessController extends AdminController {
    public function index(){
        $keyword = I('keyword', '', 'string');
        $where['a.id|a.uid'] = array('like', '%' . $keyword . '%');
        $where['a.status'] = array('egt', '0'); // 禁用和正常状态
        $p             = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $accessObj = D('Access');
        $dataList  = $accessObj
            ->alias('a')
            ->field('a.id, a.uid, a.status, u.username, g.title as group_title')
            ->join('ly_admin_user as u ON a.uid = u.id')
            ->join('ly_admin_group as g ON a.group = g.id')
            ->page($p, C('ADMIN_PAGE_ROWS'))
            ->where($where)
            ->order('a.sort asc,a.id asc')
            ->select();
        $page = new Page(
            $accessObj->where($where)
                ->alias('a')
                ->join('ly_admin_user as u ON a.uid = u.id')
                ->join('ly_admin_group as g ON a.group = g.id')->count(),
            C('ADMIN_PAGE_ROWS')
        );

        // 使用Builder快速建立列表页面。
        $builder = new ListBuilder();
        $builder->setMetaTitle('管理员列表')                    // 设置页面标题
            ->addTopButton('add')                               // 添加新增按钮
            ->addTopButton('resume')                               // 添加新增按钮
            ->addTopButton('forbid')                            // 添加禁用按钮
            ->addTopButton('delete')                            // 添加删除按钮
            ->setSearch('请输入ID/UID', U('index'))
            ->addTableColumn('id', 'ID')
            ->addTableColumn('uid', 'UID')
            ->addTableColumn('username', '用户名')
            ->addTableColumn('group_title', '用户组')
            ->addTableColumn('status', '状态', 'status')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList)                       // 数据列表
            ->setTableDataPage($page->show())                   // 数据列表分页
            ->addRightButton('edit')                            // 添加编辑按钮
            ->addRightButton('forbid')                          // 添加禁用/启用按钮
            ->addRightButton('delete')                          // 添加删除按钮
            ->display();

    }

    public function add()
    {
        if (IS_POST) {
            $accessObj = D('Access');
            $data          = $accessObj->create();
            if ($data) {
                if ($accessObj->add($data)) {
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($accessObj->getError());
            }
        } else {
            //使用FormBuilder快速建立表单页面。
            $builder = new FormBuilder();
            $builder->setMetaTitle('新增配置') //设置页面标题
                ->setPostUrl(U('add')) //设置表单提交地址
                ->addFormItem('uid', 'uid', 'UID', '用户ID')
                ->addFormItem('group', 'select', '用户组', '不同用户组对应相应的权限', select_list_as_tree('Group'))
                ->display();
        }
    }
}