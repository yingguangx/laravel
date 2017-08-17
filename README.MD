# laravel
## 开发配置
 - laravel 开发工具
 - 需要配置vue.js
 - 熟悉vue.js 
 - 微信sdk使用easywechat 
 - 微信sdk使用方式参观文档<a href="https://easywechat.org/">easywechat</a>
 - example 微信授权:
        <p>
                $wechat = new \EasyWeChat\Foundation\Application(config('wechat'));
         	    $oauth = $wechat->oauth;
         	    
         	    if (empty($_SESSION['wechat_user'])) {
         		    $_SESSION['target_url'] = 'user/profile';
         		    return $oauth->redirect();
         	    }
         	    $user = $_SESSION['wechat_user'];
        </p>
 
 

