<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Resknow_Starter_Kit
 * @since 1.0
 */

get_header();

?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ): the_post(); ?>
        <main id="content" class="content-container">
            <?php get_template_part( 'template-parts/content' ); ?>
        </main>
    <?php endwhile; ?>
<?php endif; ?>

<?php

get_footer();