<?php

/**
 * Assets Directory
 *
 * @return Full path to the assets directory
 */
function assets_dir($suffix = false, $full_system_path = false)
{
    $prefix = $full_system_path ? get_template_directory() : get_template_directory_uri();
    $dir = $prefix . '/assets';

    // Suffix, possible path to a file?
    if ($suffix) {
        $dir .= '/' . $suffix;
    }

    return $dir;
}

/**
 * Add Style / Script
 *
 * Simple wrappers for wp_enqueue
 */
function add_style($id, $src, $deps = [], $tag = false)
{
    $tag = (!$tag ? SITE_VERSION : $tag);
    wp_enqueue_style($id, $src, $deps, $tag);
}

function add_script($id, $src, $deps = [], $tag = false)
{
    wp_enqueue_script($id, $src, $deps, $tag, true); # The last parameter is to place the JS in the footer
}

function register_style($id, $src, $tag = false)
{
    $tag = (!$tag ? SITE_VERSION : $tag);
    wp_register_style($id, $src, $tag);
}

function register_styles($styles = [], $type)
{
    foreach ($styles as $style) {
        $path = sprintf('css/%s/%s.css', $type, $style);
        register_style($style, assets_dir($path));
    }
}

function add_required_styles($template)
{
    if (!wp_style_is($template, 'registered')) return;
    wp_enqueue_style($template);
}

/**
 * Get Theme Config
 *
 * Reads the tokens.json file that gets generated from our Sass!
 * @return array
 */
function get_theme_config()
{
    $config = @file_get_contents(get_template_directory() . '/design-tokens.json');
    return json_decode($config, true);
}

/***********************************/

/**
 * Declare all your assets inside here
 */
function theme_assets()
{

    // Remove jQuery for non-WooCommerce sites
    if ( ! class_exists( 'woocommerce' ) ) {
        wp_dequeue_script( 'jquery' );
    }

    // Stylesheets
    $version = filemtime( assets_dir('css/style.css', true) );
    add_style( 'global', assets_dir('css/style.css'), [], $version ); // Theme Stylesheet

    // Scripts
    add_script( 'alpine', assets_dir('js/vendor/alpine.js') );

}

/***********************************/

add_action('wp_enqueue_scripts', 'theme_assets');
