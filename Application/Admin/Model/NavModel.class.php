<?php
namespace Admin\Model;
use Common\Model\ModelModel;
class NavModel extends ModelModel {
    /**
     * 数据库表明
     * @var string
     */
    protected $tableName = 'admin_nav';

    /**
     * 导航类型
     * @param int $id
     * @return mixed
     */
    public function navType($id = 0){
        $list['link']   = '链接';
        $list['module'] = '模块';
        $list['page']   = '单页';
        $list['post']   = '文章列表';
        return $id ? $list[$id] : $list;
    }

}