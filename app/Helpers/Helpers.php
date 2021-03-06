<?php


if (!function_exists('getUserAgent')) {
    function getUserAgent()
    {
	    $user_agent = $_SERVER['HTTP_USER_AGENT'];
	    $result = '';

	    if( isset($_SERVER['HTTP_X_REST_TYPE']) ) {
		    $result = 'App';
	    } else {
		    if(stristr($user_agent,'MicroMessenger')) {
			    $result = 'Weixin';
		    }else if(stristr($user_agent,'Android')) {
			    $result = 'App';
		    }else if(stristr($user_agent,'iPhone')){
			    $result = 'App';
		    }else{
			    $result = 'Other';
		    }
	    }

	    return $result;
    }
    //$key_name上分、积分、卡卷填shangfenkey，$id,存到数据库的那条数据返回的id，$str_arr后台要什么字段这里放什么，然后unserialize一下，序列化后
    function get_memcache($key_name,$id,$str_arr)
    {
    	$mem = new Memcache;
    	if (!$mem->connect('127.0.0.1',11211)){
    		die('连接失败');
    	}
        if ($mem->get($key_name) == false){
            $mem->set($key_name, [$key_name.$id],MEMCACHE_COMPRESSED,0);
        } else {
            $arr = $mem->get($key_name);
            $arr[] = $key_name.$id;
            $mem->set($key_name, $arr,MEMCACHE_COMPRESSED,0);
        }
        $bool = $mem->set($key_name.$id,$str_arr,MEMCACHE_COMPRESSED,0);
    }

    function getimg($path)
    {
        return response()->file(storage_path().$path);
    }
}

