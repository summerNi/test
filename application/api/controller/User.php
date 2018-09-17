<?php

namespace app\api\controller;
use think\Validate;
class User extends Base {

    /**
     * 用户钱包
     */
    public function userWallet() {
        $data = $_POST;
        $rule = [
            'token' => 'require',
        ];
        $msg = [
            'token.require' => 'token不能为空',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($data);
        if (!$result) {
            err($validate->getError());
        }
        $user_model = model("user");
        $user_wallet = $user_model->wallet($this->user['id']);
        suc("查询成功",$user_wallet );
    }
    
    /**
     * 交易记录
     */
    public function transferRecord(){
        $data = $_POST;
        $rule = [
            'token' => 'require',
        ];
        $msg = [
            'token.require' => 'token不能为空',
        ];
        $validate = new Validate($rule,$msg);
        $result = $validate->check($data);
        if (!$result) {
            err($validate->getError());
        }
        $user_model = model("user");
        $list = $user_model->tranferRocord($this->user['id']);
        suc("查询成功",$list );
    }
    
}
