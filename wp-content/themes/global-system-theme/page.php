<?php
/**
 * Página genérica limpia
 */
get_header();
?>

<main id="primary" class="site-main bg-white">
    <?php while (have_posts()) : the_post(); ?>
        
        <header class="bg-brand-light py-20 border-b border-gray-100">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl">
                    <h1 class="text-4xl lg:text-6xl font-bold text-brand-dark mb-6 tracking-tight">
                        <?php the_title(); ?>
                    </h1>
                    <?php if (has_excerpt()): ?>
                        <p class="text-xl text-brand-slate leading-relaxed">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="prose prose-lg prose-slate max-w-none 
                            prose-headings:text-brand-dark prose-headings:font-bold 
                            prose-p:text-brand-slate prose-a:text-brand-indigo">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>