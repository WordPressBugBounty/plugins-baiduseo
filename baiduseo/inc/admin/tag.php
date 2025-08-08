<?php
class baiduseo_tag{
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
            if ( ! function_exists( 'dbDelta' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            }
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_neilian'") !=  $wpdb->prefix."baiduseo_neilian"){
                $sql15 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_neilian   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    keywords varchar(255) NOT NULL ,
                    link varchar(255) NOT NULL ,
                    target bigint NOT NULL DEFAULT 0,
                    nofollow bigint NOT NULL DEFAULT 0,
                    sort int DEFAULT 0,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql15);
            }
            $res = $wpdb->query('Describe '.$wpdb->prefix.'baiduseo_neilian sort');
            
            if($res){
                 
            }else{
               $wpdb->query(' ALTER TABLE '.$wpdb->prefix.'baiduseo_neilian ADD COLUMN `sort` int DEFAULT 0');
            }
            
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_long'") !=  $wpdb->prefix."baiduseo_long"){
                $sql16 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_long   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    keywords varchar(255) NOT NULL ,
                    total bigint NOT NULL DEFAULT 0 ,
                    longs bigint NOT NULL DEFAULT 0,
                    collect bigint NOT NULL DEFAULT 0,
                    bidword bigint NOT NULL DEFAULT 0,
                    link varchar(255) NUll,
                    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    guo timestamp NULL,
                    size varchar(255) NOT NULL default '',
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql16);
            }
        }
    }
    public static function baiduseo_tag_set($data){
        $data1['link'] = isset($data['link'])?(int)$data['link']:0;   
        $data1['auto'] = isset($data['auto'])?(int)$data['auto']:0;  
        $data1['bold'] = isset($data['bold'])?(int)$data['bold']:0;
        $data1['taglink'] = isset($data['taglink'])?(int)$data['taglink']:0; 
        $data1['color'] = isset($data['color'])?sanitize_text_field(wp_unslash($data['color'])):'';  
        $data1['num'] = isset($data['num'])?(int)$data['num']:0;
        $data1['pp'] = isset($data['pp'])?(int)$data['pp']:0;
        $data1['nlnum'] = isset($data['nlnum'])?(int)$data['nlnum']:0;
        $data1['bqgl'] = isset($data['bqgl'])?sanitize_text_field(wp_unslash($data['bqgl'])):'';
        if(isset($data['hremove'])){
            $data1['hremove'] = (int)$data['hremove'];
        }else{
            $data1['hremove'] = 0;
        }
        $seo_init = get_option('baiduseo_tag');
        if($seo_init!==false){
        	$res = update_option('baiduseo_tag',$data1);
        }else{
        	$res = add_option('baiduseo_tag',$data1);
    	} 
    	
    	echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
    	
    }
    public static function auto_tag(){
        $baiduseo_tag_manage = get_option('baiduseo_tag');
        if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
            // $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
            $tags = $wpdb->get_results('select a.* from '.$wpdb->prefix .'terms as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_id=b.term_id where b.taxonomy="post_tag" ',ARRAY_A);
            foreach($tags as $k=>$v){
                 if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                        if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',get_post($post_ID)->post_content,$matches))
                		{
                			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
                			if($res){
                				$re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$res[0]['term_taxonomy_id'],$post_ID),ARRAY_A);
                				if(!$re){
                					$wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                					$term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d',$res[0]['term_taxonomy_id']),ARRAY_A);
                				
                	                $count = $term_taxonomy[0]['count']+1;
                	                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                				}
                			}
                		}
                 }else{
                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                		{
                			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
                			if($res){
                				$re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$res[0]['term_taxonomy_id'],$post_ID),ARRAY_A);
                				if(!$re){
                					$wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                					$term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d',$res[0]['term_taxonomy_id']),ARRAY_A);
                				
                	                $count = $term_taxonomy[0]['count']+1;
                	                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                				}
                			}
                		}
                 }
        	 
            }
        }else{
            $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d',$post_ID));
                if($shu<$baiduseo_tag_manage['num']){
                    $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
                    foreach($tags as $k=>$v){
                        
                        $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d',$post_ID));
                       
                        if($shu<$baiduseo_tag_manage['num']){
                            if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>)|([^>]*?<\/h[1-6]>))}i',get_post($post_ID)->post_content,$matches))
                        		{
                        			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
                        			if($res){
                        				$re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$post_ID,$res[0]['term_taxonomy_id']),ARRAY_A);
                        				if(!$re){
                        					$wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                        					$term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$res[0]['term_taxonomy_id']),ARRAY_A);
                        	                $count = $term_taxonomy[0]['count']+1;
                        	                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                        				}
                        			}
                        		
                                }
                            }else{
                        	    if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                        		{
                        			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
                        			if($res){
                        				$re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$post_ID,$res[0]['term_taxonomy_id']),ARRAY_A);
                        				if(!$re){
                        					$wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                        					$term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$res[0]['term_taxonomy_id']),ARRAY_A);
                        	                $count = $term_taxonomy[0]['count']+1;
                        	                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                        				}
                        			}
                        		
                                }
                            }
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
        $a = substr($key, 32, 2);
        $b = substr($key, 66, 2);
        $c = substr($key, 100, 4);
        $today = date_i18n('Ymd', current_time('timestamp'));
        $num = $c.$a.$b;
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
        $data =  baiduseo_common::baiduseo_url(0);
    	$url = "https://art.seohnzz.com/api/index/pay_money?url={$data}&type=1";
    	$defaults = array(
            'timeout' =>4000,
            'connecttimeout'=>4000,
            'redirection' => 3,
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'sslverify' => FALSE,
        );
    	$result = wp_remote_get($url,$defaults);
    	if(!is_wp_error($result)){
            $content = wp_remote_retrieve_body($result);
        	$content = json_decode($content,true);
        	if(isset($content['status']) && $content['status']==1){
        	    if(isset($content['token1']) && $content['token1']){
                    $baiduseo_wzt_token1 = get_option('baiduseo_wzt_token1');
                    if($baiduseo_wzt_token1===false){
                        add_option('baiduseo_wzt_token1',$content['token1']);
                    }else{
                        update_option('baiduseo_wzt_token1',$content['token1']);
                    }
                }
                if(isset($content['token2']) && $content['token2']){
                    $baiduseo_wzt_token2 = get_option('baiduseo_wzt_token2');
                    if($baiduseo_wzt_token2===false){
                        add_option('baiduseo_wzt_token2',$content['token2']);
                    }else{
                        update_option('baiduseo_wzt_token2',$content['token2']);
                    }
                }
                if(isset($content['token3']) && $content['token3']){
                    $baiduseo_wzt_token3 = get_option('baiduseo_wzt_token3');
                    if($baiduseo_wzt_token3===false){
                        add_option('baiduseo_wzt_token3',$content['token3']);
                    }else{
                        update_option('baiduseo_wzt_token3',$content['token3']);
                    }
                }
        	    return 1;
        	}
    	}else{
    	    return 0;
    	}
    }
    public static function BaiduSEO_preg($str)
    {
        $str=strtolower(trim($str));
    	$replace=array('\\','*','?','[','^',']','$','(',')','{','}','=','!','<','>','|',':','-',';','\'','\"','/','&','_','`');
        $str = str_replace($replace,'',$str);
        $str = str_replace('+','\+',$str);
         $str = str_replace('%','\%',$str);
        return $str;
    }
}
?>