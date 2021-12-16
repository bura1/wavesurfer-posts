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

            add_settings_section(
                'ws_posts_colors_section',
                'Select Wavesurfer Colors',
                null,
                'ws_posts_page2'
            );

            add_settings_field(
                'ws_posts_shortcode',
                'Shortcode',
                array($this, 'ws_posts_shortcode_callback'),
                'ws_posts_page1',
                'ws_posts_main_section'
            );

            add_settings_field(
                'ws_posts_wave_color',
                'Wave Color',
                array($this, 'ws_posts_wave_color_callback'),
                'ws_posts_page2',
                'ws_posts_colors_section'
            );

            add_settings_field(
                'ws_posts_progress_color',
                'Progress Color',
                array($this, 'ws_posts_progress_color_callback'),
                'ws_posts_page2',
                'ws_posts_colors_section'
            );

            add_settings_field(
                'ws_posts_cursor_color',
                'Cursor Color',
                array($this, 'ws_posts_cursor_color_callback'),
                'ws_posts_page2',
                'ws_posts_colors_section'
            );
        }

        public function ws_posts_shortcode_callback() { ?>
            <span>Use shortcode [ws_posts] to display Wafesurfer posts archive</span> 
        <?php }

        public function ws_posts_wave_color_callback() { ?>
            <input 
            id="ws_posts_wave_color" 
            class="color-picker" 
            name="ws_posts_options[ws_posts_wave_color]" 
            type="text" 
            value="<?php echo isset(self::$options['ws_posts_wave_color']) ? esc_attr(self::$options['ws_posts_wave_color']) : '' ?>" /> 
        <?php }

        public function ws_posts_progress_color_callback() { ?>
            <input 
            id="ws_posts_progress_color" 
            class="color-picker" 
            name="ws_posts_options[ws_posts_progress_color]" 
            type="text" 
            value="<?php echo isset(self::$options['ws_posts_progress_color']) ? esc_attr(self::$options['ws_posts_progress_color']) : '' ?>" /> 
        <?php }

        public function ws_posts_cursor_color_callback() { ?>
            <input 
            id="ws_posts_cursor_color" 
            class="color-picker" 
            name="ws_posts_options[ws_posts_cursor_color]" 
            type="text" 
            value="<?php echo isset(self::$options['ws_posts_cursor_color']) ? esc_attr(self::$options['ws_posts_cursor_color']) : '' ?>" /> 
        <?php }
    }
}