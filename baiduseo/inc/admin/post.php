<?php
class baiduseo_post{
    public function init(){
        global $baiduseo_key;
        $baiduseo_key = apply_filters('baiduseo_dhdfkdksj',1);
        
        add_action('wp_ajax_baiduseo_zhizhu', [$this,'baiduseo_zhizhu']);
        add_action('wp_ajax_baiduseo_seo', [$this,'baiduseo_seo']);
        add_action('wp_ajax_baiduseo_wyc', [$this,'baiduseo_wyc']);
        add_action('wp_ajax_baiduseo_zz', [$this,'baiduseo_zz']);
        add_action('wp_ajax_baiduseo_youhua', [$this,'baiduseo_youhua']);
        add_action('wp_ajax_baiduseo_rank', [$this,'baiduseo_rank']);
        add_action('wp_ajax_baiduseo_shouquan', [$this,'baiduseo_shouquan']);
        add_action('wp_ajax_baiduseo_zhizhu_clear', [$this,'baiduseo_zhizhu_clear']);
        add_action('wp_ajax_baiduseo_tag', [$this,'baiduseo_tag']);
        add_action('wp_ajax_baiduseo_tag_add', [$this,'baiduseo_tag_add']);
        add_action('wp_ajax_baiduseo_301', [$this,'baiduseo_301']);
        add_action('wp_ajax_baiduseo_tag_pladd', [$this,'baiduseo_tag_pladd']);
        add_action('wp_ajax_baiduseo_neilian', [$this,'baiduseo_neilian']);
        add_action('wp_ajax_baiduseo_neilian_delete', [$this,'baiduseo_neilian_delete']);
        add_action('wp_ajax_baiduseo_neilian_delete_all', [$this,'baiduseo_neilian_delete_all']);
        add_action('wp_ajax_baiduseo_reci', [$this,'baiduseo_reci']);
        add_action('wp_ajax_baiduseo_5118', [$this,'baiduseo_5118']);
        add_action('wp_ajax_baiduseo_5118_daochu', [$this,'baiduseo_5118_daochu']);
        add_action('wp_ajax_baiduseo_add_tag', [$this,'baiduseo_add_tag']);
        add_action('wp_ajax_baiduseo_add_pltag', [$this,'baiduseo_add_pltag']);
        add_action('wp_ajax_baiduseo_linkhh', [$this,'baiduseo_linkhh']);
        add_action('wp_ajax_baiduseo_zhizhu_linkdelete', [$this,'baiduseo_zhizhu_linkdelete']);
        add_action('wp_ajax_baiduseo_wycsc', [$this,'baiduseo_wycsc']);
        add_action('wp_ajax_baiduseo_yuanchuang', [$this,'baiduseo_yuanchuang']);
        add_action('wp_ajax_baiduseo_kuaisu', [$this,'baiduseo_kuaisu']);
        add_action('wp_ajax_baiduseo_gaixie', [$this,'baiduseo_gaixie']);
        add_action('wp_ajax_baiduseo_ptts', [$this,'baiduseo_ptts']);
        add_action('wp_ajax_baiduseo_yanzheng', [$this,'baiduseo_yanzheng']);
        add_action('wp_ajax_baiduseo_pingbi', [$this,'baiduseo_pingbi']);
        add_action('wp_ajax_baiduseo_add_link', [$this,'baiduseo_add_link']);
        add_action('wp_ajax_baiduseo_address_delete', [$this,'baiduseo_address_delete']);
        add_action('wp_ajax_baiduseo_shenhe', [$this,'baiduseo_shenhe']);
        add_action('wp_ajax_baiduseo_ai_lishi', [$this,'baiduseo_ai_lishi']);
        add_action('wp_ajax_baiduseo_ai_lishiz', [$this,'baiduseo_ai_lishiz']);
        add_action('wp_ajax_baiduseo_ai_lishis', [$this,'baiduseo_ai_lishis']);
        add_action('wp_ajax_baiduseo_yindao_first', [$this,'baiduseo_yindao_first']);
        add_action('wp_ajax_baiduseo_yindao_second', [$this,'baiduseo_yindao_second']);
        add_action('wp_ajax_baiduseo_yindao_three', [$this,'baiduseo_yindao_three']);
        add_action('wp_ajax_baiduseo_yindao_four', [$this,'baiduseo_yindao_four']);
        add_action('wp_ajax_baiduseo_yindao_five', [$this,'baiduseo_yindao_five']);
        add_action('wp_ajax_baiduseo_percent', [$this,'baiduseo_percent']);
        add_action('wp_ajax_baiduseo_liuliang', [$this,'baiduseo_liuliang']);
        add_action('wp_ajax_baiduseo_liuliang_delete', [$this,'baiduseo_liuliang_delete']);
        add_action('wp_ajax_baiduseo_aidk', [$this,'baiduseo_aidk']);
        add_action('wp_ajax_baiduseo_yindao', [$this,'baiduseo_yindao']);
        add_action('wp_ajax_baiduseo_robots', [$this,'baiduseo_robots']);
        add_action('wp_ajax_baiduseo_pingfen', [$this,'baiduseo_pingfen']);
       
    }
    public function baiduseo_pingfen(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
           $baiduseo_pingfen = get_option('baiduseo_pingfen');
            if($baiduseo_pingfen!==false){
               update_option('baiduseo_pingfen',isset($_POST['pingfen'])?(int)$_POST['pingfen']:0);
            }else{
               add_option('baiduseo_pingfen',isset($_POST['pingfen'])?(int)$_POST['pingfen']:0);
            }
            echo json_encode(['code'=>1]);exit;
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_robots(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
             if(isset($_POST['robots'])){
                baiduseo_seo::robots(sanitize_textarea_field(wp_unslash($_POST['robots'])));
            }
            echo json_encode(['code'=>1]);exit;
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_yindao(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
           $baiduseo_yindao = get_option('baiduseo_yindao');
           if($baiduseo_yindao!==false){
               update_option('baiduseo_yindao',1);
           }else{
               add_option('baiduseo_yindao',1);
           }
            echo json_encode(['code'=>1]);exit;
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_liuliang_delete(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            global $wpdb;
            $res = $wpdb->query("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang");
            echo json_encode(['msg'=>'操作成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'操作失败','code'=>0]);exit;
    }
    public function baiduseo_aidk(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $codea = isset($_POST['codea'])?(int)$_POST['codea']:0;
            $msg = isset($_POST['msg'])?sanitize_text_field(wp_unslash($_POST['msg'])):'';
            $defaults = array(
                'timeout' => 10000,
                'connecttimeout'=>10000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $url1 = baiduseo_common::baiduseo_url(0);
            
           
            $result = wp_remote_get('https://art.seohnzz.com/api/index/zhongzhuan1?codea='.$codea.'&msg='.$msg.'&url='.$url1,$defaults);
            
            if(!is_wp_error($result)){
                $content = wp_remote_retrieve_body($result);
           
               
                //验证
                $content1 = json_decode($content,true);
                if($content1['code']==0){
                    echo wp_json_encode(['code'=>$content1['code'],'msg'=>esc_attr($content1['msg'])]);exit;
                   
                }elseif($content1['code']==1){
                    echo wp_json_encode(['code'=>$content1['code'],'data'=>str_replace("，",",",sanitize_text_field(wp_unslash($content1['data'])))]);exit;
                    exit;
                }elseif($content1['code']==2){
                    
                    echo wp_json_encode(['code'=>1,'data'=>sanitize_textarea_field(wp_unslash($content1['data']))]);exit;
                    exit;
                }else{
                    echo wp_json_encode(['code'=>0,'msg'=>'请求失败']);exit;
                    exit;
                }
                
            }
        }
        echo json_encode(['msg'=>'操作失败','code'=>0]);exit;
    }
    public function baiduseo_liuliang(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            $open = isset($_POST['open'])?(int)$_POST['open']:0;
            $log = isset($_POST['log'])?(int)$_POST['log']:0;
            $pinci = isset($_POST['pinci'])?(int)$_POST['pinci']:0;
            
            $baiduseo_wyc = get_option('baiduseo_liuliang');
            if($baiduseo_wyc!==false){
                $res = update_option('baiduseo_liuliang',['open'=>$open,'log'=>$log,'pinci'=>$pinci]);
            }else{
                $res = add_option('baiduseo_liuliang',['open'=>$open,'log'=>$log,'pinci'=>$pinci]);
            }
            
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
            
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_wyc(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $wyc = isset($_POST['wyc'])?(int)$_POST['wyc']:0;
            $gx = isset($_POST['gx'])?(int)$_POST['gx']:0;
            $wyc_min = isset($_POST['wyc_min'])?(int)$_POST['wyc_min']:0;
            $baiduseo_wyc = get_option('baiduseo_wyc');
            if($baiduseo_wyc!==false){
               update_option('baiduseo_wyc',['wyc'=>$wyc,'gx'=>$gx,'wyc_min'=>$wyc_min]);
            }else{
                add_option('baiduseo_wyc',['wyc'=>$wyc,'gx'=>$gx,'wyc_min'=>$wyc_min]);
            }
            
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
            
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_zhizhu(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
             global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
           
            $list = [
                'open'=>isset($_POST['open'])?(int)$_POST['open']:0,
                'log'=>isset($_POST['log'])?(int)$_POST['log']:0,
                'type'=>isset($_POST['type'])?sanitize_text_field(wp_unslash($_POST['type'])):0,
            ];
            $baiduseo_zhizhu = get_option('baiduseo_zhizhu');
            if($baiduseo_zhizhu!==false){
                update_option('baiduseo_zhizhu',$list);
            }else{
                add_option('baiduseo_zhizhu',$list);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_ai_lishi(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
             $current_time = current_time( 'Y/m/d H:i:s');
             if(!isset($_POST['hexin'])){
                $_POST['hexin'] =''; 
             }
             if(!isset($_POST['guangjianci'])){
                $_POST['guangjianci'] =''; 
             }
             if(!isset($_POST['neirong'])){
                $_POST['neirong'] =''; 
             }
            $res = $wpdb->insert($wpdb->prefix."baiduseo_ai_lishi",['hexin'=>sanitize_text_field(wp_unslash($_POST['hexin'])),'guangjianci'=>sanitize_text_field(wp_unslash($_POST['guangjianci'])),'neirong'=>sanitize_text_field(wp_unslash($_POST['neirong'])),'riqi'=>$current_time,'jifen'=>'0.2']);
            if($res){
                echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
            }
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
        
    }
    public function baiduseo_ai_lishiz(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
            $start1 = ($p1-1)*20;
            $count = $wpdb->query(' select * from  '.$wpdb->prefix.'baiduseo_ai_lishi',ARRAY_A);
           
            $list = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_ai_lishi  order by id desc limit %d ,20',$start1),ARRAY_A);
           $jifen = baiduseo_kp::get_jifen();
            echo json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$list,'pagesize'=>20,'total'=>ceil($count/20),'jifen'=>$jifen]);exit;
           
        }
         echo json_encode(['code'=>0,'msg'=>'获取失败',]);exit;
        
    }
      public function baiduseo_ai_lishis(){
           if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $id  = isset($_POST['id'])?(int)$_POST['id']:0;
             $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_ai_lishi where id=  %d",(int)$id));
             
            if($res){
                echo json_encode(['code'=>1,'msg'=>'删除成功']);exit;
            }else{
                echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
            }
        }
        echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
      }
    public function baiduseo_5118_daochu(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $keywords = isset($_POST['keywords'])?sanitize_text_field(wp_unslash($_POST['keywords'])):'';
            $total = isset($_POST['total'])?(int)$_POST['total']:0;
            $long = isset($_POST['long'])?(int)$_POST['long']:0;
            $collect = 0;
            $bidword = isset($_POST['bidword'])?(int)$_POST['bidword']:0;
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $data =  baiduseo_common::baiduseo_url(1);
            $url = 'https://art.seohnzz.com/api/rank/daochu?keywords='.$keywords.'&total='.$total.'&long='.$long.'&collect='.$collect.'&bidword='.$bidword.'&url='.$data;
            
            $result = wp_remote_get($url,$defaults);
            
            if(!is_wp_error($result)){
                $level = wp_remote_retrieve_body($result);
                $level = json_decode($level,true);
               
                if(isset($level['code']) && $level['code']==1){
                    $res = $wpdb->insert($wpdb->prefix."baiduseo_long",['keywords'=>$keywords,'total'=>$total,'longs'=>$long,'collect'=>$collect,'bidword'=>$bidword]);
                    echo json_encode(['code'=>1,'msg'=>'申请成功，请等待响应！']);exit;
                }elseif(isset($level['code']) && $level['code']==2){
                    echo json_encode(['code'=>0,'msg'=>'申请失败，积分不足']);exit;
                }
            }
        }
        echo json_encode(['code'=>0,'msg'=>'申请失败，请稍后重试！']);exit;
    }
    public function baiduseo_5118(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $name = isset($_POST['name'])?sanitize_text_field(wp_unslash($_POST['name'])):'';
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $url = 'https://art.seohnzz.com/api/rank/word_vip?keywords='.$name;
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $level = wp_remote_retrieve_body($result);
                echo json_encode(['code'=>1,'data'=>$level]);exit;
                
            }
        }
        echo json_encode(['code'=>0,'msg'=>'获取失败']);exit;
    }
    public function baiduseo_percent(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $type = isset($_POST['type'])?(int)$_POST['type']:1; 
            if($type==1){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $url = 'https://art.seohnzz.com/api/money/level1?url='.baiduseo_common::baiduseo_url(0);
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $level = wp_remote_retrieve_body($result);
                    $level = json_decode($level,true);
                    if($level['version']==BAIDUSEO_VERSION){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                    
                }
            }elseif($type==2){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://art.seohnzz.com/api/speed/keywords?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
               
            }elseif($type==3){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://art.seohnzz.com/api/speed/description?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==4){
                $seo_alt_auto = get_option('seo_alt_auto');
                if($seo_alt_auto!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==5){
                $defaults = array(
                    'timeout' => 4000,
                    'redirection' => 4000,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                    );
                $site_url = baiduseo_common::baiduseo_url(0).'/';
                $site_url1 = baiduseo_common::baiduseo_url(1);
                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                $url = str_replace('www.','',$site_url);
                $url_301['url1'] = $url;
                $url1 = $http_type.$url;
                $url_301['url2'] = 'www.'.$url;
                $url2 = $http_type.'www.'.$url;
                $url_301['status'] = 0;
                $result = wp_remote_get($url1,$defaults);
                if(!is_wp_error($result)){
                  $http = (array)$result['http_response'];
                  
                  $url_301['re_url1'] = $http["\0*\0response"]->url;
                }else{
                   $url_301['re_url1'] =''; 
                }
                $result1 = wp_remote_get($url2,$defaults);
                if(!is_wp_error($result1)){
                  $http1 = (array)$result1['http_response'];
                  
                  
                  $url_301['re_url2'] = $http1["\0*\0response"]->url;
                }else{
                    $url_301['re_url2'] =''; 
                }
                
         
                
                if( trim($url_301['re_url2'],'/')==trim($site_url1,'/') || trim($url_301['re_url1'],'/')==trim($site_url1,'/')){
                    $url_301['status'] = 1;
                }else{
                    $url_301['status'] = 0;
                }
                if($url_301['status']==1){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
               
            }elseif($type==6){
                $rootbot = get_option('seo_robots_sc');
                if($rootbot!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==7){
                $sitemap = get_option('seo_baidu_sitemap');
                if($sitemap!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==8){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['pingtai'])){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==9){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['zz_link']) && $baiduseo_zz['zz_link']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==10){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['bing_key']) && $baiduseo_zz['bing_key']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==11){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['shenma_key']) && $baiduseo_zz['shenma_key']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==12){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['toutiao_key']) && $baiduseo_zz['toutiao_key']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==13){
                $baidu3 = get_option('baiduseo_tag');
                if(isset($baidu3['auto']) && $baidu3['auto']==1){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==14){
                $silian = get_option('seo_baidu_silian');
                if($silian!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==15){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  str_replace('www.','',baiduseo_common::baiduseo_url(0));
                $url = "https://art.seohnzz.com/api/speed/beian?url={$data}";
               
                $result = wp_remote_get($url,$defaults);
                $beian = get_option('baiduseo_beian');
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if($beian!==false){
                        update_option('baiduseo_beian',$content['data']);
                    }else{
                        add_option('baiduseo_beian',$content['data']);
                    }
                    if(isset($content['code']) && $content['code']==1){
                        
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==16){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://art.seohnzz.com/api/speed/wx_check?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==17){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://art.seohnzz.com/api/speed/h1?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==18){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://art.seohnzz.com/api/speed/iframe?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==19){
                $defaults = array(
                    'timeout' => 40000,
                    'connecttimeout'=>40000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "http://jiekou.seohnzz.com/api/index/go_sd?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    if($content){
                        echo json_encode(['code'=>1,'msg'=>$content,'num'=>ceil($content/10)]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==20){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://art.seohnzz.com/api/speed/gn_yc?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        if($content['msg']>1.5){
                            $num =2;
                        }elseif($content['msg']>0.5 && $content<=1.5){
                            $num =4;
                        }else{
                            $num = 6;
                        }
                        echo json_encode(['code'=>1,'msg'=>round($content['msg'],1).'s','num'=>$num]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==21){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "http://jiekou.seohnzz.com/api/index/gn_yc?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        if($content['msg']>1.5){
                            $num =1;
                        }elseif($content['msg']>0.5 && $content<=1.5){
                            $num =2;
                        }else{
                            $num = 4;
                        }
                        echo json_encode(['code'=>1,'msg'=>round($content['msg'],1).'s','num'=>$num]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }
            
        }
    }
    public function baiduseo_yindao_five(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
             global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 exit;
            }
            global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                    exit;
                }
            }
            baiduseo_tag::baiduseo_tag_set($_POST);
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_four(){
          global $wpdb,$baiduseo_wzt_log;
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $indexnow_key = isset($_POST['indexnow_key'])?sanitize_text_field(wp_unslash($_POST['indexnow_key'])):'';
            
            $seo_baidu_xzh =[                               
                'zz_link'=>isset($_POST['zz_link'])?sanitize_url(wp_unslash($_POST['zz_link'])):'',                                   
                'bing_key'=>isset($_POST['bing_key'])?sanitize_text_field(wp_unslash($_POST['bing_key'])):'', 
                // 'shenma_key' =>isset($_POST['shenma_key'])?sanitize_url(wp_unslash($_POST['shenma_key'])):"",
                'toutiao_key'=>isset($_POST['toutiao_key'])?sanitize_text_field(wp_unslash($_POST['toutiao_key'])):"",
                'indexnow_key'=>$indexnow_key,
                'google_api'=>isset($_POST['google_api'])?stripslashes(sanitize_textarea_field(wp_unslash($_POST['google_api']))):"",
                // 'indexnow_pingtai'=>isset($_POST['indexnow_pingtai'])?sanitize_text_field(wp_unslash($_POST['indexnow_pingtai'])):"",
                'post_type'=>isset($_POST['post_type'])?sanitize_text_field(wp_unslash($_POST['post_type'])):"",
                // 'baiduseo_type'=>sanitize_text_field($_POST['baiduseo_type']),
                // 'post_type'=>isset($_POST['bing_key'])?sanitize_text_field($_POST['post_type']),
                'status'=>isset($_POST['status'])?sanitize_text_field(wp_unslash($_POST['status'])):'',
                'pingtai'=>isset($_POST['pingtai'])?sanitize_text_field(wp_unslash($_POST['pingtai'])):'',
                'guowai_num'=>isset($_POST['guowai_num'])?(int)$_POST['guowai_num']:0,
                'bdpt_num'=>isset($_POST['bdpt_num'])?(int)$_POST['bdpt_num']:0,
                'bing_num'=>isset($_POST['bing_num'])?(int)$_POST['bing_num']:0,
                // 'sm_num'=>isset($_POST['sm_num'])?(int)$_POST['sm_num']:"",
                // 'log'=>isset($_POST['log'])?sanitize_text_field(wp_unslash($_POST['log'])):"",
                'bd_log'=>isset($_POST['bd_log'])?(int)$_POST['bd_log']:0,
                'bd_log_show'=>isset($_POST['bd_log_show'])?(int)$_POST['bd_log_show']:0,
                // 'bdks_log'=>isset($_POST['bdks_log'])?(int)$_POST['bdks_log']:"",
                'bing_log'=>isset($_POST['bing_log'])?(int)$_POST['bing_log']:0,
                'bing_log_show'=>isset($_POST['bing_log_show'])?(int)$_POST['bing_log_show']:0,
                 'seznam_log'=>isset($_POST['seznam_log'])?(int)$_POST['seznam_log']:0,
                'seznam_log_show'=>isset($_POST['seznam_log_show'])?(int)$_POST['seznam_log_show']:0,
                'indexNow_log'=>isset($_POST['indexNow_log'])?(int)$_POST['indexNow_log']:0,
                'indexNow_log_show'=>isset($_POST['indexNow_log_show'])?(int)$_POST['indexNow_log_show']:0,
                  'indexNow_bing_log'=>isset($_POST['indexNow_bing_log'])?(int)$_POST['indexNow_bing_log']:0,
                'indexNow_bing_log_show'=>isset($_POST['indexNow_bing_log_show'])?(int)$_POST['indexNow_bing_log_show']:0,
                'guge_log'=>isset($_POST['guge_log'])?(int)$_POST['guge_log']:0,
                'guge_log_show'=>isset($_POST['guge_log_show'])?(int)$_POST['guge_log_show']:0,
                  'yandex_log'=>isset($_POST['yandex_log'])?(int)$_POST['yandex_log']:0,
                'yandex_log_show'=>isset($_POST['yandex_log_show'])?(int)$_POST['yandex_log_show']:0,  
                'naver_log'=>isset($_POST['naver_log'])?(int)$_POST['naver_log']:0,
                'naver_log_show'=>isset($_POST['naver_log_show'])?(int)$_POST['naver_log_show']:0,  
                'yep_log'=>isset($_POST['yep_log'])?(int)$_POST['yep_log']:0,
                'yep_log_show'=>isset($_POST['yep_log_show'])?(int)$_POST['yep_log_show']:0,
                
            ];
            if($indexnow_key){
                WP_Filesystem();
                global $wp_filesystem;
                $wp_filesystem->put_contents (ABSPATH.'/'.$indexnow_key.'.txt',$indexnow_key);
            }
            
            $baidu = get_option('baiduseo_zz');
            if($baidu!==false){
                update_option('baiduseo_zz',$seo_baidu_xzh);
            }else{
                add_option('baiduseo_zz',$seo_baidu_xzh);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_three(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            $sitemap = get_option('seo_baidu_sitemap');
            if($sitemap!==false && !is_array($sitemap)){
                // $data = $sitemap;
                $data['level1'] = isset($_POST['level1'])?(int)$_POST['level1']:0;
                $data['level2'] = isset($_POST['level2'])?(int)$_POST['level2']:0;
                $data['level3'] = isset($_POST['level3'])?(int)$_POST['level3']:0;
                $data['level4'] = isset($_POST['level4'])?(int)$_POST['level4']:0;
                $data['level5'] = isset($_POST['level5'])?(int)$_POST['level5']:0;
                $data['type1'] = isset($_POST['type1'])?(int)$_POST['type1']:0;
                $data['type2'] = isset($_POST['type2'])?(int)$_POST['type2']:0;
                $data['type3'] = isset($_POST['type3'])?(int)$_POST['type3']:0;
                $data['type4'] = isset($_POST['type4'])?(int)$_POST['type4']:0;
                $data['type5'] = isset($_POST['type5'])?(int)$_POST['type5']:0;
                $data['page_time'] = isset($_POST['page_time'])?sanitize_text_field(wp_unslash($_POST['page_time'])):"";
                $data['post_time'] = isset($_POST['post_time'])?sanitize_text_field(wp_unslash($_POST['post_time'])):"";
                $data['tag_time'] = isset($_POST['tag_time'])?sanitize_text_field(wp_unslash($_POST['tag_time'])):"";
                $data['other_time'] = isset($_POST['other_time'])?sanitize_text_field(wp_unslash($_POST['other_time'])):"";
                $data['cate_time'] = isset($_POST['cate_time'])?sanitize_text_field(wp_unslash($_POST['cate_time'])):"";
                $data['sitemap_open'] = isset($_POST['sitemap_open'])?(int)$_POST['sitemap_open']:"";
                $data['silian_open'] = isset($_POST['silian_open'])?(int)$_POST['silian_open']:"";
                // $data['tag_open'] = (int)$_POST['tag_open'];
                
                update_option('seo_baidu_sitemap',$data);
            }elseif($sitemap!==false && is_array($sitemap)){
                $data = $sitemap;
                $data['level1'] = isset($_POST['level1'])?(int)$_POST['level1']:0;
                $data['level2'] = isset($_POST['level2'])?(int)$_POST['level2']:0;
                $data['level3'] = isset($_POST['level3'])?(int)$_POST['level3']:0;
                $data['level4'] = isset($_POST['level4'])?(int)$_POST['level4']:0;
                $data['level5'] = isset($_POST['level5'])?(int)$_POST['level5']:0;
                $data['type1'] = isset($_POST['type1'])?(int)$_POST['type1']:0;
                $data['type2'] = isset($_POST['type2'])?(int)$_POST['type2']:0;
                $data['type3'] = isset($_POST['type3'])?(int)$_POST['type3']:0;
                $data['type4'] = isset($_POST['type4'])?(int)$_POST['type4']:0;
                $data['type5'] = isset($_POST['type5'])?(int)$_POST['type5']:0;
                $data['page_time'] = isset($_POST['page_time'])?sanitize_text_field(wp_unslash($_POST['page_time'])):"";
                $data['post_time'] = isset($_POST['post_time'])?sanitize_text_field(wp_unslash($_POST['post_time'])):"";
                $data['tag_time'] = isset($_POST['tag_time'])?sanitize_text_field(wp_unslash($_POST['tag_time'])):"";
                $data['other_time'] = isset($_POST['other_time'])?sanitize_text_field(wp_unslash($_POST['other_time'])):"";
                $data['cate_time'] = isset($_POST['cate_time'])?sanitize_text_field(wp_unslash($_POST['cate_time'])):"";
                $data['sitemap_open'] = isset($_POST['sitemap_open'])?(int)$_POST['sitemap_open']:"";
                $data['silian_open'] = isset($_POST['silian_open'])?(int)$_POST['silian_open']:"";
                // $data['tag_open'] = (int)$_POST['tag_open'];
                
                update_option('seo_baidu_sitemap',$data);
            }else{
                $data['level1'] = isset($_POST['level1'])?(int)$_POST['level1']:0;
                $data['level2'] = isset($_POST['level2'])?(int)$_POST['level2']:0;
                $data['level3'] = isset($_POST['level3'])?(int)$_POST['level3']:0;
                $data['level4'] = isset($_POST['level4'])?(int)$_POST['level4']:0;
                $data['level5'] = isset($_POST['level5'])?(int)$_POST['level5']:0;
                $data['type1'] = isset($_POST['type1'])?(int)$_POST['type1']:0;
                $data['type2'] = isset($_POST['type2'])?(int)$_POST['type2']:0;
                $data['type3'] = isset($_POST['type3'])?(int)$_POST['type3']:0;
                $data['type4'] = isset($_POST['type4'])?(int)$_POST['type4']:0;
                $data['type5'] = isset($_POST['type5'])?(int)$_POST['type5']:0;
                $data['page_time'] = isset($_POST['page_time'])?sanitize_text_field(wp_unslash($_POST['page_time'])):"";
                $data['post_time'] = isset($_POST['post_time'])?sanitize_text_field(wp_unslash($_POST['post_time'])):"";
                $data['tag_time'] = isset($_POST['tag_time'])?sanitize_text_field(wp_unslash($_POST['tag_time'])):"";
                $data['other_time'] = isset($_POST['other_time'])?sanitize_text_field(wp_unslash($_POST['other_time'])):"";
                $data['cate_time'] = isset($_POST['cate_time'])?sanitize_text_field(wp_unslash($_POST['cate_time'])):"";
                $data['sitemap_open'] = isset($_POST['sitemap_open'])?(int)$_POST['sitemap_open']:"";
                $data['silian_open'] = isset($_POST['silian_open'])?(int)$_POST['silian_open']:"";
                // $data['tag_open'] = (int)$_POST['tag_open'];
                add_option('seo_baidu_sitemap',$data);  
            }
            
            baiduseo_seo::alt(isset($_POST['alt'])?(int)$_POST['alt']:0,isset($_POST['title'])?(int)$_POST['title']:0);
            if(isset($_POST['isrobots']) && $_POST['isrobots']==1){
                if(isset($_POST['robots']) && sanitize_textarea_field(wp_unslash($_POST['robots']))){
                    baiduseo_seo::robots(sanitize_textarea_field(wp_unslash($_POST['robots'])));
                }
            }
            if(isset($_POST['sitemap_open']) && (int)$_POST['sitemap_open']==1){
                baiduseo_seo::sitemap(1,1,1);
            }
            if((int)$_POST['silian_open']==1){
                baiduseo_seo::silian(1,1);
            }
            echo json_encode(['code'=>1,'msg'=>'保存成功']);exit;
        }
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_second(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $data = [
                'thumb'=>isset($_POST['thumb'])?(int)$_POST['thumb']:0,
                'head_dy'=>isset($_POST['head_dy'])?(int)$_POST['head_dy']:0,
                'xml_rpc'=>isset($_POST['xml_rpc'])?(int)$_POST['xml_rpc']:0,
                'feed'=>isset($_POST['feed'])?(int)$_POST['feed']:0,
                'post_thumb'=>isset($_POST['post_thumb'])?(int)$_POST['post_thumb']:0,
                'gravatar'=>isset($_POST['gravatar'])?(int)$_POST['gravatar']:0,
                'lan'=>isset($_POST['lan'])?(int)$_POST['lan']:0,
                'category'=>isset($_POST['category'])?(int)$_POST['category']:0,
                'listbtn'=>isset($_POST['listbtn'])?(int)$_POST['listbtn']:0,
                'wp_json'=>isset($_POST['wp_json'])?(int)$_POST['wp_json']:0,
                'art_cron'=>isset($_POST['art_cron'])?(int)$_POST['art_cron']:0,
            ];
           
            $baidu = get_option('baiduseo_youhua');
            if($baidu!==false){
                update_option('baiduseo_youhua',$data);
            }else{
                add_option('baiduseo_youhua',$data);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_first(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            if(isset($_POST['title'])){
                update_option('blogname',sanitize_text_field(wp_unslash($_POST['title'])));
            }
            if(isset($_POST['subtitle'])){
                update_option('blogdescription',sanitize_text_field(wp_unslash($_POST['subtitle'])));
            }
            baiduseo_seo::seo_index(isset($_POST['keywords'])?sanitize_text_field(wp_unslash($_POST['keywords'])):'',isset($_POST['description'])?sanitize_textarea_field(wp_unslash($_POST['description'])):'');
            if(isset($_POST['cate_id'])){
                baiduseo_seo::cate_seo(isset($_POST['cate_keywords'])?sanitize_text_field(wp_unslash($_POST['cate_keywords'])):'',isset($_POST['cate_description'])?sanitize_textarea_field(wp_unslash($_POST['cate_description'])):'',(int)$_POST['cate_id']);
            }
            if(isset($_POST['page'])){
                baiduseo_seo::page_seo(isset($_POST['page_keywords'])?sanitize_text_field(wp_unslash($_POST['page_keywords'])):'',isset($_POST['page_description'])?sanitize_text_field(wp_unslash($_POST['page_description'])):'',(int)$_POST['page']);
            }
            echo json_encode(['code'=>1]);exit;
            
        }
        echo json_encode(['code'=>0]);exit;
    }
   
    public function baiduseo_reci(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
           
            $type = isset($_POST['type'])?(int)$_POST['type']:0;
            $keyword = isset($_POST['keyword'])?sanitize_text_field(wp_unslash($_POST['keyword'])):'';
            $result = wp_remote_post('https://art.seohnzz.com/api/tag/index',['body'=>['type'=>$type,'keyword'=>$keyword,'url'=>baiduseo_common::baiduseo_url(0)]]);
           
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                $result = json_decode($result,true);
                
                if($result['code']){
                    $msg = array_map('sanitize_text_field',$result['msg']);
                    
                    echo json_encode(['data'=>$msg,'code'=>1]);exit;
                }else{
                    echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
        }
        echo json_encode(['msg'=>'获取失败','code'=>0]);exit;
    }
    public function baiduseo_address_delete(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $id  = isset($_POST['id'])?(int)$_POST['id']:0;
             $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "wztkj_friends where id=  %d",(int)$id));
             
            if($res){
                echo json_encode(['code'=>1,'msg'=>'删除成功']);exit;
            }else{
                echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
            }
        }
         echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
    }
    public function baiduseo_add_link(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $current_time = current_time( 'Y/m/d H:i:s');
            $re = $wpdb->insert($wpdb->prefix."wztkj_friends",['link'=>isset($_POST['address'])?sanitize_url(wp_unslash($_POST['address'])):'','keywords'=>isset($_POST['keywords'])?sanitize_text_field(wp_unslash($_POST['keywords'])):'','time'=>$current_time,'status1'=>5]);
            if($re){
                echo json_encode(['code'=>1,'msg'=>'添加成功']);exit;
            }else{
                echo json_encode(['code'=>0,'msg'=>'添加失败']);exit;
            }
        }
        echo json_encode(['code'=>0,'msg'=>'添加失败']);exit;
    }
    public function baiduseo_shenhe(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $url = 'https://art.seohnzz.com/api/wztkj/shenhe';
            $link2 = isset($_POST['url'])?sanitize_url(wp_unslash($_POST['url'])):'';
            $link1 =  baiduseo_common::baiduseo_url(1);
            $result = wp_remote_post($url,['body'=>['data'=>['link1'=>$link1,'link2'=>$link2]]]);
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                if($result){
                    $wpdb->update($wpdb->prefix . 'wztkj_friends',['status3'=>2],['link'=>$link2]);
                    echo json_encode(['msg'=>'操作成功，请等待处理！','code'=>1]);exit;
                }else{
                    echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
                }
            }else{
                echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
            }
        }
        echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
    }
    public function baiduseo_pingbi(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $url = 'https://art.seohnzz.com/api/wztkj/pb';
            $link2 = isset($_POST['url'])?sanitize_url(wp_unslash($_POST['url'])):'';
            $status =isset($_POST['status'])?(int)$_POST['status']:0;
            
            if($status==0){
                $sta = 1;
            }else{
                $sta = 0;
            }
            $link1 =  baiduseo_common::baiduseo_url(1);
            $result = wp_remote_post($url,['body'=>['data'=>['link1'=>$link1,'link2'=>$link2,'status'=>$sta]]]);
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                if($result){
                     
                    $wpdb->update($wpdb->prefix . 'wztkj_friends',['status1'=>$sta],['link'=>$link2]);
                    
                    echo json_encode(['msg'=>'操作成功！','code'=>1]);exit;
                }else{
                    echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
                }
            }else{
                echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
            }
        }
        echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
    }
    public function baiduseo_yanzheng(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
        $defaults = array(
            'timeout' => 4000,
            'connecttimeout'=>4000,
            'redirection' => 3,
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'sslverify' => FALSE,
        );
        $url = get_option('home');
        $result = wp_remote_get($url,$defaults);
        if(!is_wp_error($result)){
            $content = wp_remote_retrieve_body($result);
           
            if(strpos($content,md5(baiduseo_common::baiduseo_url(0))) !== false){ 
             echo json_encode(['code'=>1]);exit;
            }else{
             echo json_encode(['code'=>0]);exit;
            }
           
        }
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_linkhh(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            
            $data['link'] = isset($_POST['link'])?(int)$_POST['link']:'';
            $data['keywords'] = isset($_POST['keywords'])?sanitize_text_field(wp_unslash($_POST['keywords'])):'';
            $data['hhtype'] = isset($_POST['hhtype'])?(int)$_POST['hhtype']:0;
            $data['hhtj'] = isset($_POST['hhtj'])?(int)$_POST['hhtj']:0;
            if(isset($_POST['level']) ){
                $data['level'] = array_map('intval',explode(',',$_POST['level']));
            }
            if(isset($_POST['cate'])){
                $data['cate'] = array_map('intval',explode(',',$_POST['cate']));
            }
            $data['ystype'] = isset($_POST['ystype'])?(int)$_POST['ystype']:0;
            $data['kqtype'] = isset($_POST['kqtype'])?(int)$_POST['kqtype']:0;
            $data['yswidth'] = isset($_POST['yswidth'])?sanitize_text_field(wp_unslash($_POST['yswidth'])):'';
            $data['mobilewidth'] = isset($_POST['mobilewidth'])?sanitize_text_field(wp_unslash($_POST['mobilewidth'])):'';
            
            $wztkj_linkhh = get_option('baiduseo_linkhh');
            if($wztkj_linkhh!==false){
                $res = update_option('baiduseo_linkhh',$data);
            }else{
                add_option('baiduseo_linkhh',$data);
            }
            echo json_encode(['code'=>1]);exit;
            
        }
       echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_ptts(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),sanitize_text_field(wp_unslash($_POST['action'])))){
            global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            $url = get_permalink($id);
            $currnetTime= current_time( 'Y-m-d H:i:s');
            $baiduseo_zz = get_option('baiduseo_zz');
            $urls =explode(',',$url);
            //查询选择推送的方式
              
                    
            if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'1')!==false){
                baiduseo_zz::bdts($urls);
            }
            if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'2')!==false){
                baiduseo_zz::bing($urls);
            }
            if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'4')!==false){
        
                baiduseo_zz::google($url);
            }
              if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'5')!==false){
        
                baiduseo_zz::indexnow($urls,0,0,6);
            }
              if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'6')!==false){
        
                baiduseo_zz::indexnow($urls,0,0,6);
            }
              if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'7')!==false){
        
                baiduseo_zz::indexnow($urls,0,0,7);
            }
              if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'8')!==false){
        
                baiduseo_zz::indexnow($urls,0,0,8);
            }
              if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'9')!==false){
        
                baiduseo_zz::indexnow($urls,0,0,9);
            }
              if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'10')!==false){
        
                baiduseo_zz::indexnow($urls,0,0,10);
            }
            
                
            
      
            echo json_encode(['msg'=>1]);exit;
           
        }
    }
    public function baiduseo_neilian_delete_all(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
           
            global $wpdb;
            $res = $wpdb->query("DELETE FROM " . $wpdb->prefix . "baiduseo_neilian ");
             if($res){
                echo json_encode(['code'=>1,'msg'=>'清空成功']);exit;
            }
        }
        echo json_encode(['code'=>0,'msg'=>'清空失败']);exit;
    }
    public function baiduseo_neilian_delete(){
      
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $dele = isset($_POST['dele'])?array_map('intval',wp_unslash(explode(',',$_POST['dele']))):[];
            if(!empty($dele) && is_array($dele)){
                global $wpdb;
                foreach($dele as $key=>$val){
                 $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_neilian where id=  %d",(int)$val));
                }
            }
            if($res){
                echo json_encode(['code'=>1,'msg'=>'删除成功']);exit;
            }
            
        }
        echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
    }
    public function baiduseo_shouquan(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $key = isset($_POST['key'])?sanitize_text_field(wp_unslash($_POST['key'])):'';
            
            $data =  baiduseo_common::baiduseo_url(0);
            $url1 = isset($_SERVER['SERVER_NAME'])?sanitize_text_field(wp_unslash($_SERVER['SERVER_NAME'])):'';
            $url = 'https://art.seohnzz.com/api/money/log2?url='.$data.'&url1='.$url1.'&key='.$key.'&type=1';
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $content = wp_remote_retrieve_body($result);
                if($content){
                    $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
                    if($baiduseo_wzt_log!==false){
                        update_option('baiduseo_wzt_log',$key);
                    }else{
                        add_option('baiduseo_wzt_log',$key);
                    }
                    echo json_encode(['code'=>1]);exit;
                }
            }
            
            
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_neilian(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb,$baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
             global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            if(isset($_POST['keywords'])){
                $data['keywords'] = sanitize_text_field(wp_unslash($_POST['keywords']));
            }
            if(isset($_POST['link'])){
                $data['link'] = sanitize_text_field(wp_unslash($_POST['link']));
            }
            if(isset($_POST['target'])){
                $data['target'] = (int)$_POST['target'];
            }
            if(isset($_POST['nofollow'])){
                $data['nofollow'] = (int)$_POST['nofollow'];
            }
            if(isset($_POST['sort'])){
                $data['sort'] = (int)$_POST['sort'];
            }
            $res = $wpdb->update($wpdb->prefix . 'baiduseo_neilian',$data,['id'=>(int)$id]);
            if($res){
                
                echo json_encode(['code'=>1,'msg'=>'修改成功']);exit;
                
            }
        }
        echo json_encode(['code'=>0,'msg'=>'修改失败']);exit;
    }

    public function baiduseo_gaixie(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),sanitize_text_field(wp_unslash($_POST['action'])))){
            global $wpdb;
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            $url = 'https://art.seohnzz.com/api/kp/jifen?url='.baiduseo_common::baiduseo_url(0);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $jifen = wp_remote_retrieve_body($result);
                $jifen =$jifen?$jifen:0;
            }else{
                $jifen = 0;
            }
            
            if($jifen>=0.28){
                $post = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."posts  where ID=%d ",$id),ARRAY_A);
                
                foreach($post as $ke=>$va){
                    $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wyc_50';
                    $va['url'] = get_option('siteurl');
                    $result = wp_remote_post($url,['body'=>$va]);
                    $post_extend = get_post_meta( $id, 'baiduseo', true );
                    if($post_extend){
                        $post_extend['status'] = 3;
                       update_post_meta( $id,'baiduseo', $post_extend ); 
                    }else{
                        add_post_meta($id,'baiduseo',['status'=>3] );
                    }
                    break;
                }
                echo json_encode(['msg'=>'1']);exit;
            }else{
                echo json_encode(['msg'=>0]);exit;
            }
            
        }
    }
    public function baiduseo_kuaisu(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),sanitize_text_field(wp_unslash($_POST['action'])))){
            
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            $urls[] = get_permalink($id);
            baiduseo_zz::bddayts1($urls);
        }
    }
    public function baiduseo_yuanchuang(){
        global $baiduseo_wzt_log;
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),sanitize_text_field(wp_unslash($_POST['action'])))){
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            $url = 'https://art.seohnzz.com/api/kp/jifen?url='.baiduseo_common::baiduseo_url(0);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $jifen = wp_remote_retrieve_body($result);
                $jifen =$jifen?$jifen:0;
            }else{
                $jifen = 0;
            }
            if($jifen>0.28){
                $total =2;
            }else{
                if($baiduseo_wzt_log){
                     global $baiduseo_key;
                    if(!$baiduseo_key){ 
                        $log = baiduseo_zz::pay_money();
                        if($log){
                            $total = 1;
                        }else{
                            $total = 0;
                        }
                    }else{
                        $total = 1;
                    }
                   
                }else{
                    $total = 0;
                }
            }
            if($total==0){
                $baiduseo_jifen = get_option('baiduseo_jifen');
                if($baiduseo_jifen!==false){
                    $timezone_offet = get_option( 'gmt_offset');
                    if(isset($baiduseo_jifen['addtime']) && $baiduseo_jifen['addtime']>strtotime(gmdate('Y-m-d 00:00:00'))-$timezone_offet*3600){
                        
                        if(isset($baiduseo_jifen['sy']) && $baiduseo_jifen['sy']<1){
                            echo json_encode(['msg'=>0,'data'=>'当日服务器压力大，请明天再试']);exit;
                        }else{
                            update_option('baiduseo_jifen',['sy'=>$baiduseo_jifen['sy']-1,'kc_total'=>1+$baiduseo_jifen['kc_total'],'addtime'=>time()]);
                        }
                    }else{
                        update_option('baiduseo_jifen',['sy'=>2,'kc_total'=>1+$baiduseo_jifen['kc_total'],'addtime'=>time()]);
                    }
                }else{
                    add_option('baiduseo_jifen',['sy'=>2,'kc_total'=>1,'addtime'=>time()]);
                }
            }
            $post_extend = get_post_meta( $id, 'baiduseo', true );
            $current_time = current_time( 'Y/m/d H:i:s');
            if($post_extend){
               update_post_meta( $id,'baiduseo',  ['status'=>2,'tjtime'=>$current_time] ); 
            }else{
                add_post_meta($id,'baiduseo',['status'=>2,'tjtime'=>$current_time] );
            }
            $content = get_post($id)->post_content;
            $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc?id='.$id.'&content='.$content.'&url='.get_option('siteurl').'&like=9';
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                 $result = wp_remote_retrieve_body($result);
                 if($result){
                    echo json_encode(['msg'=>'1']);exit;
                 }else{
                     echo json_encode(['msg'=>0,'data'=>'当日服务器压力大，请明天再试']);exit;
                 }
            }else{
                $result = wp_remote_post('https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc',['body'=>['id'=>$id,'content'=>$content,'url'=>get_option('siteurl'),'like'=>9],'headers'=>[
                    'timeout' =>4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE]]);
                if(!is_wp_error($result)){
                     $result = wp_remote_retrieve_body($result);
                     if($result){
                        echo json_encode(['msg'=>'1']);exit;
                     }else{
                         echo json_encode(['msg'=>0,'data'=>'当日服务器压力大，请明天再试']);exit;
                     }
                }
                echo json_encode(['msg'=>'0','data'=>'提交失败请稍后重试！']);exit;
            }
        }
        echo json_encode(['msg'=>'0','data'=>'提交失败！']);exit;
    }
   public function baiduseo_tag_pladd() {
        // 1. 安全校验与基础参数初始化
        if (!isset($_POST['nonce']) || !isset($_POST['action']) 
            || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'baiduseo')) {
            echo json_encode(['msg' => '安全校验失败', 'code' => 0]);
            exit;
        }
        $num = isset($_POST['num']) ? (int)$_POST['num'] : 0;
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $tag_num = isset($_POST['tag_num']) ? (int)$_POST['tag_num'] : 0;
        global $wpdb;
    
        // 2. 授权校验（仅第一页执行）
        if ($page === 1) {
            global $baiduseo_wzt_log, $baiduseo_key;
            if (!$baiduseo_wzt_log) {
                echo json_encode(['code' => '0', 'msg' => '请先授权']);
                exit;
            }
            if (!$baiduseo_key) { 
                $ss = baiduseo_zz::pay_money();
                if (!$ss) {
                    echo json_encode(['msg' => '请先授权', 'code' => 0]);
                    exit;
                }
            }
        }
    
        // 3. 获取已发布文章总数 & 计算分页偏移
        $count_posts = wp_count_posts();
        $total = $count_posts->publish;
        $start = ($page - 1) * $num;
    
        // 4. 查询待处理文章列表（一次查询替代循环内多次查询）
        $list = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}posts 
                 WHERE post_status = 'publish' AND post_type = 'post' 
                 LIMIT %d, %d", 
                $start, 
                $num
            ), 
            ARRAY_A
        );
        if (empty($list)) {
            echo json_encode(['msg' => "操作完成", 'code' => 0]);
            exit;
        }
    
        // 5. 预处理标签排序规则（提前确定排序 SQL 片段，避免循环内重复判断）
        $tag_order_sql = match ($baiduseo_tag['pp'] ?? 0) {
            1 => 'ORDER BY LENGTH(name) DESC',
            2 => 'ORDER BY LENGTH(name) ASC',
            default => ''
        };
        $tags = $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}terms 
             {$tag_order_sql} 
             WHERE term_id IN (
                 SELECT term_id FROM {$wpdb->prefix}term_taxonomy 
                 WHERE taxonomy = 'post_tag'
             )", 
            ARRAY_A
        );
    
        // 6. 循环处理文章标签
        $processed_count = 0;
        foreach ($list as $val) {
            $post_id = $val['ID'];
            // 6.1 获取文章已有标签数量（优化为单条聚合查询）
            $existing_tag_count = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships AS a 
                     JOIN {$wpdb->prefix}term_taxonomy AS b ON a.term_taxonomy_id = b.term_taxonomy_id 
                     WHERE a.object_id = %d AND b.taxonomy = 'post_tag'", 
                    $post_id
                )
            );
    
            // 6.2 标签数量不同时的处理逻辑
            if ($existing_tag_count === $tag_num) {
                continue;
            } elseif ($existing_tag_count < $tag_num) {
                $this->handleTagAddition($wpdb, $post_id, $existing_tag_count, $tag_num, $tags, $baiduseo_tag, $val);
            } elseif ($existing_tag_count > $tag_num) {
                $this->handleTagReduction($wpdb, $post_id, $existing_tag_count, $tag_num, $val);
            }
            $processed_count++;
        }
    
        // 7. 返回进度信息
        $percent = round(100 * ($start + $processed_count) / $total, 2) . '%';
        echo json_encode([
            'num' => $num, 
            'percent' => $percent, 
            'page' => $page, 
            'tag_num' => $tag_num, 
            'code' => 1
        ]);
        exit;
    }
    
    /**
     * 处理「标签数量不足时添加标签」的逻辑
     */
    private function handleTagAddition($wpdb, $post_id, $existing_count, $target_count, $tags, $baiduseo_tag, $post_data) {
        $need_add = $target_count - $existing_count;
        $added = 0;
        $post_content = get_post($post_id)->post_content;
        $preg_rule = baiduseo_tag::BaiduSEO_preg($v['name']); // 假设方法入参可优化，此处需确保逻辑正确
    
        foreach ($tags as $tag) {
            if ($added >= $need_add) break;
    
            $term_taxonomy = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM {$wpdb->prefix}term_taxonomy 
                     WHERE term_id = %d AND taxonomy = 'post_tag'", 
                    $tag['term_id']
                ), 
                ARRAY_A
            );
            if (empty($term_taxonomy)) continue;
    
            $has_relation = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships 
                     WHERE object_id = %d AND term_taxonomy_id = %d", 
                    $post_id, 
                    $term_taxonomy['term_taxonomy_id']
                )
            );
            if ($has_relation > 0) continue;
    
            // 正则匹配内容（根据配置判断是否过滤特定标签）
            $pattern = isset($baiduseo_tag['hremove']) && $baiduseo_tag['hremove'] == 1 
                ? "{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))($preg_rule)(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i" 
                : "{(?!((<.*?)|(<a.*?)))($preg_rule)(?!(([^<>]*?)>)|([^>]*?<\/a>))}i";
            
            if (preg_match($pattern, $post_content, $matches)) {
                $insert_result = $wpdb->insert(
                    $wpdb->prefix . "term_relationships", 
                    [
                        'object_id' => $post_id, 
                        'term_taxonomy_id' => $term_taxonomy['term_taxonomy_id']
                    ]
                );
                if ($insert_result) {
                    $added++;
                    // 更新标签关联计数
                    $new_count = $wpdb->get_var(
                        $wpdb->prepare(
                            "SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships 
                             WHERE term_taxonomy_id = %d", 
                            $term_taxonomy['term_taxonomy_id']
                        )
                    );
                    $wpdb->update(
                        $wpdb->prefix . "term_taxonomy", 
                        ['count' => $new_count], 
                        ['term_taxonomy_id' => $term_taxonomy['term_taxonomy_id']]
                    );
                }
            }
        }
    }
    
    /**
     * 处理「标签数量过多时删除标签」的逻辑
     */
    private function handleTagReduction($wpdb, $post_id, $existing_count, $target_count, $post_data) {
        $need_remove = $existing_count - $target_count;
        $removed = 0;
    
        $tag_relations = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}term_relationships 
                 WHERE object_id = %d AND term_taxonomy_id IN (
                     SELECT term_taxonomy_id FROM {$wpdb->prefix}term_taxonomy 
                     WHERE taxonomy = 'post_tag'
                 )", 
                $post_id
            ), 
            ARRAY_A
        );
        if (empty($tag_relations)) return;
    
        foreach ($tag_relations as $relation) {
            if ($removed >= $need_remove) break;
    
            $delete_result = $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM {$wpdb->prefix}term_relationships 
                     WHERE object_id = %d AND term_taxonomy_id = %d", 
                    $post_id, 
                    $relation['term_taxonomy_id']
                )
            );
            if ($delete_result) {
                $removed++;
                // 更新标签关联计数
                $new_count = $wpdb->get_var(
                    $wpdb->prepare(
                        "SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships 
                         WHERE term_taxonomy_id = %d", 
                        $relation['term_taxonomy_id']
                    )
                );
                $wpdb->update(
                    $wpdb->prefix . "term_taxonomy", 
                    ['count' => $new_count], 
                    ['term_taxonomy_id' => $relation['term_taxonomy_id']]
                );
            }
        }
    }
     public function baiduseo_add_pltag(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $type = isset($_POST['type'])?(int)$_POST['type']:0;
            if(isset($_POST['keywords'])){
                $keywords = array_map('sanitize_text_field', explode(',', wp_unslash($_POST['keywords'])));
            }
            global $baiduseo_wzt_log,$wpdb;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
             global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            $baiduseo_tag_manage = get_option('baiduseo_tag');
            if(!empty($keywords)){
                if($type==1){
                    foreach($keywords as $key=>$val){
                        $terms = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag" and a.name=%s',$val),ARRAY_A);
                        if(!$terms){
                             $term = wp_insert_term(
                                $val,    // 标签名称
                                'post_tag'  // 分类法类型
                            );
                            $id = $term['term_id'];
                            if(!isset($baiduseo_tag_manage['taglink']) || !$baiduseo_tag_manage['taglink']){
                                $wpdb->update($wpdb->prefix . 'terms',['slug'=>$id],['term_id'=>$id]);
                            }
                            $id_1 = $term['term_taxonomy_id'];
                            
                            if($baiduseo_tag_manage){
                                if(isset($baiduseo_tag_manage['auto']) && $baiduseo_tag_manage['auto']){
                                    $article = $wpdb->get_results('select * from '.$wpdb->prefix . 'posts where  post_status="publish" and post_type="post" order by ID desc limit 1000',ARRAY_A);
                                    if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
                                        
                                        foreach($article as $k=>$v){
                                           if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                 if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',$v['post_content'],$matches))
                                                {
                                                    $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                    $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                    $count = $term_taxonomy[0]['count']+1;
                                                    $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                }
                                           }else{
                                                 if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                {
                                                    $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                    $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                    $count = $term_taxonomy[0]['count']+1;
                                                    $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                }
                                           }
                                          
                                        }
                                    }else{
                                        foreach($article as $k=>$v){
                                            $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$v['ID']));
                                            if($shu>=$baiduseo_tag_manage['num']){
                                                break;
                                            }else{
                                                if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                    if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                                }else{
                                                    if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                                }
                                                
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }elseif($type==2){
                    foreach($keywords as $key=>$val){
                        $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords =%s ",$val),ARRAY_A);
                        if(empty($post1)){
                         $wpdb->insert($wpdb->prefix."baiduseo_neilian",['keywords'=>$val,'link'=>'/',]);
                        }
                    }
                }
            
            }
             echo json_encode(['msg'=>'导入成功','code'=>1]);
            exit;
        }
         echo json_encode(['msg'=>'导入失败','code'=>0]);
        exit;
       
    }
    public function baiduseo_add_tag(){
        
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $keyword = isset($_POST['keyword'])?sanitize_text_field(wp_unslash($_POST['keyword'])):'';
            $type = isset($_POST['type'])?(int)$_POST['type']:0;
            global $baiduseo_wzt_log,$wpdb;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
            $baiduseo_tag_manage = get_option('baiduseo_tag');
            if($type==1){
                $terms = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag" and a.name=%s',$keyword),ARRAY_A);
                if(!$terms){
                    $term = wp_insert_term(
                            $keyword,    // 标签名称
                            'post_tag'  // 分类法类型
                        );
                                
                    $id = $term['term_id'];
                    // $res = $wpdb->insert($wpdb->prefix."terms",['name'=>$tag[0]]);
                    
                    //  $id = $wpdb->insert_id;
                    if(!isset($baiduseo_tag_manage['taglink']) || !$baiduseo_tag_manage['taglink']){
                        $wpdb->update($wpdb->prefix . 'terms',['slug'=>$id],['term_id'=>$id]);
                    }
                    // $wpdb->insert($wpdb->prefix."term_taxonomy",['term_id'=>$id,'taxonomy'=>'post_tag']);
                
                    $id_1 = $term['term_taxonomy_id'];
                    
                    if($baiduseo_tag_manage){
                        if(isset($baiduseo_tag_manage['auto']) && $baiduseo_tag_manage['auto']){
                            $article = $wpdb->get_results('select * from '.$wpdb->prefix . 'posts where  post_status="publish" and post_type="post" order by ID desc limit 1000',ARRAY_A);
                            if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
                                
                                foreach($article as $k=>$v){
                                    if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                          if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',$v['post_content'],$matches))
                                        {
                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                            $count = $term_taxonomy[0]['count']+1;
                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                        }
                                    }else{
                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                        {
                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                            $count = $term_taxonomy[0]['count']+1;
                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                        }
                                    }
                                }
                            }else{
                                foreach($article as $k=>$v){
                                    $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$v['ID']));
                                    if($shu>=$baiduseo_tag_manage['num']){
                                        break;
                                    }else{
                                        if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                            if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',$v['post_content'],$matches))
                                            {
                                                $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                        
                                                $count = $term_taxonomy[0]['count']+1;
                                                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                            }
                                        }else{
                                             if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                            {
                                                $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                        
                                                $count = $term_taxonomy[0]['count']+1;
                                                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                            }
                                        }
                                       
                                    }
                                }
                            }
                        }
                    }
                }
            }elseif($type==2){
                 $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords =%s ",$keyword),ARRAY_A);
                if(empty($post1)){
                 $wpdb->insert($wpdb->prefix."baiduseo_neilian",['keywords'=>$keyword,'link'=>'/',]);
                }
               
            }
            echo json_encode(['msg'=>'导入成功','code'=>1]);
                exit;
        }
        echo json_encode(['msg'=>'导入失败','code'=>0]);
                exit;
        
    }
    public function baiduseo_tag_add(){
       
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            if(isset($_POST['content']) && sanitize_textarea_field(wp_unslash($_POST['content']))){
                global $baiduseo_wzt_log;
                if(!$baiduseo_wzt_log){
                      echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
                $log = baiduseo_zz::pay_money();
                if(!$log){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
                $content = explode("\n",sanitize_textarea_field(wp_unslash($_POST['content'])));
                $baiduseo_tag_manage = get_option('baiduseo_tag');
                if(!empty($content)){
                    global $wpdb;
                    
                    foreach($content as $key=>$val){
                        $tag = explode(',',$val);
                        if(isset($tag[1])){
                            $res = $wpdb->insert($wpdb->prefix."baiduseo_neilian",['keywords'=>$tag[0],'link'=>$tag[1],]);
                        }else{
                            $terms = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag" and a.name=%s',$tag[0]),ARRAY_A);
                           
                            if(!$terms){
                                $term = wp_insert_term(
                                    $tag[0],    // 标签名称
                                    'post_tag'  // 分类法类型
                                );
                                
                                $id = $term['term_id'];
                                // $res = $wpdb->insert($wpdb->prefix."terms",['name'=>$tag[0]]);
                                
                                //  $id = $wpdb->insert_id;
                                if(!isset($baiduseo_tag_manage['taglink']) || !$baiduseo_tag_manage['taglink']){
                                    $wpdb->update($wpdb->prefix . 'terms',['slug'=>$id],['term_id'=>$id]);
                                }
                                // $wpdb->insert($wpdb->prefix."term_taxonomy",['term_id'=>$id,'taxonomy'=>'post_tag']);
                            
                                $id_1 = $term['term_taxonomy_id'];
                               
                                if($baiduseo_tag_manage){
                                    
                                    if(isset($baiduseo_tag_manage['auto']) && $baiduseo_tag_manage['auto']){
                                        $article = $wpdb->get_results('select * from '.$wpdb->prefix . 'posts where  post_status="publish" and post_type="post" order by ID desc limit 1000',ARRAY_A);
                                        if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
                                            
                                            foreach($article as $k=>$v){
                                               if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                    if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                               }else{
                                                   if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                               }
                                               
                                            }
                                        }else{
                                            foreach($article as $k=>$v){
                                                $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$v['ID']));
                                                if($shu>=$baiduseo_tag_manage['num']){
                                                    break;
                                                }else{
                                                    if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                        if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',$v['post_content'],$matches))
                                                        {
                                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                    
                                                            $count = $term_taxonomy[0]['count']+1;
                                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                        }
                                                    }else{
                                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                        {
                                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                    
                                                            $count = $term_taxonomy[0]['count']+1;
                                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                        }
                                                    }
                                                    
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                           
                            
                        }
                    }
                }
            }else{
                echo json_encode(['code'=>0,'msg'=>'请输入关键词']);exit;
            }
            echo json_encode(['code'=>1,'msg'=>'添加成功']);exit;
        }
        echo json_encode(['code'=>0,'msg'=>'添加失败']);exit;
    }
    public function baiduseo_rank(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
              global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            
            $baiduseo_rank = get_option('baiduseo_rank');
            $ur=  baiduseo_common::baiduseo_url(0);
            $url = 'https://art.seohnzz.com/api/rank/get_rank?url='.$ur.'&http='.get_option('siteurl');
            $defaults = array(
                'timeout' => 4000,
                'redirection' => 4000,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            $result = wp_remote_retrieve_body($result);
            if($result){
                $result = json_decode($result,true);
                if($result['code']){
                    if($baiduseo_rank!==false){
                        update_option('baiduseo_rank',$result['data']);
                    }else{
                        add_option('baiduseo_rank',$result['data']);
                    }
                    echo json_encode(['code'=>1,'data'=>$result['data']]);exit;
                }else{
                    echo json_encode(['code'=>0,'msg'=>'24小时只能查询一次']);exit;
                }
            }else{
                echo json_encode(['code'=>0,'msg'=>'查询失败']);exit;
            }
            
            
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_301(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $site_url = baiduseo_common::baiduseo_url(0).'/';
            $site_url1 = baiduseo_common::baiduseo_url(1);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
            $url = str_replace('www.','',$site_url);
            
            $url1 = $http_type.$url;
            $url2 = $http_type.'www.'.$url;
            $url_301['status'] = 0;
            $result = wp_remote_get($url1,$defaults);
            if(!is_wp_error($result)){
              $http = (array)$result['http_response'];
              
              $url_301['re_url1'] = $http["\0*\0response"]->url;
            }else{
               $url_301['re_url1'] =''; 
            }
            $result1 = wp_remote_get($url2,$defaults);
            if(!is_wp_error($result1)){
              $http1 = (array)$result1['http_response'];
              
              
              $url_301['re_url2'] = $http1["\0*\0response"]->url;
            }else{
                $url_301['re_url2'] ='';
            }
           
             if( trim($url_301['re_url2'],'/')==trim($site_url1,'/') || trim($url_301['re_url1'],'/')==trim($site_url1,'/')){
                echo json_encode(['msg'=>'恭喜您，您的301状态正常，无需设置！','code'=>1]);exit; 
            }else{
                echo json_encode(['code'=>0]);exit; 
            }
        
        }
        echo json_encode(['code'=>0]);exit; 
    }
    public function baiduseo_zhizhu_clear(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                  echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            global $wpdb;
            $res = $wpdb->query( "DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  " );
            if($res){
            echo json_encode(['code'=>1]);exit; 
            }
        }
        echo json_encode(['msg'=>'删除失败','code'=>0]);exit;
    }
    public function baiduseo_zhizhu_linkdelete(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $wpdb;
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
           
            $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu where id=%d",$id));
            echo json_encode(['code'=>1]);exit; 
        }
         echo json_encode(['code'=>0]);exit; 
    }
    public function baiduseo_tag(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
             global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            baiduseo_tag::baiduseo_tag_set($_POST);
            
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }

    public function baiduseo_youhua(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $data = [
                'thumb'=>isset($_POST['thumb'])?(int)$_POST['thumb']:0,
                'head_dy'=>isset($_POST['head_dy'])?(int)$_POST['head_dy']:0,
                'xml_rpc'=>isset($_POST['xml_rpc'])?(int)$_POST['xml_rpc']:0,
                'feed'=>isset($_POST['feed'])?(int)$_POST['feed']:0,
                'post_thumb'=>isset($_POST['post_thumb'])?(int)$_POST['post_thumb']:0,
                'gravatar'=>isset($_POST['gravatar'])?(int)$_POST['gravatar']:0,
                'lan'=>isset($_POST['lan'])?(int)$_POST['lan']:0,
                'category'=>isset($_POST['category'])?(int)$_POST['category']:0,
                'listbtn'=>isset($_POST['listbtn'])?(int)$_POST['listbtn']:0,
                'wp_json'=>isset($_POST['wp_json'])?(int)$_POST['wp_json']:0,
                'art_cron'=>isset($_POST['art_cron'])?(int)$_POST['art_cron']:0,
            ];
            $baidu = get_option('baiduseo_youhua');
            if($baidu!==false){
                update_option('baiduseo_youhua',$data);
            }else{
                add_option('baiduseo_youhua',$data);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_zz(){
        global $wpdb,$baiduseo_wzt_log;
        
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
             global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
            $indexnow_key = isset($_POST['indexnow_key'])?sanitize_text_field(wp_unslash($_POST['indexnow_key'])):'';
            
            $seo_baidu_xzh =[                               
                'zz_link'=>isset($_POST['zz_link'])?sanitize_url(wp_unslash($_POST['zz_link'])):'',                                   
                'bing_key'=>isset($_POST['bing_key'])?sanitize_text_field(wp_unslash($_POST['bing_key'])):'', 
                // 'shenma_key' =>isset($_POST['shenma_key'])?sanitize_url(wp_unslash($_POST['shenma_key'])):"",
                'toutiao_key'=>isset($_POST['toutiao_key'])?sanitize_text_field(wp_unslash($_POST['toutiao_key'])):"",
                'indexnow_key'=>$indexnow_key,
                'google_api'=>isset($_POST['google_api'])?stripslashes(sanitize_textarea_field(wp_unslash($_POST['google_api']))):"",
                // 'indexnow_pingtai'=>isset($_POST['indexnow_pingtai'])?sanitize_text_field(wp_unslash($_POST['indexnow_pingtai'])):"",
                'post_type'=>isset($_POST['post_type'])?sanitize_text_field(wp_unslash($_POST['post_type'])):"",
                // 'baiduseo_type'=>sanitize_text_field($_POST['baiduseo_type']),
                // 'post_type'=>isset($_POST['bing_key'])?sanitize_text_field($_POST['post_type']),
                'status'=>isset($_POST['status'])?sanitize_text_field(wp_unslash($_POST['status'])):'',
                'pingtai'=>isset($_POST['pingtai'])?sanitize_text_field(wp_unslash($_POST['pingtai'])):'',
                'guowai_num'=>isset($_POST['guowai_num'])?(int)$_POST['guowai_num']:0,
                'bdpt_num'=>isset($_POST['bdpt_num'])?(int)$_POST['bdpt_num']:0,
                'bing_num'=>isset($_POST['bing_num'])?(int)$_POST['bing_num']:0,
                // 'sm_num'=>isset($_POST['sm_num'])?(int)$_POST['sm_num']:"",
                // 'log'=>isset($_POST['log'])?sanitize_text_field(wp_unslash($_POST['log'])):"",
                'bd_log'=>isset($_POST['bd_log'])?(int)$_POST['bd_log']:0,
                'bd_log_show'=>isset($_POST['bd_log_show'])?(int)$_POST['bd_log_show']:0,
                // 'bdks_log'=>isset($_POST['bdks_log'])?(int)$_POST['bdks_log']:"",
                'bing_log'=>isset($_POST['bing_log'])?(int)$_POST['bing_log']:0,
                'bing_log_show'=>isset($_POST['bing_log_show'])?(int)$_POST['bing_log_show']:0,
                 'seznam_log'=>isset($_POST['seznam_log'])?(int)$_POST['seznam_log']:0,
                'seznam_log_show'=>isset($_POST['seznam_log_show'])?(int)$_POST['seznam_log_show']:0,
                'indexNow_log'=>isset($_POST['indexNow_log'])?(int)$_POST['indexNow_log']:0,
                'indexNow_log_show'=>isset($_POST['indexNow_log_show'])?(int)$_POST['indexNow_log_show']:0,
                  'indexNow_bing_log'=>isset($_POST['indexNow_bing_log'])?(int)$_POST['indexNow_bing_log']:0,
                'indexNow_bing_log_show'=>isset($_POST['indexNow_bing_log_show'])?(int)$_POST['indexNow_bing_log_show']:0,
                'guge_log'=>isset($_POST['guge_log'])?(int)$_POST['guge_log']:0,
                'guge_log_show'=>isset($_POST['guge_log_show'])?(int)$_POST['guge_log_show']:0,
                  'yandex_log'=>isset($_POST['yandex_log'])?(int)$_POST['yandex_log']:0,
                'yandex_log_show'=>isset($_POST['yandex_log_show'])?(int)$_POST['yandex_log_show']:0,  
                'naver_log'=>isset($_POST['naver_log'])?(int)$_POST['naver_log']:0,
                'naver_log_show'=>isset($_POST['naver_log_show'])?(int)$_POST['naver_log_show']:0,  
                'yep_log'=>isset($_POST['yep_log'])?(int)$_POST['yep_log']:0,
                'yep_log_show'=>isset($_POST['yep_log_show'])?(int)$_POST['yep_log_show']:0,
                
            ];
            if($indexnow_key){
                WP_Filesystem();
                global $wp_filesystem;
                $res = $wp_filesystem->put_contents (ABSPATH.'/'.$indexnow_key.'.txt',$indexnow_key);
                
            }
            
            $baidu = get_option('baiduseo_zz');
            if($baidu!==false){
                update_option('baiduseo_zz',$seo_baidu_xzh);
            }else{
                add_option('baiduseo_zz',$seo_baidu_xzh);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
       
        
            
            
    }
    public function baiduseo_seo(){
       
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
             global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
             global $baiduseo_key;
            if(!$baiduseo_key){ 
                $ss  = baiduseo_zz::pay_money();
                if(!$ss){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
           baiduseo_seo::seo_index(isset($_POST['keywords'])?sanitize_text_field(wp_unslash($_POST['keywords'])):'',isset($_POST['description'])?sanitize_textarea_field(wp_unslash($_POST['description'])):'');
           
            if(isset($_POST['cate'])){
                baiduseo_seo::cate_seo(isset($_POST['cate_keywords'])?sanitize_text_field(wp_unslash($_POST['cate_keywords'])):'',isset($_POST['cate_description'])?sanitize_textarea_field(wp_unslash($_POST['cate_description'])):'',(int)$_POST['cate']);
            }
            if(isset($_POST['page'])){
                baiduseo_seo::page_seo(isset($_POST['page_keywords'])?sanitize_text_field(wp_unslash($_POST['page_keywords'])):'',isset($_POST['page_description'])?sanitize_text_field(wp_unslash($_POST['page_description'])):'',(int)$_POST['page']);
            }
            if(isset($_POST['page_404']) && (int)$_POST['page_404']){
                baiduseo_seo::page_404();
            }else{
                $seo_301_404_url = get_option('seo_301_404_url');
                if($seo_301_404_url!=false){
                    update_option('seo_301_404_url',['404_url'=>0]);
                }else{
                    add_option('seo_301_404_url',['404_url'=>0]);
                }
            }
            if(isset($_POST['robots'])){
                baiduseo_seo::robots(sanitize_textarea_field(wp_unslash($_POST['robots'])));
            }
            
            $sitemap = get_option('seo_baidu_sitemap');
            if($sitemap!==false && !is_array($sitemap)){
                // $data = $sitemap;
                 $data['level1'] = isset($_POST['level1'])?(int)$_POST['level1']:0;
                $data['level2'] = isset($_POST['level2'])?(int)$_POST['level2']:0;
                $data['level3'] = isset($_POST['level3'])?(int)$_POST['level3']:0;
                $data['level4'] = isset($_POST['level4'])?(int)$_POST['level4']:0;
                $data['level5'] = isset($_POST['level5'])?(int)$_POST['level5']:0;
                $data['type1'] = isset($_POST['type1'])?(int)$_POST['type1']:0;
                $data['type2'] = isset($_POST['type2'])?(int)$_POST['type2']:0;
                $data['type3'] = isset($_POST['type3'])?(int)$_POST['type3']:0;
                $data['type4'] = isset($_POST['type4'])?(int)$_POST['type4']:0;
                $data['type5'] = isset($_POST['type5'])?(int)$_POST['type5']:0;
                $data['page_time'] = isset($_POST['page_time'])?sanitize_text_field(wp_unslash($_POST['page_time'])):"";
                $data['post_time'] = isset($_POST['post_time'])?sanitize_text_field(wp_unslash($_POST['post_time'])):"";
                $data['tag_time'] = isset($_POST['tag_time'])?sanitize_text_field(wp_unslash($_POST['tag_time'])):"";
                $data['other_time'] = isset($_POST['other_time'])?sanitize_text_field(wp_unslash($_POST['other_time'])):"";
                $data['cate_time'] = isset($_POST['cate_time'])?sanitize_text_field(wp_unslash($_POST['cate_time'])):"";
                $data['sitemap_open'] = isset($_POST['sitemap_open'])?(int)$_POST['sitemap_open']:"";
                $data['silian_open'] = isset($_POST['silian_open'])?(int)$_POST['silian_open']:"";
                update_option('seo_baidu_sitemap',$data);
            }elseif($sitemap!==false && is_array($sitemap)){
                $data = $sitemap;
                $data['level1'] = isset($_POST['level1'])?(int)$_POST['level1']:0;
                $data['level2'] = isset($_POST['level2'])?(int)$_POST['level2']:0;
                $data['level3'] = isset($_POST['level3'])?(int)$_POST['level3']:0;
                $data['level4'] = isset($_POST['level4'])?(int)$_POST['level4']:0;
                $data['level5'] = isset($_POST['level5'])?(int)$_POST['level5']:0;
                $data['type1'] = isset($_POST['type1'])?(int)$_POST['type1']:0;
                $data['type2'] = isset($_POST['type2'])?(int)$_POST['type2']:0;
                $data['type3'] = isset($_POST['type3'])?(int)$_POST['type3']:0;
                $data['type4'] = isset($_POST['type4'])?(int)$_POST['type4']:0;
                $data['type5'] = isset($_POST['type5'])?(int)$_POST['type5']:0;
                $data['page_time'] = isset($_POST['page_time'])?sanitize_text_field(wp_unslash($_POST['page_time'])):"";
                $data['post_time'] = isset($_POST['post_time'])?sanitize_text_field(wp_unslash($_POST['post_time'])):"";
                $data['tag_time'] = isset($_POST['tag_time'])?sanitize_text_field(wp_unslash($_POST['tag_time'])):"";
                $data['other_time'] = isset($_POST['other_time'])?sanitize_text_field(wp_unslash($_POST['other_time'])):"";
                $data['cate_time'] = isset($_POST['cate_time'])?sanitize_text_field(wp_unslash($_POST['cate_time'])):"";
                $data['sitemap_open'] = isset($_POST['sitemap_open'])?(int)$_POST['sitemap_open']:"";
                $data['silian_open'] = isset($_POST['silian_open'])?(int)$_POST['silian_open']:"";
                update_option('seo_baidu_sitemap',$data);
            }else{
                 $data['level1'] = isset($_POST['level1'])?(int)$_POST['level1']:0;
                $data['level2'] = isset($_POST['level2'])?(int)$_POST['level2']:0;
                $data['level3'] = isset($_POST['level3'])?(int)$_POST['level3']:0;
                $data['level4'] = isset($_POST['level4'])?(int)$_POST['level4']:0;
                $data['level5'] = isset($_POST['level5'])?(int)$_POST['level5']:0;
                $data['type1'] = isset($_POST['type1'])?(int)$_POST['type1']:0;
                $data['type2'] = isset($_POST['type2'])?(int)$_POST['type2']:0;
                $data['type3'] = isset($_POST['type3'])?(int)$_POST['type3']:0;
                $data['type4'] = isset($_POST['type4'])?(int)$_POST['type4']:0;
                $data['type5'] = isset($_POST['type5'])?(int)$_POST['type5']:0;
                $data['page_time'] = isset($_POST['page_time'])?sanitize_text_field(wp_unslash($_POST['page_time'])):"";
                $data['post_time'] = isset($_POST['post_time'])?sanitize_text_field(wp_unslash($_POST['post_time'])):"";
                $data['tag_time'] = isset($_POST['tag_time'])?sanitize_text_field(wp_unslash($_POST['tag_time'])):"";
                $data['other_time'] = isset($_POST['other_time'])?sanitize_text_field(wp_unslash($_POST['other_time'])):"";
                $data['cate_time'] = isset($_POST['cate_time'])?sanitize_text_field(wp_unslash($_POST['cate_time'])):"";
                $data['sitemap_open'] = isset($_POST['sitemap_open'])?(int)$_POST['sitemap_open']:"";
                $data['silian_open'] = isset($_POST['silian_open'])?(int)$_POST['silian_open']:"";
                add_option('seo_baidu_sitemap',$data);  
            }
            baiduseo_seo::alt(isset($_POST['alt'])?(int)$_POST['alt']:0,isset($_POST['title'])?(int)$_POST['title']:0);
            if(isset($_POST['sitemap_open']) && (int)$_POST['sitemap_open']==1){
            baiduseo_seo::sitemap(1,1,1);
            }
            if(isset($_POST['silian_open']) && (int)$_POST['silian_open']==1){
                baiduseo_seo::silian(1,1);
            }
            echo json_encode(['msg'=>'','code'=>1]);exit;
        }else{
             echo json_encode(['msg'=>'','code'=>0]);exit;
        }
    }

    public function baiduseo_wycsc(){
        if(isset($_POST['nonce']) &&  wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])),'baiduseo')){
            $id = isset($_POST['id'])?(int)$_POST['id']:'';
            delete_post_meta($id,'baiduseo');
            echo json_encode(['code'=>'1','msg'=>'删除成功']);exit;
        }
        echo json_encode(['code'=>'0','msg'=>'删除失败']);exit;
    }
}