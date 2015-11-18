<?php
function NovelLite_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('post-thumbnails');
    add_image_size('post_thumbnail', 250, 160, true);
    add_image_size('post_thumbnail_front', 340, 250, true);
    add_image_size('post_thumbnail_loop', 816, 450, true);
    add_theme_support('custom-background', array(
        'default-image' => 'e6e6e6',
    ));
    add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'NovelLite_theme_support');
?>