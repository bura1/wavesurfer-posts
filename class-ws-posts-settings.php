<?php 

if(!class_exists('WS_Posts_Settings')) {
    class WS_Posts_Settings {
        public static $options;

        public function __construct() {
            self::$options = get_option('ws_posts_options');
            add_action('admin_init', array($this, 'admin_init'));
        }

        public function admin_init() {
            register_setting('ws_posts_group', 'ws_posts_options');

            add_settings_section(
                'ws_posts_main_section',
                'How it works?',
                null,
                'ws_posts_page1'
            );

            add_settings_field(
                'ws_posts_shortcode',
                'Shortcode',
                array($this, 'ws_posts_shortcode_callback'),
                'ws_posts_page1',
                'ws_posts_main_section'
            );
        }

        public function ws_posts_shortcode_callback() { ?>
            <span>Use shortcode [ws_posts] to display Wafesurfer posts archive</span> 
        <?php }
    }
}