<table class="form-table wavesurfer_posts-metabox">
    <input type="hidden" name="ws_posts_nonce" value="<?php echo wp_create_nonce("ws_posts_nonce") ?>" >
    <tr>
        <th>
            <label for="ws_post_audio_file">Upload file</label>
        </th>
        <td>
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
                value=""
                required
            >
        </td>    
    </tr>
</table>