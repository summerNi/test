<?php

namespace app\common\model;

use think\Model;

class Admin extends Model
{
     protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
}
