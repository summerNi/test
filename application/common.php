<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 错误返回
 */
function err($msg="",$code=0){
    $data = [
      "code" => $code,
      "msg" => $msg,
      "data" => []
    ];
    echo json_encode($data);
    exit();
}

/**
 * 成功返回
 * @param type $data
 */
function suc($msg="操作成功",$d=[]){
     $data = [
      "code" => 200,
      "msg" => $msg,
      "data" => $d
    ];
    echo json_encode($data);
    exit();
}
/**
 * 签名
 */
function sign($data){
    $parter_config = [
        5000 => "e7671a9fdd6bbd21203169580bc3f0be" 
    ];
    foreach ($data as $k=>$v){
        if(!$v){
            unset($data[$k]);
        }
    }
    $data['key'] = $parter_config[$data['parter']];
    $data = asort($data);
    $sign_str = json_encode($data);
    $sign = md5($sign_str);
    return strtoupper($sign);
}

function com_password($str){
    return md5(md5($str));
}

function get_token($user){
    if(!$user){
        return false;
    }
    $token_str =  $user['username'].date("Y-m-d H:i:s", time());
    $token = sha1(md5($token_str));
    return $token;
}

function com_sql(){
    
}