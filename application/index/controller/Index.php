<?php

namespace app\index\controller;

class Index extends Base{

    public function index() {
        return $this->fetch();
    }
    
    /**
     * 注销
     */
    public function logout(){
        session("token",null);
        session("username",null);
        $this->success("退出成功", url('index'));
    }

    /**
     * 获取签名
     */
    public function getSign(){
        $d = $_POST;
        $sign = sign($d);
        suc("测试哦", ['sign'=>$sign]);
    }

}
