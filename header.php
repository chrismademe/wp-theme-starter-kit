<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php wp_head(); ?>

	<meta name="twitter:dnt" content="on">

	<style>
		[x-cloak] {
			display: none !important;
		}
	</style>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'resknow_starter_kit' ); ?></a>