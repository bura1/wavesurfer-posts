<?php

if(!class_exists('WS_Posts_Shortcode')) {
    class WS_Posts_Shortcode {
        public function __construct() {
            add_shortcode('ws_posts', array($this, 'add_shortcode'));
        }

        public function add_shortcode($atts = array(), $content = null, $tag = '') {
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            extract(shortcode_atts(
                array(
                    'num' => '5',
                    'orderby' => 'date'
                ),
                $atts,
                $tag
            ));

            return $num;
        }
    }
}