<?php

namespace app\index\controller;

class HashTime extends Base{

    public function index() {
        $this->checkLogin();//登陆验证
        //获取用户信息
        return $this->fetch();
    }
    
}
