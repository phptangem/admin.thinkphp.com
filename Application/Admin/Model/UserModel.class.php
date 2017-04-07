<?php
namespace Admin\Model;
use Common\Model\ModelModel;
class UserModel extends ModelModel {
    /**
     * 数据库表名
     * @var string
     */
    protected $tableName = 'admin_user';
    /**
     * 用户登录
     * @param $username
     * @param $password
     * @param null $map
     * @return mixed
     */
    public function login($username, $password, $map = null){
        $username = trim($username);

        //匹配登录方式
        if (preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $username)) {
            $map['email'] = array('eq', $username); // 邮箱登陆
        } elseif (preg_match("/^1\d{10}$/", $username)) {
            $map['mobile'] = array('eq', $username); // 手机号登陆
        } else {
            $map['username'] = array('eq', $username); // 用户名登陆
        }
        $map['status'] = array('eq', 1);
        $userInfo = $this->where($map)->find();
        if(!$userInfo){
            $this->error = '用户不存在或被禁用!';
        }else{
            if(user_md5($password) !== $userInfo['password']){
                $this->error = '密码错误！';
            }else{
                return $userInfo;
            }
        }
        return false;
    }

    /**
     * 设置登录状态
     * @param $user
     * @return int
     */
    public function autoLogin($user){
        // 记录登录SESSION和COOKIES
        $auth = array(
            'uid'       => $user['id'],
            'username'  => $user['username'],
            'nickname'  => $user['nickname'],
            'avatar'    => $user['avatar'],
        );
        session('user_auth', $auth);
        session('user_auth_sign', $this->dataAuthSign($auth));

        return $this->isLogin();
    }

    /**
     * 数据签名人证
     * @param $data
     * @return string
     */
    public function dataAuthSign($data){
        if(is_array($data)){
            $data = (array)$data;
        }
        ksort($data);
        $code = http_build_query($data);
        $sign = sha1($code);
        return $sign;
    }

    /**
     * 检测用户是否登录
     * @return int 0-未登录，大于0-当前登录用户ID
     */
    public function isLogin(){
        $user = session('user_auth');
        if(empty($user)){
            return 0;
        } else {
            if(session('user_auth_sign') == $this->dataAuthSign($user)){
                return $user['uid'];
            }
            return 0;
        }
    }
}