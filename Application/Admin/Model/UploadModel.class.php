<?php
namespace Admin\Model;
use Common\Model\ModelModel;
use Think\Upload;

class UploadModel extends ModelModel {
    /**
     * 数据库表明
     * @var string
     */
    protected $tableName = 'admin_upload';

    /**
     * 自动验证规则
     * @var array
     */
    protected $_validate = array(
        array('name', 'require', '文件名不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('path', 'require', '文件不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('size', 'require', '文件大小不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('md5', 'require', '文件Md5编码不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('sha1', 'require', '文件Sha1编码不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     * @var array
     */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );
    protected function _after_find(&$result, $options){
        // 获取上传文件的地址
        if($result['url']){
            $result['real_path'] = $result['url'];
        } else {
            if( C('STATIC_DOMAIN')){
                $result['real_path'] = C('STATIC_DOMAIN') . $result['path'];
            } else {
                if (C('IS_API')){
                    $result['real_path'] = C('TOP_HOME_PAGE') . $result['path'];
                }else{
                    $result['real_path'] = __ROOT__ . $result['path'];
                }
            }
        }
        if(in_array($result['ext'], array('jpg', 'jpeg', 'png', 'gif', 'bmp'))){
            $result['show'] = '<img class="picture" src="' . $result['real_path'] . '">';
        } else {
            $result['show'] = '<i class="fa fa-file-' . $result['ext'] . '"></i>';
        }
    }

    /**
     * 获取上传图片路径
     * @param null $id
     * @param null $type
     * @return null|string
     */
    public function getCover($id = null, $type = null){
        if($id){
            if(strpos($id, 'http') === 0){
                return $id;
            }

            $uploadInfo = $this->find($id);
            $url        = $uploadInfo['real_path'];
        }
        if(! isset($url)){
            switch ($type){
                case 'default'://默认图片
                    $url = C('TMPL_PARSE_STRING.__HOME_IMG__') . '/default/default.gif';
                    break;
                case 'avatar'://默认图片
                    $url = C('TMPL_PARSE_STRING.__HOME_IMG__') . '/default/avatar.png';
                    break;
                case 'qr_code'://默认图片
                    $url = C('TMPL_PARSE_STRING.__HOME_IMG__') . '/default/qr_code.png';
                    break;
                case 'qr_ios'://默认图片
                    $url = C('TMPL_PARSE_STRING.__HOME_IMG__') . '/default/qr_ios.png';
                    break;
                case 'qr_android'://默认图片
                    $url = C('TMPL_PARSE_STRING.__HOME_IMG__') . '/default/qr_android.png';
                    break;
                case 'qr_weixin'://默认图片
                    $url = C('TMPL_PARSE_STRING.__HOME_IMG__') . '/default/qr_weixin.png';
                    break;
                default:
                    $url = '';
                    break;
            }
        }

        return $url;
    }

    public function upload($files = null){
        // 获取文件信息
        $_FILES = $files ? $files : $_FILES;

        // 返回标准数据
        $ret    = array('error' => 0, 'success' => 1, 'status' => 1);
        $dir    = I('request.dir') ? : 'image'; // 上传文件类型image、flash、media、file
        if(! in_array($dir, array('image', 'flash', 'media', 'file'))){
            return $this->getReturn(1, 0, 0, '缺少文件类型参数');
        }

        // 上传文件钩子，用于七牛云、又拍云等第三方文件上传的扩展
//        hook('UploadFile', $dir);

        // 根据上传类型改变上传大小限制
        $uploadConfig = C('UPLOAD_CONFIG');
        if(I('get.temp') === 'true'){
            $uploadConfig['rootPath'] = './Runtime/';
        }
        $uploadDriver = C('UPLOAD_DRIVER');
        if(! $uploadDriver){
            return $this->getReturn(1, 0, 0, '无效的文件上传驱动');
        }

        // 友情提醒
        $uploadMaxFileSize = substr(ini_get('upload_max_filesize'), 0,-1);
        $postMaxSize       = substr(ini_get('post_max_size'), 0, -1);
        if($postMaxSize < $uploadMaxFileSize){
            return $this->getReturn(1, 0, 0, '警告：php.ini里post_max_size值应该设置比upload_max_filesize大');
        }

        if($dir == 'image'){
            if(C('UPLOAD_IMAGE_SIZE')){
                if(C('UPLOAD_IMAGE_SIZE') > $uploadMaxFileSize){
                    return $this->getReturn(1, 0, 0, '警告：php.ini里upload_max_filesize值小于系统后台设置的文件上传大小');
                }
                $uploadConfig['maxSize'] = C('UPLOAD_IMAGE_SIZE') * 1024 * 1024; // 图片的上传大小限制
            }
        } else {
            if(C('UPLOAD_FILE_SIZE')){
                if(C('UPLOAD_FILE_SIZE') > $uploadMaxFileSize){
                    return  $this->getReturn(1, 0, 0, '警告：php.ini里upload_max_filesize值小于系统后台设置的文件上传大小');
                }
                $uploadConfig['maxSize'] = C('UPLOAD_FILE_SIZE') * 1024 * 1024; // 普通文件上传大小限制
            }
        }

        // 上传扩展配置
        $extensionAllow = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb', 'mp4'),
            'file'  => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'wps', 'txt', 'zip', 'rar', 'gz', 'bz2', '7z', 'ipa', 'apk', 'dmg', 'iso'),
        );
        // 计算文件散列以查看是否已有相同文件上传过
        $fileInfo =array_shift($_FILES);
        $where['md5']   = md5_file($fileInfo['tmp_name']);
        $where['sha1']  = sha1_file($fileInfo['tmp_name']);
        $where['size']  = $fileInfo['size'];
        $uploadObj = $this->where($where)->find();
        if( $uploadObj){
            // 发现相同文件直接返回
            $ret['id']   = $uploadObj['id'];
            $ret['name'] = $uploadObj['name'];
            $ret['url']  = $uploadObj['real_path'];
            $ret['path'] = '.' . $uploadObj['path'];
        } else {
            // 上传文件
            $uploadConfig['removeTrash'] = array($this, 'removeTrash');
            $upload                      = new Upload($uploadConfig, $uploadDriver, C("UPLOAD_" . $uploadDriver . "_CONFIG")); // 实力化上传类
            $upload->exts                = $extensionAllow[$dir] ? $extensionAllow[$dir] : $extensionAllow['image']; // 设置附件上传允许的类型
            $uploadedFileInfo            = $upload->uploadOne($fileInfo); // 上传文件
            if(! $uploadedFileInfo){
                return $this->getReturn(1 , 0, 0, "上传出错" . $uploadedFileInfo->getError());
            } else {
                // 获取上传数据
                if(I('get.temp') === 'true'){
                    // 返回数据
                    if ($uploadedFileInfo["url"]) {
                        $ret['url'] = $uploadedFileInfo['url'];
                    } else {
                        $ret['url'] = __ROOT__ . $uploadedFileInfo['path'];
                    }
                    $ret['path'] = '.' . $uploadedFileInfo['path'];
                    $ret['name'] = $uploadedFileInfo['name'];

                } else {
                    $data['type']     = $uploadedFileInfo["type"];
                    $data['name']     = $uploadedFileInfo["name"];
                    $data['path']     = '/Uploads/' . $uploadedFileInfo['savepath'] . $uploadedFileInfo['savename'];
                    $data['url']      = $uploadedFileInfo["url"] ?: '';
                    $data['ext']      = $uploadedFileInfo["ext"];
                    $data['size']     = $uploadedFileInfo["size"];
                    $data['md5']      = $uploadedFileInfo['md5'];
                    $data['sha1']     = $uploadedFileInfo['sha1'];
                    $data['location'] = $uploadDriver;
                    // 返回数据
                    $ret = $this->create($data);
                    $id  = $this->add($ret);
                    if($id){
                        if($uploadedFileInfo['url']){
                            $ret['url'] = $data['url'];
                        }else{
                            $ret['url'] = __ROOT__ . $data['path'];
                        }
                        $ret['path'] = '.' . $uploadedFileInfo['path'];
                        $ret['name'] = $uploadedFileInfo['name'];
                        $ret['id']   = $id;
                    }else{
                        return $this->getReturn(1, 0, 0, '上传出错' . $this->error);
                    }
                }
            }
        }

        return $ret;
    }

    /**
     * @param $error
     * @param $success
     * @param $status
     * @param string $message
     */
    private function getReturn($error, $success, $status, $message = ''){
        $ret['error']       = $error;
        $ret['success']     = $success;
        $ret['status']      = $status;
        $ret['message']     = $message;
        return $ret;
    }
}