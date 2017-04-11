<?php
namespace Admin\Model;
use Think\Model;
class UploadModel extends Model {
    /**
     * 数据库表明
     * @var string
     */
    protected $tableName = 'admin_upload';

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
}