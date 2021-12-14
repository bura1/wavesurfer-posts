<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
            settings_fields('ws_posts_group');
            do_settings_sections('ws_posts_page1');
            submit_button('Save');
        ?>
    </form>
</div>