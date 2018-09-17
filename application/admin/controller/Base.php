<?php
namespace app\admin\controller;
use think\View;
class Base extends \think\Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 登录验证
     */
    private function isLogin(){
        $token = session("token");
    }
}
