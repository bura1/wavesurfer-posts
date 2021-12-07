<?php
    $file_name = get_post_meta($post->ID, 'ws_post_audio_name', true);
    $info = get_post_meta($post->ID, 'ws_post_audio_info', true);
?>

<table class="form-table wavesurfer_posts-metabox">
    <input type="hidden" name="ws_posts_nonce" value="<?php echo wp_create_nonce("ws_posts_nonce") ?>" >
    <tr>
        <th>
            <label for="ws_post_audio_file">Upload file</label>
        </th>
        <td>
            <?php if ($file_name != "") { ?>
                <p>Current file is: <strong><?php echo esc_html($file_name); ?></strong></p>
            <?php } ?>

            <input 
                type="file" 
                name="ws_post_audio_file" 
                id="ws_post_audio_file"
                required
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
                value="<?php echo ($info != "") ? esc_html($info) : ''; ?>"
                required
            >
        </td>    
    </tr>
</table>