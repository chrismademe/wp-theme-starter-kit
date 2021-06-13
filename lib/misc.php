<?php

/**
 * Misc Functions
 *
 * Most of this is for removing the bloat
 * that WordPress likes to add to the <head>
 * of each page.
 */

// Dump
function dump($input)
{
    printf('<pre>%s</pre>', print_r($input, true));
}

// Dump & Die
function dd($input)
{
    dump($input);
    exit;
}

// Add Google Maps API Key to Advanced Custom Fields
if (defined('GOOGLE_API_KEY')) {
    add_action('acf/init', function () {
        acf_update_setting('google_api_key', GOOGLE_API_KEY);
    });
}

// Remove the Admin Bar because it's annoying :)
add_filter('show_admin_bar', '__return_false');

// Remove Emoji Styles
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove Generator Meta tag
remove_action('wp_head', 'wp_generator');

// Remove RSD Link
remove_action('wp_head', 'rsd_link');

// Remove Manifest Link
remove_action('wp_head', 'wlwmanifest_link');

// Remove Shortlink
remove_action('wp_head', 'wp_shortlink_wp_head');

// Remove json api capabilities
function remove_json_api()
{

    // Remove the REST API lines from the HTML Header
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('after_setup_theme', 'remove_json_api');

// Remove WooCommerce styles
if ( class_exists( 'woocommerce' ) ) {
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
}