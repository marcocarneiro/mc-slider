<?php
    $link_text = get_post_meta( $post->ID, 'mc_slider_link_text', true );
    $link_url = get_post_meta( $post->ID, 'mc_slider_link_url', true );
?>
<table class="form-table mc-slider-metabox">
    <?php //CAMPO OCULTO COM NONCE - SEGURANÇA // ?>
    <input type="hidden" name="mc_slider_nonce" value="<?php echo wp_create_nonce( 'mc_slider_nonce' ); ?>">
    <tr>
        <th>
            <label for="mc_slider_link_text">Link Text</label>
        </th>
        <td>
            <input 
            type="text"
            name="mc_slider_link_text"
            id="mc_slider_link_text"
            class="regular-text link-text"
            value="<?php echo ( isset( $link_text )) ? esc_html( $link_text ) : ''; ?>"
            required
        >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mc_slider_link_url">Link URL</label>
        </th>
        <td>
            <input 
            type="url"
            name="mc_slider_link_url"
            id="mc_slider_link_url"
            class="regular-text link-url"
            value="<?php echo ( isset( $link_url )) ? esc_html( $link_url ) : ''; ?>"
            required
        >
        </td>
    </tr>
</table>