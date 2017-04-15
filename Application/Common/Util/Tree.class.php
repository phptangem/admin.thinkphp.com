<?php
namespace Util;

/**
 * 列表树生成工具类
 */
class Tree{
    /**
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @param bool|true $strict
     * @return array
     */
    public function list2tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0, $strict = true)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = &$list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parent_id = $data[$pid];
                if ($parent_id === null || (String) $root === $parent_id) {
                    $tree[] = &$list[$key];
                } else {
                    if (isset($refer[$parent_id])) {
                        $parent           = &$refer[$parent_id];
                        $parent[$child][] = &$list[$key];
                    } else {
                        if ($strict === false) {
                            $tree[] = &$list[$key];
                        }
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * @param $list
     * @param string $title
     * @param string $pk
     * @param string $pid
     * @param int $root
     * @param bool|true $strict
     * @return array
     */
    public function array2tree($list, $title = 'title', $pk = 'id', $pid = 'pid', $root = 0, $strict = true){
        $list             = $this->list2tree($list, $pk, $pid, '_child', $root, $strict);
        $this->formatTree = array();
        $this->_array2tree($list, 0, $title);
        return $this->formatTree;
    }

    /**
     * 将格式数组转换为基于标题前缀的树（实际还是列表，只是通过在相应字段加前缀实现类似树状结构）
     * @param $list
     * @param int $level
     * @param string $title
     */
    private function _array2tree($list, $level = 0, $title = 'title')
    {
        foreach ($list as $key => $val) {
            $title_prefix = str_repeat("&nbsp;", $level * 4);
            $title_prefix .= "┝ ";
            $val['level']        = $level;
            $val['title_prefix'] = $level == 0 ? '' : $title_prefix;
            $val['title_show']   = $level == 0 ? $val[$title] : $title_prefix . $val[$title];
            if (!array_key_exists('_child', $val)) {
                array_push($this->formatTree, $val);
            } else {
                $child = $val['_child'];
                unset($val['_child']);
                array_push($this->formatTree, $val);
                $this->_array2tree($child, $level + 1, $title); //进行下一层递归
            }
        }
        return;
    }
}