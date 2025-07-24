<?php
class baiduseo_zz{
    public function init(){
        if(is_admin()){
            global $wpdb;
            $charset_collate = '';
            if (!empty($wpdb->charset)) {
              $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
            }
            if (!empty( $wpdb->collate)) {
              $charset_collate .= " COLLATE {$wpdb->collate}";
            }
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_zz'") !=  $wpdb->prefix."baiduseo_zz"){
                $sql15 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_zz   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    link varchar(255) NOT NULL ,
                    ts bigint NOT NULL DEFAULT 1,
                    type bigint NOT NULL DEFAULT 1,
                    message varchar(255) default NULL,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                /*ts:1成功2，失败,type:1百度普通，2百度快速，3bing,4神马,5indexnow（7.bing,8.Seznam.cz,9.Yandex,10.Naver,11.Yep）,6谷歌*/
                dbDelta($sql15);
            }
            //友链互换
            if($wpdb->get_var("show tables like '{$wpdb->prefix}wztkj_friends'") !=  $wpdb->prefix."wztkj_friends"){
                $sql4 = "CREATE TABLE " . $wpdb->prefix . "wztkj_friends (
                    id bigint NOT NULL AUTO_INCREMENT,
                    link varchar(255) NOT NULL ,
                    keywords varchar(255) NOT NULL ,
                    time timestamp default CURRENT_TIMESTAMP,
                    status1 tinyint default 0,
                    status2 tinyint default 0,
                    status3 tinyint default 0,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql4);
            }
            //公告
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_gonggao'") !=  $wpdb->prefix."baiduseo_gonggao"){
                $sql4 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_gonggao (
                    id bigint NOT NULL AUTO_INCREMENT,
                    gid bigint default 0,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql4);
            }
             
        }
    }
     public static function indexnow($urls,$id=0,$tag_id=0,$type=5){
         global $wpdb;
         $baiduseo_indexnow_record = get_option('baiduseo_indexnow_record');
         $baiduseo_zz = get_option('baiduseo_zz');
          $currnetTime= current_time( 'Y/m/d H:i:s');
         $data = array(
            'host' =>baiduseo_common::baiduseo_url(2) ,
            'key' => $baiduseo_zz['indexnow_key'],
            'keyLocation' => get_home_url() . '/' . $baiduseo_zz['indexnow_key'] . '.txt',
            'urlList' => $urls
        );
       
       switch ($type) {
            case 5:
                $re = wp_remote_post('https://api.indexnow.org/indexnow', array(
                    'body' => json_encode($data),
                    'sslverify' => false,
                    'timeout' => 40000,
                    'headers' => array(
                        'Host' => 'api.indexnow.org',
                        'Content-Type' => 'application/json; charset=utf-8'
                    )
                ));
                
                if(!is_wp_error($re)){
                    if(isset($baiduseo_zz['indexNow_log_show']) && $baiduseo_zz['indexNow_log_show']){
                        if(isset($re['response']['code']) && $re['response']['code']>202){
                            
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>5,'message'=>'请求过多']);
                                }
                            
                        }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                            foreach($urls as $k=>$v){
                            $res = $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$v,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                           
                        }
                    }
                     if($baiduseo_indexnow_record!==false){
                        if($id){
                            $baiduseo_indexnow_record['id'] = $id;
                        }
                        if($tag_id){
                            $baiduseo_indexnow_record['tag_id'] = $tag_id;
                        }
                        $baiduseo_indexnow_record['num'] = $baiduseo_indexnow_record['num']+count($urls);
                        update_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                    }else{
                        $baiduseo_indexnow_record = [];
                         if($id){
                            $baiduseo_indexnow_record['id'] = $id;
                        }
                        if($tag_id){
                            $baiduseo_indexnow_record['tag_id'] = $tag_id;
                        }
                        $baiduseo_indexnow_record['num'] = count($urls);
                        add_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                    }
                }
                       
                    
                // 当表达式的值等于值1时执行的代码
                break;
            case 6:
                  $re = wp_remote_post('https://www.bing.com/indexnow', array(
                        'body' => json_encode($data),
                        'sslverify' => false,
                        'timeout' => 4000,
                        'headers' => array(
                            'Host' => 'www.bing.com',
                            'Content-Type' => 'application/json; charset=utf-8'
                        )
                    ));
                  
                    if(!is_wp_error($re)){
                        if(isset($baiduseo_zz['indexNow_bing_log']) && $baiduseo_zz['indexNow_bing_log']){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>7,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>7,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>7,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>7,'message'=>'请求过多']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                foreach($urls as $k=>$v){
                                $res = $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$v,'ts'=>1,'type'=>7,'message'=>'']);
                                }
                            }
                        }
                        if($baiduseo_indexnow_record!==false){
                            if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = $baiduseo_indexnow_record['num']+count($urls);
                            update_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }else{
                            $baiduseo_indexnow_record = [];
                             if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = count($urls);
                            add_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }
                    }
                // 当表达式的值等于值2时执行的代码
                break;
            case 7:
                $re = wp_remote_get('https://search.seznam.cz/indexnow?url='.$urls[0].'&key='.$baiduseo_zz['indexnow_key']);
                      
                
                if(!is_wp_error($re)){
                    if(isset($baiduseo_zz['seznam_log_show']) && $baiduseo_zz['seznam_log_show']){
                        if(isset($re['response']['code']) && $re['response']['code']>202){
                            
                            if($re['response']['code']=='400'){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>8,'message'=>'无效的格式']);
                            }elseif($re['response']['code']=='403'){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>8,'message'=>'根目录没有密钥文件']);
                            }elseif($re['response']['code']=='422'){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>8,'message'=>'URL与密钥不匹配']);
                            }elseif($re['response']['code']=='429'){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>8,'message'=>'请求过多']);
                            }
                        }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                             foreach($urls as $k=>$v){
                            $res = $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$v,'ts'=>1,'type'=>8,'message'=>'']);
                            }
                        }
                    }
                    if($baiduseo_indexnow_record!==false){
                            if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = $baiduseo_indexnow_record['num']+count($urls);
                            update_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }else{
                            $baiduseo_indexnow_record = [];
                             if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = count($urls);
                            add_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }
                }
                // 当表达式的值等于值3时执行的代码
                break;
             case 8:
                  $re = wp_remote_post('https://yandex.com/indexnow', array(
                        'body' => json_encode($data),
                        'sslverify' => false,
                        'timeout' => 4000,
                        'headers' => array(
                            'Host' => 'yandex.com',
                            'Content-Type' => 'application/json; charset=utf-8'
                        )
                    ));
                    if(!is_wp_error($re)){
                        if(isset($baiduseo_zz['yandex_log_show']) && $baiduseo_zz['yandex_log_show']){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>9,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>9,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>9,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>9,'message'=>'请求过多']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                 foreach($urls as $k=>$v){
                                    $res = $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$v,'ts'=>1,'type'=>9,'message'=>'']);
                                    }
                            }
                        }
                        if($baiduseo_indexnow_record!==false){
                            if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = $baiduseo_indexnow_record['num']+count($urls);
                            update_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }else{
                            $baiduseo_indexnow_record = [];
                             if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = count($urls);
                            add_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }
                    }
                // 当表达式的值等于值3时执行的代码
                break;
             case 9:
                    $re = wp_remote_post('https://searchadvisor.naver.com/indexnow', array(
                        'body' => json_encode($data),
                        'sslverify' => false,
                        'timeout' => 40000,
                        'headers' => array(
                            'Host' => 'searchadvisor.naver.com',
                            'Content-Type' => 'application/json; charset=utf-8'
                        )
                    ));
                    if(!is_wp_error($re)){
                        if(isset($baiduseo_zz['naver_log_show']) && $baiduseo_zz['naver_log_show']){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>10,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>10,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>10,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>10,'message'=>'请求过多']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                 foreach($urls as $k=>$v){
                            $res = $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$v,'ts'=>1,'type'=>10,'message'=>'']);
                            }
                            }
                        }
                        if($baiduseo_indexnow_record!==false){
                            if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = $baiduseo_indexnow_record['num']+count($urls);
                            update_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }else{
                            $baiduseo_indexnow_record = [];
                             if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = count($urls);
                            add_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }
                    }
                // 当表达式的值等于值3时执行的代码
                break;
            case 10:
                $re = wp_remote_post('https://indexnow.yep.com/indexnow', array(
                        'body' => json_encode($data),
                        'sslverify' => false,
                        'timeout' => 40000,
                        'headers' => array(
                            'Host' => 'indexnow.yep.com',
                            'Content-Type' => 'application/json; charset=utf-8'
                        )
                    ));
                    if(!is_wp_error($re)){
                        if(isset($baiduseo_zz['yep_log_show']) && $baiduseo_zz['yep_log_show']){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>11,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>11,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>11,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url[0],'ts'=>2,'type'=>11,'message'=>'请求过多']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                 foreach($urls as $k=>$v){
                            $res = $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$v,'ts'=>1,'type'=>11,'message'=>'']);
                            }
                            }
                        }
                        if($baiduseo_indexnow_record!==false){
                            if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = $baiduseo_indexnow_record['num']+count($urls);
                            update_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }else{
                            $baiduseo_indexnow_record = [];
                             if($id){
                                $baiduseo_indexnow_record['id'] = $id;
                            }
                            if($tag_id){
                                $baiduseo_indexnow_record['tag_id'] = $tag_id;
                            }
                            $baiduseo_indexnow_record['num'] = count($urls);
                            add_option('baiduseo_indexnow_record',$baiduseo_indexnow_record);
                        }
                    }
                // 当表达式的值等于值3时执行的代码
                break;
            default:
                // 当表达式的值与上面所有case都不匹配时执行的代码
        }
                         
     }
    public static function bdts($urls,$id=0,$tag_id=0){
        global $wpdb;
        
        $baidu = get_option('baiduseo_zz');
        $currnetTime= current_time( 'Y-m-d H:i:s');
        if($baidu['zz_link']){
            
            $result = wp_remote_post(str_replace('&#038;','&',$baidu['zz_link']),['body'=>implode("\n", $urls)]);
            
            
            if(is_wp_error($result)){
                
            }else{
                $result = wp_remote_retrieve_body($result);
                $res = json_decode($result,true);
                
                if(isset($res['error'])){
                    if($res['message']=='over quota'){
                        if(isset($baidu['bd_log']) && $baidu['bd_log']){
                            foreach($urls as $key=>$val){
                                
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'超过每日配额了']);
                                $baiduseo_bd_chao = get_option('baiduseo_bd_chao');
                                 $today = date_i18n('Y-m-d', current_time('timestamp'));
                                if($baiduseo_bd_chao===false){
                                    add_option('baiduseo_bd_chao', $today);
                                }else{
                                    update_option('baiduseo_bd_chao', $today);
                                }
                                break;
                            }
                        }
                    }elseif($res['message']=='site error'){
                       if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'站点未在站长平台验证']);
                            break;
                        }
                        }
                    }elseif($res['message']=='only 2000 urls are allowed once'){
                        if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'每次最多只能提交2000条链接']);
                            break;
                        }
                        }
                    }elseif($res['message']=='token is not valid'){
                        if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'token错误']);
                            break;
                        }
                        }
                    }elseif($res['message']=='token is not valid'){
                         if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'接口地址填写错误']);
                            break;
                        }
                        }
                    }elseif($res['message']=='internal error, please try later'){
                       if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'服务器偶然异常']);
                            break;
                        }
                        }
                    }
                }elseif(isset($res['success'])){
                    if(isset($res['not_same_site'])){
                        if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'百度推送设置的地址与wordpress设置中的常规设置的链接不匹配']);
                            break;
                        }
                        }
                    }
                    if(isset($res['not_valid'])){
                        if(isset($baidu['bd_log']) && $baidu['bd_log']){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>1,'message'=>'百度推送设置的地址与wordpress设置中的常规设置的链接不匹配']);
                            break;
                        }
                        }
                    }
                    
                    if(isset($res['success'])){
                       if(isset($baidu['bd_log']) && $baidu['bd_log']){
                            foreach($urls as $key=>$val){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>1,'message'=>'']);
                            }
                        }
                        $baiduseo_zz_record = get_option('baiduseo_zz_record');
                        if($baiduseo_zz_record!==false){
                            $data = $baiduseo_zz_record;
                            $data['num'] = $baiduseo_zz_record['num']+$res['success'];
                            if($id){
                                $data['id'] = $id;
                            }
                            if($tag_id){
                                $data['tag_id'] = $tag_id;
                            }
                            $data['remind'] = $res['remain'];
                            $data['time'] = $currnetTime;
                            update_option('baiduseo_zz_record',$data);
                        }else{
                            $data['num'] = $res['success'];
                            if($id){
                                $data['id'] = $id;
                            }
                            if($tag_id){
                                $data['tag_id'] = $tag_id;
                            }
                            $data['time'] =  $currnetTime;
                            $data['remind'] = $res['remain'];
                            add_option('baiduseo_zz_record',$data);
                        }
                    }
                }
            }
        }
        
    }
    public static function bddayts($urls,$id=0){
        global $wpdb;
        $baidu = get_option('baiduseo_zz');
        
        $currnetTime= current_time( 'Y-m-d H:i:s');
        if($baidu['zz_link']){
            $api = str_replace('&#038;','&',$baidu['zz_link'])."&type=daily";
        //  var_dump($api);exit;
            $result = wp_remote_post($api,['body'=>implode("\n", $urls)]);
            if(is_wp_error($result)){
               
            }else{
                $result = wp_remote_retrieve_body($result);
                $res = json_decode($result,true);
                if(isset($res['error'])){
                    
                }else{
                    if(isset($res['not_same_site'])){
                        if(isset($baidu['log']) && strpos($baidu['log'],'2')!==false){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>2,'message'=>'百度推送设置的地址与wordpress设置中的常规设置的链接不匹配']);
                            break;
                        }
                        }
                    }
                    if(isset($res['not_valid'])){
                        if(isset($baidu['log']) && strpos($baidu['log'],'2')!==false){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>2,'message'=>'百度推送设置的地址与wordpress设置中的常规设置的链接不匹配']);
                            break;
                        }
                        }
                    }
                    if(isset($res['success'])){
                        
                       if(isset($baidu['log']) && strpos($baidu['log'],'2')!==false){
                            foreach($urls as $key=>$val){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>2,'message'=>'']);
                            }
                        }
                        
                        $baiduseo_day_record = get_option('baiduseo_day_record');
                        if($baiduseo_day_record!==false){
                            $data = $baiduseo_day_record;
                            $data['num'] = $baiduseo_day_record['num']+$res['success'];
                            if($id){
                                $data['id'] = $id;
                            }
                            if($tag_id){
                                $data['tag_id'] = $tag_id;
                            }
                           
                            $data['time'] = $currnetTime;
                            $data['remind'] = $res['remain'];
                            update_option('baiduseo_day_record',$data);
                        }else{
                            $data['num'] = $res['success'];
                            if($id){
                                $data['id'] = $id;
                            }
                            if($tag_id){
                                $data['tag_id'] = $tag_id;
                            }
                            $data['time'] =  $currnetTime;
                            $data['remind'] = $res['remain'];
                            add_option('baiduseo_day_record',$data);
                        }
                    }
                    
                }
            }
        }
    }
    public static function bddayts1($urls,$id=0){
        global $wpdb;
        $baidu = get_option('baiduseo_zz');
        $currnetTime= current_time( 'Y-m-d H:i:s');
        if($baidu['zz_link']){
            $api = str_replace('&#038;','&',$baidu['zz_link'])."&type=daily";
        //  var_dump($api);exit;
            $result = wp_remote_post($api,['body'=>implode("\n", $urls)]);
            if(is_wp_error($result)){
               echo json_encode(['msg'=>0,'data'=>'推送失败']);exit;
            }else{
                $result = wp_remote_retrieve_body($result);
                $res = json_decode($result,true);
                if(isset($res['error'])){
                    if($res['error']=='site error'){
                        echo json_encode(['msg'=>0,'data'=>'推送失败，站点未在站长平台验证']);exit;
                    }elseif($res['error']=='over quota'){
                        echo json_encode(['msg'=>0,'data'=>'推送失败,配额不足']);exit;
                    }elseif($res['error']=='token is not valid'){
                        echo json_encode(['msg'=>0,'data'=>'推送失败,token错误']);exit;
                    }elseif($res['error']=='not found'){
                        echo json_encode(['msg'=>0,'data'=>'接口地址填写错误']);exit;
                    }elseif($res['error']=='internal error, please try later'){
                        echo json_encode(['msg'=>0,'data'=>'服务器偶然异常']);exit;
                    }
                }else{
                    if(isset($res['not_same_site'])){
                        if(isset($baidu['log']) && strpos($baidu['log'],'2')!==false){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>2,'message'=>'百度推送设置的地址与wordpress设置中的常规设置的链接不匹配']);
                            break;
                        }
                        }
                        echo json_encode(['msg'=>0,'data'=>'推送失败，百度推送链接不正确']);exit;
                    }
                    if(isset($res['not_valid'])){
                       if(isset($baidu['log']) && strpos($baidu['log'],'2')!==false){
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>2,'message'=>'百度推送设置的地址与wordpress设置中的常规设置的链接不匹配']);
                            break;
                        }
                        }
                       echo json_encode(['msg'=>0,'data'=>'推送失败，百度推送链接不正确']);exit;
                    }
                    if(isset($res['success'])){
                        
                       if(isset($baidu['log']) && strpos($baidu['log'],'2')!==false){
                            foreach($urls as $key=>$val){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>2,'message'=>'']);
                            }
                        }
                        
                        $baiduseo_day_record = get_option('baiduseo_day_record');
                        if($baiduseo_day_record!==false){
                            $data = $baiduseo_day_record;
                            $data['num'] = $baiduseo_day_record['num']+$res['success'];
                            if($id){
                                $data['id'] = $id;
                            }
                            if($tag_id){
                                $data['tag_id'] = $tag_id;
                            }
                           
                            $data['time'] = $currnetTime;
                            $data['remind'] = $res['remain'];
                            update_option('baiduseo_day_record',$data);
                        }else{
                            $data['num'] = $res['success'];
                            if($id){
                                $data['id'] = $id;
                            }
                            if($tag_id){
                                $data['tag_id'] = $tag_id;
                            }
                            $data['time'] =  $currnetTime;
                            $data['remind'] = $res['remain'];
                            add_option('baiduseo_day_record',$data);
                        }
                        echo json_encode(['msg'=>1,'data'=>'推送成功']);exit;
                    }
                    
                }
            }
        }
    }
    public static function baiduseo_sanitizing_date($key){
        if (strlen($key) !== 104) {
            return false;
        }
    
        // 提取各部分
        $a = substr($key, 32, 4);
        $b = substr($key, 68, 2);
        $c = substr($key, 102, 2);
       
        $today = date_i18n('Ymd', current_time('timestamp'));
        $num = $a.$b.$c;
        if((int)$num>(int)$today){
            return $key;
        }
        return 0;
    }
    public static function pay_money(){
        $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
        if(!$baiduseo_wzt_log){
            return 0;
        }
        return baiduseo_seo::pay_money();
    }
    public static  function google($urls,$id=0,$tag_id=0){
        global $wpdb;
        $currnetTime= current_time( 'Y-m-d H:i:s');
        $baidu = get_option('baiduseo_zz');
        $url ='https://indexing.googleapis.com/v3/urlNotifications:publish';
        $token = baiduseo_zz::google_token();
        
        if(!$token){
           
            return false;
        }
        $body = [
            'timeout'=>1000,
            'sslverify'=>false,
            'headers' =>[
                'content-type' => 'application/json',
                'authorization' => 'Bearer '.$token,
            ],
            'body'=>json_encode(['url'=>$urls,'type'=>'URL_UPDATED'])
        ];
        $result = wp_remote_post($url,$body);
        
        if(is_wp_error($result)){
           return false;
        }else{
            $result = wp_remote_retrieve_body($result);
            
            $res = json_decode($result,true);
            $currnetTime= current_time( 'Y-m-d H:i:s');
            $data1 = [];
            if(isset($res['urlNotificationMetadata'])){
                 $baiduseo_google_record = get_option('baiduseo_google_record');
                 if($baiduseo_google_record!==false){
                            
                            $data1['num'] = $baiduseo_google_record['num']+1;
                           
                            $data1['time'] = $currnetTime;
                            update_option('baiduseo_google_record',$data1);
                }else{
                    $data1['time'] = $currnetTime;
                    $data1['num'] =1;
                    add_option('baiduseo_google_record',$data1);
                }
                if(isset($baidu['guge_log_show']) && $baidu['guge_log_show']){
                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$data['url'],'ts'=>1,'type'=>6,'message'=>'']);
                }
            }else{
                return false;
            }
         
            
        }
        
    }
    public static function google_token(){
          $param = [
            'timeout'=>5,
            'sslverify'=>false,
            'body'=>[
                'grant_type'=>'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => baiduseo_zz::google_auth(),
            ]
        ];
        //$api_host = 'oauth2.googleapis.com';
        $api_host = 'oauth2.googleapis.picpapa.com';
        $auth_api = 'https://'.$api_host.'/token';
        $http = wp_remote_post($auth_api,$param);
       
        if(is_wp_error($http)){
            return 0;
        }else{
             $result = wp_remote_retrieve_body($http);
             $result = json_decode($result,true);
             if(isset($result['access_token'])){
                return $result['access_token'];
             }else{
                return 0;
             }
        }
    }
    public static function google_auth(){
        $baiduseo_zz = get_option('baiduseo_zz');
        if(isset($baiduseo_zz['google_api']) && $baiduseo_zz['google_api']){
            $key = json_decode($baiduseo_zz['google_api'],true);
            // var_dump($key);exit;
            if(isset($key['client_email'])){
                $config  = [
                    'iss' => $key['client_email'],
                    'exp' => time() + 3600,
                    'iat' => time() - 60,
                    'aud' => 'https://oauth2.googleapis.com/token',
                    'scope' => 'https://www.googleapis.com/auth/indexing https://www.googleapis.com/auth/webmasters.readonly',
                ];
                $header = array('typ' => 'JWT', 'alg' =>'RS256');
                $segments = array();
                $segments[] = baiduseo_zz::google_code(json_encode($header));
                $segments[] = baiduseo_zz::google_code(json_encode($config));
                $signing_input = implode('.', $segments);
                $signature = baiduseo_zz::google_sign($signing_input, $key['private_key']);
                $segments[] = baiduseo_zz::google_code($signature);
                return implode('.', $segments);
            }
        }
    }
     public static  function google_code($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
    public static function google_sign($msg, $key){
        $signature = '';
        
        $success = openssl_sign($msg, $signature, $key, 'SHA256');
        if(!$success){
           return 0;
        }
        return $signature;
    }
    public static function sm($urls){
         global $wpdb;
        $baidu = get_option('baiduseo_zz');
        $currnetTime= current_time( 'Y-m-d H:i:s');
        $baiduseo_sm_record = get_option('baiduseo_sm_record');
        $result = wp_remote_post(str_replace('&#038;','&',$baidu['shenma_key']),['body'=>implode("\n", $urls)]);
        $content = wp_remote_retrieve_body($result);
         $res = json_decode($content,true);
        if($res['returnCode']=='200'){
             if(isset($baidu['log']) && strpos($baidu['log'],'4')!==false){
                foreach($urls as $key=>$val){
	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>4,'message'=>'']);
	            }
            }
            if($baiduseo_sm_record!==false){
                $data = $baiduseo_sm_record;
                $data['num'] = $baiduseo_sm_record['num']+1;
                $data['time'] = $currnetTime;
                update_option('baiduseo_sm_record',$data);
            }else{
                $data['num'] = 1;
                $data['time'] =  $currnetTime;
                
                add_option('baiduseo_sm_record',$data);
            }
        }else{
            if(isset($baidu['log']) && strpos($baidu['log'],'4')!==false){
                if($res['returnCode']==201){
                    foreach($urls as $key=>$val){
    	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'token不合法']);
    	                break;
    	            }
                }elseif($res['returnCode']==202){
                    foreach($urls as $key=>$val){
    	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'当日流量已用完']);
    	                break;
    	            }
                }elseif($res['returnCode']==400){
                    foreach($urls as $key=>$val){
    	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'请求参数错误']);
    	                break;
    	            }
                }elseif($res['returnCode']==400){
                    foreach($urls as $key=>$val){
    	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'服务器错误']);
    	                break;
    	            }
                }
    	            
            
            }   
        }
    }
    public static function bing($urls){
         global $wpdb;
        
        $baidu = get_option('baiduseo_zz');
        $baiduseo_cron = new baiduseo_cron();
        if(!isset($baidu['bing_key']) || !$baidu['bing_key']  ){
            return;
        }else{
            $num =  $baiduseo_cron->baiduseo_quota($baidu['bing_key']);
        }
        if($num>1){
            $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
            $api = 'https://www.bing.com/webmaster/api.svc/json/SubmitUrlbatch?apikey='.$baidu['bing_key'];
            if(isset($_SERVER['HTTP_HOST'])){
                $http = wp_remote_post($api,array('headers'=>array('Content-Type'=>'text/json; charset=utf-8'),'body'=>json_encode(array('siteUrl'=>sanitize_url(wp_unslash($http_type.$_SERVER['HTTP_HOST'])),'urlList'=>$urls))));
            }else{
                $http = wp_remote_post($api,array('headers'=>array('Content-Type'=>'text/json; charset=utf-8'),'body'=>json_encode(array('siteUrl'=>sanitize_url(wp_unslash(get_option('home'))),'urlList'=>$urls))));
            }
            if(is_wp_error($http)){
                return;
            }
            $body = wp_remote_retrieve_body($http);
            $data = json_decode($body,'true');
            if(isset($data['ErrorCode'])){
                return;
            }
             $currnetTime= current_time( 'Y/m/d H:i:s');
             
            if(isset($baidu['bing_log_show']) && $baidu['bing_log_show']){ 
                foreach($urls as $key=>$val){
                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>3,'message'=>'']);
                }
            }
            $baiduseo_bing_record = get_option('baiduseo_bing_record');
            if($baiduseo_bing_record!==false){
                $data = $baiduseo_bing_record;
                $data['num'] = $baiduseo_bing_record['num']+1;
                
                $data['remind'] =  $baiduseo_cron->baiduseo_quota($baidu['bing_key']);
                $data['time'] = $currnetTime;
                update_option('baiduseo_bing_record',$data);
            }else{
                $data['num'] = 1;
                $data['time'] =  $currnetTime;
                $data['remind'] =  $baiduseo_cron->baiduseo_quota($baidu['bing_key']);
                add_option('baiduseo_bing_record',$data);
            }
        }
    }

}
?>