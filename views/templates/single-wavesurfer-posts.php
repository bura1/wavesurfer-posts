<?php get_header(); ?>

<div class="ws-posts-single">
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>

    <?php
    while (have_posts()) {
        the_post();
    }
    ?>
</div>

<?php get_footer(); ?>