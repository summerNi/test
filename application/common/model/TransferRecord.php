<?php

namespace app\common\model;

use think\Model;

class TransferRecord extends Model
{
    
    public function user()
    {
        return $this->belongsTo('user');
    }
    
    public function getRecord($user_id){
        
    }
}
