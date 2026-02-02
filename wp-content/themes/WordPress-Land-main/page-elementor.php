<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: page
 * 
 * Plantilla para usar con Elementor sin restricciones
 *
 * @package Wordpress-Land
 */

get_header();
?>

<div class="elementor-page-content">
    <?php
    // Si Elementor está activo, mostrar el contenido de Elementor
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>
