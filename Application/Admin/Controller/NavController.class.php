<?php
namespace Admin\Controller;
use Common\Builder\FormBuilder;
use Util\Tree;
use Common\Builder\ListBuilder;
class NavController extends AdminController {
    // 根据导航类型设置表单项目
    private $extraHtml = <<<EOF
    <script type="text/javascript">
        $(function(){
            $('input[name="type"]').change(function() {
                var type = $(this).val();
                // 链接类型
                if (type == 'link') {
                    $('.item_url').removeClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').addClass('hidden');
                // 模块类型
                } else if (type == 'module') {
                    $('.item_url').addClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').removeClass('hidden');
                // 单页类型
                } else if (type == 'page') {
                    $('.item_url').addClass('hidden');
                    $('.item_content').removeClass('hidden');
                    $('.item_module_name').addClass('hidden');
                // 文章列表类型
                } else if (type == 'post') {
                    $('.item_url').addClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').addClass('hidden');
                } else {
                    $('.item_url').addClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').addClass('hidden');
                }
            });
        });
    </script>
EOF;
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

    public function add($group){
        if(IS_POST){
            $navObj = D('Admin/Nav');
            $data   = $navObj->create();
            if($data){
                $id = $navObj->add($data);
                if($id){
                    $this->success('新增成功', U('index', array('group' => $group)));
                }else{
                    $this->error('新增失败');
                }
            } else {
                $this->error($navObj->getError());
            }
        }else{
            $builder = new FormBuilder();
            $builder->setMetaTitle('新增导航') // 设置页面标题
                ->setPostUrl(U('', array('group' => $group)))
                ->addFormItem('group', 'hidden', '导航分组', '导航分组')
                ->addFormItem('pid', 'select', '上级导航', '上级导航', select_list_as_tree('Admin/Nav', array('group' => $group), '顶级导航'))
                ->addFormItem('title', 'text', '导航标题', '导航前台显示标题')
                ->addFormItem('type', 'radio', '导航类型', '导航类型', D('Admin/Nav')->navType())
                ->addFormItem('url', 'text', '外链URL地址', '支持http://格式或者TP的U函数解析格式')
                ->addFormItem('content', 'kindeditor', '单页内容', '单页内容', null, 'hidden')
                ->addFormItem('target', 'radio', '打开方式', '打开方式', array('' => '当前窗口', '_blank' => '新窗口打开'))
                ->addFormItem('icon', 'icon', '图标', '导航图标')
                ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                ->setFormData(array('type' => 'link', 'group' => $group))
                ->setExtraHtml($this->extraHtml)
                ->display();
        }
    }

    /**
     * @param $group
     * @param $id
     */
    public function edit($group, $id){
        if(IS_POST){
            $navObj = D('Admin/Nav');
            $data   = $navObj->create();
            if($data){
                if ($navObj->save($data)) {
                    $this->success('更新成功', U('index', array('group' => $group)));
                } else {
                    $this->error('更新失败');
                }
            }else{
                $this->error($navObj->getError());
            }
        }else{
            $info = D('Admin/Nav')->find($id);
            $builder = new FormBuilder();
            $builder->setMetaTitle('编辑导航')
                ->addFormItem('id', 'hidden', 'ID', 'ID')
                ->addFormItem('group', 'hidden', '导航分组', '导航分组')
                ->addFormItem('pid', 'select', '上级导航', '上级导航', select_list_as_tree('Admin/Nav', array('group' => $group), '顶级导航'))
                ->addFormItem('title', 'text', '导航标题', '导航前台显示标题')
                ->addFormItem('type', 'radio', '导航类型', '导航类型',  D('Admin/Nav')->navType())
                ->addFormItem('url', 'text', '外链URL地址','支持http://格式或者TP的U函数解析格式', null, $info['type'] === 'link' ? '' : 'hidden')
                ->addFormItem('content', 'kindeditor', '单页内容', '单页内容', null, $info['type'] === 'page' ? '' : 'hidden')
                ->addFormItem('target', 'radio', '打开方式', '打开方式', array('' => '当前窗口', '_blank' => '新窗口打开'))
                ->addFormItem('icon', 'icon', '图标', '导航图标')
                ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                ->setFormData($info)
                ->setExtraHtml($this->extraHtml)
                ->display();
        }
    }
}