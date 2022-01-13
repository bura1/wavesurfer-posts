<?php

// Allow uploading files
function update_edit_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');

// Register admin-only scripts
function my_admin_scripts() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-script-handle', plugin_dir_url( __FILE__ ) . 'assets/js/admin-color-picker.js', array('wp-color-picker'), false, true);
}
add_action('admin_enqueue_scripts', 'my_admin_scripts');

// Register custom scripts
function my_custom_scripts() {
    wp_register_script('ws-script-jquery', WS_POSTS_URL . 'vendor/wavesurfer/wavesurfer.js', array('jquery'), false, true);
    wp_register_script('ws-script-options', WS_POSTS_URL . 'vendor/wavesurfer/ws-script.js', array('jquery'), false, true);
    wp_register_style('ws-style', WS_POSTS_URL . 'vendor/wavesurfer/ws-style.css');
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');

// Enqueue script and style only for archive and single page
function enqueue_scripts_styles_for_templates(){
    if (is_singular('wavesurfer-posts') || is_post_type_archive('wavesurfer-posts')) {
        wp_enqueue_script('ws-script-jquery', WS_POSTS_URL . 'vendor/wavesurfer/wavesurfer.js', array('jquery'), false, true);
        wp_enqueue_script('ws-script-options', WS_POSTS_URL . 'vendor/wavesurfer/ws-script.js', array('jquery'), false, true);
        wp_enqueue_style('ws-style-custom', WS_POSTS_URL . 'assets/css/style.css');
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_styles_for_templates' );