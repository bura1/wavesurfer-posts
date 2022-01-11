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

            the_title();
        }
        wp_reset_postdata();
    }
    ?>
</div>

<?php get_footer(); ?>