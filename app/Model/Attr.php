<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    /**
    * 与模型关联的表名
    *
    * @var string
    */
   protected $table = 'attr';//表名
   protected $primaryKey = 'aid';//id
   public $timestamps = false;//关闭自动填充时间
   protected $guarded = [];//不可批量赋值字段 
}
