<?php

// Allow uploading files
function update_edit_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');

// Register Wordpress color picker script
function custom_wp_color_picker_scripts() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-script-handle', plugin_dir_url( __FILE__ ) . 'assets/js/admin-color-picker.js', array('wp-color-picker'), false, true);
}
add_action('admin_enqueue_scripts', 'custom_wp_color_picker_scripts');