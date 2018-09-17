<?php

namespace app\index\controller;

class Recharge extends Base{

    public function index() {
        $this->checkLogin();
        return $this->fetch();
    }
    

}
