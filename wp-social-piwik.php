<?php
/*
Plugin Name: Social Piwik
Plugin URI: http://kanedo.net
Description: Integrates Piwik Campaigns to WP-Social
Version: 0.1
Author: Kanedo
Author URI: http://kanedo.net/
*/

class Kanedo_wp_social_piwik {

    public function __construct(){
        add_action( 'admin_notices', array( $this, 'initialize' ) ) ;
        add_filter('social_broadcast_permalink', array($this, 'filter_social_broadcast_permalink'),10, 3);
    }

    public function initialize(){
        if(!is_plugin_active("social/social.php")){
            $html = '<div class="error">';
            $html .= '<p>';
            $html .= __( 'You need to install and activate <a href="http://wordpress.org/extend/plugins/social">WP-Social Plugin</a> first.', 'advanced-google-analytics' );
            $html .= '</p>';
            $html .= '</div><!-- /.updated -->';
            echo $html;
        }
    }

    public function filter_social_broadcast_permalink($url, $post, $object){
        $args = array(
            "pk_campaign"   => "Wordpress Social Plugin",
            "pk_kwd"        => $object->key(),
        );
        $query = http_build_query($args);
        $p_url = $url."&".$query;
        return $p_url;
    }
}

$kanedo_wp_social_piwik = new Kanedo_wp_social_piwik();