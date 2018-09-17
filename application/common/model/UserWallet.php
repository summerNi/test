<?php

namespace app\common\model;

use think\Model;

class UserWallet extends Model
{
    
    public function user()
    {
        return $this->belongsTo('user');
    }
    
    
}
