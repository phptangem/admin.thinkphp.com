<?php
namespace Admin\Controller;
use Common\Builder\FormBuilder;
use Common\Builder\ListBuilder;
use Think\Page;
class UserController extends AdminController {
    public function index(){
        $keyword = I('keyword', '', 'string');
        $where['id|username|email|mobile'] = array('like', "%" . $keyword . "%");
        $where['status'] = array('egt', '0');
        $p             = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $userObj       = D('User');
        $dataList      = $userObj
            ->page($p,  C('ADMIN_PAGE_ROWS'))
            ->where($where)
            ->order('id desc')
            ->select();
        $page = new Page(
            $userObj->where($where)->count(),
            C('ADMIN_PAGE_ROWS')
        );
        // 使用Builder快速建立列表页面
        $builder = new ListBuilder();
        $builder->setMetaTitle('用户列表') // 设置页面标题
            ->addTopButton('add') // 添加新增按钮
            ->addTopButton('resume') // 添加启用按钮
            ->addTopButton('forbid') // 添加禁用按钮
            ->addTopButton('delete') // 添加删除按钮
            ->setSearch('请输入ID/用户名／邮箱／手机号', U('index'))
            ->addTableColumn('id', 'UID')
            ->addTableColumn('avatar', '头像', 'picture')
            ->addTableColumn('nickname', '昵称')
            ->addTableColumn('username', '用户名')
            ->addTableColumn('email', '邮箱')
            ->addTableColumn('mobile', '手机号')
            ->addTableColumn('create_time', '注册时间', 'time')
            ->addTableColumn('status', '状态', 'status')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($dataList) // 数据列表
            ->setTableDataPage($page->show()) // 数据列表分页
            ->addRightButton('edit') // 添加编辑按钮
            ->addRightButton('forbid') // 添加禁用/启用按钮
            ->addRightButton('recycle') // 添加删除按钮
            ->display();
    }
    public function add(){
        if(IS_POST){

        }else{
            $builder = new FormBuilder();
            $builder->setMetaTitle('新增用户')
                ->setPostUrl(U('add'))
                ->addFormItem('reg_type', 'hidden', '注册方式', '注册方式')
                ->addFormItem('nickname', 'text', '昵称', '昵称')
                ->addFormItem('username', 'text', '用户名', '用户名')
                ->addFormItem('password', 'password', '密码', '密码')
                ->addFormItem('email', 'text', '邮箱', '邮箱')
                ->addFormItem('email_bind', 'radio', '邮箱绑定', '手机绑定', array('1' => '已绑定', '0' => '未绑定'))
                ->addFormItem('mobile', 'text', '手机号', '手机号')
                ->addFormItem('mobile_bind', 'radio', '手机绑定', '手机绑定', array('1' => '已绑定', '0' => '未绑定'))
                ->addFormItem('avatar', 'picture', '头像', '头像')
                ->setFormData(array('reg_type' => 'admin'))
                ->display();
        }
    }
}