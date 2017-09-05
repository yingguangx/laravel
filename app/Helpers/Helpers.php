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
}

