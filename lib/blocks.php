<?php

add_action('acf/init', function () {

});

/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (empty string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function render_acf_block($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    $name = str_replace('acf/', '', $block['name']);
    $template = sprintf('blocks/%s.twig', $name);

    // Filter context
    $context = apply_filters('theme.block', $context); // Applies to every block
    $context = apply_filters(sprintf('theme.block.%s', $name), $context); // Block name specific

    Timber::render($template, $context);
}

/**
 * Remove Unstyled Blocks to avoid nasty surprises!
 */
// add_filter('allowed_block_types', function ($allowed_blocks) {
//     $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
//     $registered_block_keys = array_keys($registered_blocks);

//     // Only keep ACF Blocks
//     foreach ($registered_block_keys as $block) {
//         if (strpos($block, 'acf/') !== false) $acf_blocks[] = $block;
//     }

//     $allowed_blocks = apply_filters('theme_allowed_block_types', array_merge($acf_blocks, [
//         'core/paragraph',
//         'core/image',
//         'core/heading',
//         'core/list',
//         'core/shortcode'
//     ]));

//     return $allowed_blocks;
// });
