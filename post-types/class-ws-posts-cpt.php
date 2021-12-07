<?php

if(!class_exists('WS_Post_Type')) {
    class WS_Post_Type {
        function __construct() {
            add_action('init', array($this, 'create_post_type'));
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            add_action('save_post', array($this, 'save_post'), 10, 2);
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
                    'supports' => array('title'),
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

        public function add_meta_boxes() {
            add_meta_box(
                'wavesurfer_posts_meta_box',
                'Song',
                array($this, 'add_inner_meta_boxes'),
                'wavesurfer-posts',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes( $post ) {
            require_once(WS_POSTS_PATH . 'views/ws-posts_metabox.php');
        }

        public function save_post( $post_id ) {
            // security verification
            if (isset($_POST['ws_posts_nonce'])) {
                if (!wp_verify_nonce($_POST['ws_posts_nonce'], 'ws_posts_nonce')) {
                    return;
                }
            }

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            if (isset($_POST['post_type']) && $_POST['post_type'] === 'wavesurfer-posts') {
                if (!current_user_can('edit_page', $post_id)) {
                    return;
                } elseif (!current_user_can('edit_post', $post_id)) {
                    return;
                }
            }
            // end security verification

            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {

                $old_info_text = get_post_meta( $post_id, 'ws_post_audio_info', true );
                $new_info_text = $_POST['ws_post_audio_info'];

                if (!empty($_FILES['ws_post_audio_file']['name'])) {

                    $supported_types = array('audio/mpeg', 'audio/mpeg3', 'audio/x-mpeg', 'audio/x-mpeg-3');
                    $arr_file_type = wp_check_filetype(basename($_FILES['ws_post_audio_file']['name']));
                    $uploaded_type = $arr_file_type['type'];

                    if (in_array($uploaded_type, $supported_types)) {

                        if ( ! function_exists( 'wp_handle_upload' ) ) {
                            require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        }
                        $upload_overrides = array( 'test_form' => false );
                        $upload = wp_handle_upload($_FILES['ws_post_audio_file'], $upload_overrides);

                        if (isset($upload['error']) && $upload['error'] != 0) {
                            wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                        } else {
                            update_post_meta($post_id, 'ws_post_audio_file', $upload['url']);
                            update_post_meta($post_id, 'ws_post_audio_name', basename($upload['file']));
                        }
             
                    } else {
                        wp_die("The file type that you've uploaded is not .mp3");
                    }
                }

                if (empty($new_info_text)) {
                    update_post_meta($post_id, 'ws_post_audio_info', 'Add some text');
                } else {
                    update_post_meta($post_id, 'ws_post_audio_info', sanitize_text_field($new_info_text), $old_info_text);
                }
                
            }
        }
    }
}