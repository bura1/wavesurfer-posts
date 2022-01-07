<!--<?php echo WS_Posts_Settings::$options['ws_posts_wave_color']; ?>
<?php echo WS_Posts_Settings::$options['ws_posts_progress_color']; ?>
<?php echo WS_Posts_Settings::$options['ws_posts_cursor_color']; ?>

<div id="waveform"></div>
<button onclick="startStop()">Start</button>-->

<?php

$args = array(  
    'post_type' => 'wavesurfer-posts',
    'post_status' => 'publish',
    'posts_per_page' => $num, 
    'orderby' => $orderby, 
    'order' => $order, 
);

$loop = new WP_Query( $args );

echo '<div id="wavesurfer-posts">';

if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) {
        $loop->the_post();

        $current_file_url = get_post_meta(get_the_ID(), 'ws_post_audio_file', true);
        $current_info = get_post_meta(get_the_ID(), 'ws_post_audio_info', true);
        $current_product_id = get_post_meta(get_the_ID(), 'ws_post_audio_product', true);

        echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';

        if (!empty($current_file_url)) {
            echo '<div id="waveform-' . get_the_ID() . '" file-url="' . $current_file_url . '"></div>';
            echo '<button onClick="playStop(`waveform-' . get_the_ID() . '`)">Play/Stop</button>';
        }

        echo "<br><br>";
    }
}

wp_reset_postdata();

echo "</div>";