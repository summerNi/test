<?php
namespace app\index\controller;

class Base extends \think\Controller
{
    protected $user;
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 验证登陆
     */
    public function  checkLogin(){
        $token = session("token");
        if(!$token){
            $this->error("请先登陆", url("Index/index"));
        }
        $user = db()->table("user")->where(["token"=>$token])->find();
        if(!$user){
            session("token",NULL);
            session("username",NULL);
            $this->error("请先登陆",url("Index/index"));
        }
        $this->user = $user;
        $this->assign("user",$user);
        return true;
    }
    
}
