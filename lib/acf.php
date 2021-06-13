<?php

// Add Globals Page
add_action('acf/init', function () {
    $globals_page = acf_add_options_page([
        'page_title'    => 'Globals',
        'icon_url'      => 'dashicons-admin-site-alt',
        'position'      => '60.1',
        'redirect'      => false
    ]);
});

/**
 * Field
 *
 * A wrapper for get_field but you can provide a fallback
 * value. Good for adding default values that the client can
 * change if they want to.
 *
 * @param string $key ACF field name/key
 * @param mixed $fallback A default value in case the field returns empty
 * @param int|string $post_id Optional Post ID to pass to ACF
 * @return mixed
 */
function get_field_fallback( $key, $fallback, $post_id = null ) {
    return get_field($key, $post_id) ?? $fallback;
}