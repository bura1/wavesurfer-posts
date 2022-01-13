<?php get_header(); ?>

<div class="ws-posts-single">
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>

    <?php
    while (have_posts()) {
        the_post();

        $current_file_url = get_post_meta(get_the_ID(), 'ws_post_audio_file', true);
        $current_info = get_post_meta(get_the_ID(), 'ws_post_audio_info', true);
        $current_product_id = get_post_meta(get_the_ID(), 'ws_post_audio_product', true);

        echo '<div class="ws_post_column">';

        if (!empty($current_file_url)) {
            echo '<div id="waveform-' . get_the_ID() . '" 
                file-url="' . $current_file_url . '"
                wave-color="' . WS_Posts_Settings::$options['ws_posts_wave_color'] . '"
                progress-color="' . WS_Posts_Settings::$options['ws_posts_progress_color'] . '"
                cursor-color="' . WS_Posts_Settings::$options['ws_posts_cursor_color'] . '"></div>';
            echo '<button class="wsbtn wsbtn-play" id="wsbtn-' . get_the_ID() . '" onClick="playStop(`' . get_the_ID() . '`)"><span>Play</span></button>';
        }

        echo '</div>';
    }
    ?>
</div>

<?php get_footer(); ?>