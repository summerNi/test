<?php
namespace app\index\controller;
use think\Validate;
class User extends Base{

    public function index() {
        return $this->fetch();
    }
    
    public function login(){
        if(request()->isPost()){
            $d = request()->post();
             $rule = [
                'email' => 'require|email',
                 'password' => "require"
            ];
            $msg = [
                'email.require' => '邮箱不能为空',
                'email.email' => "邮箱格式不正确",
                'password.require' => "密码不能为空",
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($d);
            if (!$result) {
                err($validate->getError());
                die();
            }
            $user = model("user");
            $result = $user->login($d);
            if(!$result){
                err($user->getError());
            }else{
                suc("登陆成功");
            }
        }
        return $this->fetch();
    }
    
    public function register(){
        if(request()->isPost()){
            $d = request()->post();
             $rule = [
                'email' => 'require|email',
                 'password' => "require|confirm:confirm_password"
            ];
            $msg = [
                'email.require' => '邮箱不能为空',
                'email.email' => "邮箱格式不正确",
                'password.require' => "密码不能为空",
                'password.confirm' => "两次密码不一致"
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($d);
            if (!$result) {
                err($validate->getError());
                die();
            }
            $user = model("user");
            $result = $user->register($d);
            if(!$result){
                err($user->getError());
            }else{
                suc("注册成功");
            }
        }
        return $this->fetch();
    }
    
    /**
     * 用户中心
     */
    public function userCenter(){
        $this->checkLogin();
        //查询用户登录记录
        $ip_log = db()->table("user_ip_log")->where(["user_id"=>$this->user['id']])->select();
        if($ip_log){
            foreach ($ip_log as $k=>$v){
                $ip_log[$k]['create_time'] = date("Y-m-d H:i:s",$v['create_time']);
            }
        }
        return $this->fetch('',["user"=>$this->user,'ip_log'=>$ip_log]);
    }
}
