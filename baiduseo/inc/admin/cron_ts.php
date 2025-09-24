<?php
class baiduseo_cron_ts{
    public function init(){
        add_filter('cron_schedules', [$this,'baiduseo_cron_ts_verey']);
        if (!wp_next_scheduled('baiduseo_my_minute_task_hook')) {
            wp_schedule_event(current_time('timestamp',1), 'every_minute', 'baiduseo_my_minute_task_hook');
        }
        add_action('baiduseo_my_minute_task_hook', [$this,'baiduseo_my_minute_task']);
    }
   public function baiduseo_my_minute_task() {
       
        
       global $wpdb;
        
        $option_name = 'baiduseo_my_minute_task';
        
        // 直接查询数据库获取数据
        $result = $wpdb->get_var($wpdb->prepare(
            "SELECT option_value FROM {$wpdb->options} WHERE option_name = %s",
            $option_name
        ));
        
       
        
        $baiduseo_my_minute_task = [];
        
        if ($result) {
            // 反序列化数据
            $unserialized = unserialize($result);
            if ($unserialized !== false && is_array($unserialized)) {
                $baiduseo_my_minute_task = $unserialized;
            } else {
                // 尝试JSON解码
                $decoded = json_decode($result, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $baiduseo_my_minute_task = $decoded;
                }
            }
        }
        
      
        
        // 立即删除数据库记录
        $wpdb->delete(
            $wpdb->options,
            ['option_name' => $option_name],
            ['%s']
        );
        
        // 清除所有可能的缓存
        wp_cache_delete($option_name, 'options');
        wp_cache_delete('alloptions', 'options');
        
        if (!empty($baiduseo_my_minute_task)) {
            
            $baiduseo_zz = get_option('baiduseo_zz');
           
            
            if (isset($baiduseo_zz['status']) && is_string($baiduseo_zz['status']) && strpos($baiduseo_zz['status'], '1') !== false) {
                $log = baiduseo_zz::pay_money();
                
                if ($log) {
                    if (empty($baiduseo_zz['indexnow_key'])) {
                        $baiduseo_zz['indexnow_key'] = md5(esc_url(baiduseo_common::baiduseo_url(1)));
                    }
                    
                    $pingtai = isset($baiduseo_zz['pingtai']) ? explode(',', $baiduseo_zz['pingtai']) : [];
                    
                    
                    foreach($baiduseo_my_minute_task as $post_id) {
                        $url = get_permalink($post_id);
                        $urls = [$url];
                        
                        foreach($pingtai as $platform) {
                            if ($platform > 4) {
                               
                                baiduseo_zz::indexnow($urls, 0, 0, $platform);
                            }
                        }
                        
                        if (isset($baiduseo_zz['pingtai']) && is_string($baiduseo_zz['pingtai'])) {
                            if (strpos($baiduseo_zz['pingtai'], '1,') !== false) {
                                baiduseo_zz::bdts($urls);
                            }
                            if (strpos($baiduseo_zz['pingtai'], '2') !== false) {
                                baiduseo_zz::bing($urls);
                            }
                            if (strpos($baiduseo_zz['pingtai'], '4') !== false) {
                                baiduseo_zz::google(['url' => $url, 'type' => "URL_UPDATED"]);
                            }
                        }
                    }
                }
            }
        }
    }
    public function baiduseo_cron_ts_verey($schedules){
         // 添加每分钟执行的间隔
        if (!isset($schedules['every_minute'])) {
            $schedules['every_minute'] = array(
                'interval' => 60, // 间隔时间（秒）
                'display'  => __('Every Minute', 'baiduseo')
            );
        }
        return $schedules;
    }
}