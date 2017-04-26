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
        $where[$modelPrimaryKey] = array('in', $ids);
        if($script){
            $where['uid'] = array('eq', is_login());
        }
        switch($status){
            case 'forbid'://禁用条目
                $data = array('status' => 0);
                $this->editRow(
                    $model,
                    $data,
                    $where,
                    array('success' => '禁用成功', 'error' => '禁用失败')
                );
                break;
            case 'resume':// 启用条目
                $data = array('status' => 1);
                $where  = array_merge(array('status' => 0), $where);
                $this->editRow(
                    $model,
                    $data,
                    $where,
                    array('success' => '启用成功', 'error' => '启用失败')
                );
                break;
            case 'recycle': // 移动至回收站
                $data['status'] = -1;
                $this->editRow(
                    $model,
                    $data,
                    $where,
                    array('success' => '成功移至回收站', 'error' => '删除失败')
                );
                break;
            case 'restore': // 从回收站还原
                $data = array('status' => 1);
                $where  = array_merge(array('status' => -1), $where);
                $this->editRow(
                    $model,
                    $data,
                    $where,
                    array('success' => '恢复成功', 'error' => '恢复失败')
                );
                break;
            case 'delete': // 删除条目
                $result = D($model)->where($where)->delete();
                if ($result) {
                    $this->success('删除成功，不可恢复！');
                } else {
                    $this->error('删除失败');
                }
                break;
            default:
                $this->error('参数错误');
                break;
        }
    }

    /**
     * @param $model
     * @param $data
     * @param $where
     * @param $msg
     */
    final protected function editRow($model, $data, $where, $msg){
        $id = array_unique((array)I('id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        //如存在id字段，则加入该条件
        $fields = D($model)->getDbFields();
        if(in_array('id', $fields) && !empty($id)){
            $where = array_merge(
                array('id' => array('in', $id)),
                (array) $where
            );
        }
        $msg = array_merge(
            array(
                'success' => '操作成功！',
                'error'   => '操作失败！',
                'url'     => ' ',
                'ajax'    => IS_AJAX,
            ),
            (array) $msg
        );
        $result = D($model)->where($where)->save($data);
        if ($result != false) {
            $this->success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
            $this->error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }
}