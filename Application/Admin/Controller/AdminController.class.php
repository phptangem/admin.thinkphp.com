<?php
namespace Admin\Controller;
use Common\Controller\ControllerController;
class AdminController extends ControllerController {
    /**
     * 初始化方法
     */
    protected function _initialize(){
        //检查登录
        if(!is_login()){
            //还没有登录跳转到登录页
            $this->redirect('Admin/Public/login');
        }

        C('PARSE_VAR', true);

        //权限检测
        $currentUrl = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        if("Admin/Index/index" !== $currentUrl){
            if(! D('Admin/Group')->checkMenuAuth()){
                $this->error('权限不足！', U('Admin/Index/index'));
            }
        }
        $this->assign('_admin_tabs', C('ADMIN_TABS'));

        //获取所有导航
        $moduleObj = D('Admin/Module');
        $menuList  = $moduleObj->getAllMenu();
        $this->assign('_menu_list', $menuList); //后台主菜单

        //获取左侧导航菜单
        if( ! C('ADMIN_TABS')){
            $parentMenuList = $moduleObj->getParentMenu();
            if(isset($parentMenuList[0]['top'])) {
                $currentMenuList = $menuList[$parentMenuList[0]['top']];
            }else{
                $currentMenuList = $menuList[MODULE_NAME];
            }
            $this->assign('_current_menu_list', $currentMenuList); // 后台左侧菜单
            $this->assign('_parent_menu_list', $parentMenuList); // 后台父级菜单
        }
    }

    public function setStatus($model = CONTROLLER_NAME, $script = false){
        $ids        = I('request.ids');
        $status     = I('request.status');
        if(empty($ids)){
            $this->error('选择要操作的数据');
        }
        $modelPrimaryKey = D($model)->getPk();
    }
}