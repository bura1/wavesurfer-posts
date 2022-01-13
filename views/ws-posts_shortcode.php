<?php

$args = array(  
    'post_type' => 'wavesurfer-posts',
    'post_status' => 'publish',
    'posts_per_page' => $num, 
    'orderby' => $orderby, 
    'order' => $order, 
);

$loop = new WP_Query( $args );

$count = 1;

echo '<div class="wavesurfer-posts">';

if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) {
        $loop->the_post();

        $current_file_url = get_post_meta(get_the_ID(), 'ws_post_audio_file', true);
        $current_info = get_post_meta(get_the_ID(), 'ws_post_audio_info', true);

        if ($count % 2 != 0) { echo '<div class="ws_post_row">';}

        echo '<div class="ws_post_column">';

        echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';

        if (!empty($current_file_url)) {
            echo '<div id="waveform-' . get_the_ID() . '" 
                file-url="' . $current_file_url . '"
                wave-color="' . WS_Posts_Settings::$options['ws_posts_wave_color'] . '"
                progress-color="' . WS_Posts_Settings::$options['ws_posts_progress_color'] . '"
                cursor-color="' . WS_Posts_Settings::$options['ws_posts_cursor_color'] . '"></div>';
            echo '<button class="wsbtn wsbtn-play" id="wsbtn-' . get_the_ID() . '" onClick="playStop(`' . get_the_ID() . '`)"><span>Play</span></button>';
        }

        echo "</div>";

        if ($count % 2 == 0) { echo '</div>';}

        $count++;
    }
}

wp_reset_postdata();

// check if there are only one column in last row and add </div>
if ($count % 2 == 0) { echo '</div>';}

echo '<a class="show-all-loops" href="' . get_post_type_archive_link('wavesurfer-posts') . '">Show all free loops</a>';

echo "</div>";