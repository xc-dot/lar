<?php
//文件上传
  function upload($name){
        if ( request()->file($name)->isValid()) {
            $photo = request()->file($name);
            //$extension = $photo->extension();
            //$store_result = $photo->store('photo');
            $store_result = $photo->store('', 'public');
            return $store_result;
        }
            exit('未获取到上传文件或上传过程出错');
    }

 //递归
 function createTree($data,$parent_id=0,$level=1)
{
	//定义一个容器（新数组）
	static $new_arr = array();
	//遍历数据一条条比对
	foreach ($data as $v){
		//找parent_id = 0
		if($v->parent_id==$parent_id){
			//增加级别字段
			$v->level = $level;
			//找到之后放到新数组里
			$new_arr[] = $v;
			//调用程序自身递归找子集
			createTree($data,$v->cid,$level+1);
		}
	}
  
   return $new_arr;
}



?>