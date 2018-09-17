<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
    /**
     * 用户钱包关联
     * @return type
     */
    public function userWallet()
    {
        return $this->hasMany('userWallet','user_id');
    }
    /**
     * 用户钱包关联
     * @return type
     */
    public function transferRecord()
    {
        return $this->hasMany('transferRecord','user_id');
    }
    
    /**
     * 用户钱包
     */
    public function wallet($user_id){
        $user_wallet =$this->where(['id'=>$user_id])->with('userWallet')->select();
        return $user_wallet;
    }
    
    /**
     * 用户转账记录
     * @return type
     */
    public function record($user_id){
        $user_wallet =$this->where(['id'=>$user_id])->with('transferRecord')->select();
        return $user_wallet;
    }
    
    /**
     * 注册
     * @param type $data
     */
    public function register($data){
        //查询邮箱是否重复
        $user = User::where(['email'=>$data['email']])->find();
        if($user){
            $this->error = "邮箱已被注册";
            return false;
        }
        //数据入库
        $d = [
          "username" => $data['email'],
          "password" => com_password($data['password']),
          "email" => $data['email'],
          "create_time" => time(),  
        ];
        $user = new User();
        $result = $user->save($d);
        if($result){
            //注册成功自动登录
            $this->autoLogin($user->id);
            return true;
        }else{
            $this->error = "注册失败";
            return false;
        }
    }
    
    /**
     * 登陆
     * @param type $data
     * @return boolean
     */
    public function login($data){
        $user = User::where(['email'=>$data['email']])->find();
        if(!$user){
            $this->error ="用户不存在!";
            return false;
        }
        if(com_password($data['password']) != $user->password){
            $this->error = "密码错误!";
            return false;
        }
        //登陆
        $token = get_token($user->toArray());
        $user->token = $token;
        $user->save();
        session("token",$token);
        session("username",$user->username);
        return  true;
    }


    /**
     * 自动登录
     */
    public function autoLogin($user_id){
        $user = User::get($user_id);
        $token = get_token($user->toArray());
        $user->token = $token;
        $user->save();
        session("token",$token);
        session("username",$user->username);
        return  true;
    }
}
