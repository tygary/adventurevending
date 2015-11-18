<?php
// ico image show
add_filter( 'wp_mime_type_icon', function( $icon, $mime, $post_id )
{
    if( $src = false || 'image/x-icon' === $mime && $post_id > 0 ){
        $src = wp_get_attachment_image_src( $post_id );
    }
    return is_array( $src ) ? array_shift( $src ) : $icon;
}, 10, 3 );

/**
 * Sanitization for textarea field
 */
function NovelLite_sanitize_textarea( $input ) {
    global $allowedposttags;
    $output = wp_kses( $input, $allowedposttags );
    return $output;
}

/**
 * Returns a sanitized filepath if it has a valid extension.
 */
function NovelLite_sanitize_upload( $upload ) {
    $return = '';
    $fype = wp_check_filetype( $upload );
    if ( $fype["ext"] ) {
        $return = esc_url_raw( $upload );
    }
    return $return;
}

/**
 * vaild int.
 */
function NovelLite_sanitize_int( $input ) {
$return = absint($input);
    return $return;
}

?>