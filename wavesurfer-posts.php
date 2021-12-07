<?php

/**
 * Plugin Name: Wavesurfer posts
 * Plugin URI: https://wordpress.org
 * Description: Custom posts with Wavesurfer
 * Version: 1.0
 * Requires at least: 5.6
 * Author: TB
 * Author URI: https://trapchords.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wavesurfer-posts
 * Domain Path: /languages
 */

if(!defined('ABSPATH')) {
    exit;
}

if(!class_exists('WS_Posts')) {
    class WS_Posts {
        function __construct() {
            $this->define_constants();

            require_once( WS_POSTS_PATH . 'post-types/class-ws-posts-cpt.php' );
            $WS_Post_Type = new WS_Post_Type();
        }

        public function define_constants() {
            define('WS_POSTS_PATH', plugin_dir_path( __FILE__ ));
            define('WS_POSTS_URL', plugin_dir_url( __FILE__ ));
            define('WS_POSTS_VERSION', '1.0.0');
        }

        public static function activate() {
            update_option( 'rewrite_rules', '' );
        }

        public static function deactivate() {
            flush_rewrite_rules();
            unregister_post_type('wavesurfer-posts');
        }

        public static function uninstall() {

        }
    }
}

if(class_exists('WS_Posts')) {
    register_activation_hook(__FILE__, array('WS_Posts', 'activate'));
    register_deactivation_hook(__FILE__, array('WS_Posts', 'deactivate'));
    register_uninstall_hook(__FILE__, array('WS_Posts', 'uninstall'));

    $ws_posts = new WS_Posts();
}