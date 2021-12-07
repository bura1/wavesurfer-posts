<?php
    $current_file_name = get_post_meta($post->ID, 'ws_post_audio_name', true);
    $current_info = get_post_meta($post->ID, 'ws_post_audio_info', true);
       
    $woocommerce_products = get_posts([
        'post_type' => 'product'
    ]);

    $current_product_id = get_post_meta($post->ID, 'ws_post_audio_product', true);
?>

<table class="form-table wavesurfer_posts-metabox">
    <input type="hidden" name="ws_posts_nonce" value="<?php echo wp_create_nonce("ws_posts_nonce") ?>" >
    <tr>
        <th>
            <label for="ws_post_audio_file">Upload file</label>
        </th>
        <td>
            <?php if (!empty($current_file_name)) { ?>
                <p>Current file is: <strong><?php echo esc_html($current_file_name); ?></strong></p>
            <?php } ?>

            <input 
                type="file" 
                name="ws_post_audio_file" 
                id="ws_post_audio_file"
            >
        </td>
    </tr>  
    <tr>
        <th>
            <label for="ws_post_audio_info">Info</label>
        </th>
        <td>
            <input 
                type="text" 
                name="ws_post_audio_info" 
                id="ws_post_audio_info" 
                value="<?php echo (!empty($current_info)) ? esc_html($current_info) : ''; ?>"
                required
            >
        </td>    
    </tr>
    <tr>
        <th>
            <label for="ws_post_audio_product">Related Woocommerce product</label>
        </th>
        <td>
            <select name="ws_post_audio_product" id="ws_post_audio_product">
                <option value="0">-------------</option>
                <?php foreach ($woocommerce_products as $product) { ?>
                    <option 
                        value="<?php echo $product->ID; ?>"
                        <?php echo ($current_product_id == $product->ID) ? 'selected="selected"' : ''; ?>
                    >
                        <?php echo $product->post_title; ?>
                    </option>
                <?php } ?>
            </select>
        </td>    
    </tr>
</table>