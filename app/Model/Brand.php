<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';//表名
    protected $primaryKey = 'id';//id
    public $timestamps = false;//关闭自动填充时间
    protected $guarded = [];//不可批量赋值字段 
}
