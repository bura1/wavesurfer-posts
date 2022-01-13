<?php get_header(); ?>

<div class="ws-posts-archive">
    <header class="page-header">
        <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
    </header>

    <?php
    $ws_posts = new WP_Query(
        array(
            'post_type' => 'wavesurfer-posts',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        )
    );

    if ($ws_posts->have_posts()) {
        while ($ws_posts->have_posts()) {
            $ws_posts->the_post();

            $current_file_url = get_post_meta(get_the_ID(), 'ws_post_audio_file', true);
            $current_info = get_post_meta(get_the_ID(), 'ws_post_audio_info', true);

            echo '<div class="ws_post_column">';

            echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';

            echo '<span class="ws-info">' . $current_info . '</span>';

            the_date( 'Y-m-d', '<h4 class="on-date">', '</h4>' );

            if (!empty($current_file_url)) {
                echo '<div id="waveform-' . get_the_ID() . '" 
                    file-url="' . $current_file_url . '"
                    wave-color="' . WS_Posts_Settings::$options['ws_posts_wave_color'] . '"
                    progress-color="' . WS_Posts_Settings::$options['ws_posts_progress_color'] . '"
                    cursor-color="' . WS_Posts_Settings::$options['ws_posts_cursor_color'] . '"></div>';
                echo '<button class="wsbtn wsbtn-play" id="wsbtn-' . get_the_ID() . '" onClick="playStop(`' . get_the_ID() . '`)"><span>Play</span></button>';
            }

            echo '<a href="' . get_the_permalink() . '"><button>CONTINUE</button></a>';

            echo '</div>';
        }
        wp_reset_postdata();
    }
    ?>
</div>

<?php get_footer(); ?>