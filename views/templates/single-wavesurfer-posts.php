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
        $related_woo_product = get_post_meta(get_the_ID(), 'ws_post_audio_product', true);

        echo '<div class="ws_post_column">';

        the_date( 'Y-m-d', '<h4 class="on-date">', '</h4>' );

        if (!empty($current_file_url)) {
            echo '<div id="waveform-' . get_the_ID() . '" 
                file-url="' . $current_file_url . '"
                wave-color="' . WS_Posts_Settings::$options['ws_posts_wave_color'] . '"
                progress-color="' . WS_Posts_Settings::$options['ws_posts_progress_color'] . '"
                cursor-color="' . WS_Posts_Settings::$options['ws_posts_cursor_color'] . '"></div>';
            echo '<button class="wsbtn wsbtn-play" id="wsbtn-' . get_the_ID() . '" onClick="playStop(`' . get_the_ID() . '`)"><span>Play</span></button>';
        }

        echo '<a href="' . $current_file_url . '" download><button>DOWNLOAD</button></a>';

        echo '<span class="ws-info">' . $current_info . '</span>';

        // related woo product
        echo '<div class="ws-related-product"><span>This sample is part of this loop pack:</span>';
        
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'p' => $related_woo_product
        );
        $loop = new WP_Query($args);
        if ($loop->have_posts()) {
            while ($loop->have_posts()) : $loop->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
        } else {
            echo __('No products found');
        }
        wp_reset_postdata();
        
        echo '</div>';

        echo '</div>';
    }
    ?>
</div>

<?php get_footer(); ?>