<?php
namespace app\api\controller;
\think\Hook::listen('response_send');
use think\View;
class Base extends \think\Controller
{   
    protected $user = null;
    public function __construct() {
        parent::__construct();
        if(request()->isPost()){
            if(isset($_POST['parter']) && isset($_POST['sign'])){
                $this->checkSign();//验证参数
            }
            if(isset($_POST['token'])){
                $this->getUserInfo();
            }
            
        }
    }
    
    /**
     * 验证参数
     */
    private function checkSign(){
        $d = $_POST;
        if(!$d['parter']  || !in_array($d['parter'],[5000,5100])){
            err("错误的客户端设备号",100);
        }
        if(!$d['sign']){
            err("签名不能为空",101);
        }
        $sign = $d['sign'];
        unset($d['sign']);
        if($sign != sign($d)){
            err("签名错误",102);
        }
    }
    
    /**
     * 获取钱包
     */
    public function getRedPacket(){
        $user_id = $this->user['id'];
    }

    /**
     * 获取用户信息
     */
    private function getUserInfo(){
        $token = $_POST['token'];
        $user = model('user')->where(['token' => $token])->find();
        if(!$user){
            err("请先登录!",103); 
        }else{
            $this->user = $user;
        }
    }
}
