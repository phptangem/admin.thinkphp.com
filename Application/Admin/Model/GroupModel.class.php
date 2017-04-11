<?php
namespace Admin\Model;
use Think\Model;
class GroupModel extends Model {
    protected $tableName = 'admin_group';
    public function checkMenuAuth(){
        return true;
    }
}