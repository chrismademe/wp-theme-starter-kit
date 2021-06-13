<?php

// Login page branding
add_action( 'login_head', function() {

    // Get theme config
    $theme = get_theme_config();

    if ( array_key_exists( 'color', $theme ) ) {
        foreach( $theme['color'] as $key => $value ) {
            $colors[] = sprintf('--color-%s: %s;', $key, $value);
        }
    }


    printf( '<style>:root { %s }</style>', join($colors, PHP_EOL) );
    printf( '<link rel="stylesheet" href="%s">', get_template_directory_uri() . '/login.css' );
} );

// Change the logo URL
add_filter( 'login_headerurl', function($url) {
    return home_url();
} );
