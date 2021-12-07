<?php

if(!class_exists('WS_Post_Type')) {
    class WS_Post_Type {
        function __construct() {
            add_action('init', array($this, 'create_post_type'));
        }

        public function create_post_type() {
            register_post_type(
                'wavesurfer-posts',
                array(
                    'label' => 'Wavesurfer Post',
                    'description' => 'Wavesurfer Posts',
                    'labels' => array(
                        'name' => 'Wavesurfer Posts',
                        'singular_name' => 'Wavesurfer Post'
                    ),
                    'public' => true,
                    'supports' => array( 'title', 'editor' ),
                    'hierarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => false,
                    'can_export' => true,
                    'has_archive' => true,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-format-audio'
                )
            );
        }
    }
}