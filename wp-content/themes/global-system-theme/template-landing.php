<?php
/**
 * Template Name: Landing Page - Bloques Editables
 * 
 * Template para crear landing pages con bloques personalizados
 * Todo el contenido es editable desde el editor de WordPress
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        
        // Mostrar el contenido de la página (bloques de Gutenberg)
        the_content();
        
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
