<?php
/**
 * Bloque: Productos y Servicios
 * Sección alternada con imagen y descripción de productos
 */

// Obtener campos
$pretitle = get_field('products_pretitle') ?: 'Prihlizovanie';
$title = get_field('products_title') ?: 'plataforma productos';
$description = get_field('products_description') ?: 'Sistema completo de administración y monitoreo GPS para tu flota vehicular.';
$button_text = get_field('products_button_text') ?: 'Ver más';
$button_link = get_field('products_button_link') ?: '#';
$image = get_field('products_image');
$reverse = get_field('products_reverse');

$block_id = 'gs-products-' . $block['id'];
?>

<section id="<?php echo esc_attr($block_id); ?>" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center <?php echo $reverse ? 'lg:flex-row-reverse' : ''; ?>">
            
            <!-- Contenido -->
            <div class="<?php echo $reverse ? 'lg:order-2' : 'lg:order-1'; ?> space-y-6">
                <!-- Pre-título -->
                <div>
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold uppercase tracking-wide">
                        <?php echo esc_html($pretitle); ?>
                    </span>
                </div>

                <!-- Título -->
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight capitalize">
                    <?php echo esc_html($title); ?>
                </h2>

                <!-- Descripción -->
                <div class="text-lg text-gray-600 leading-relaxed prose prose-lg max-w-none">
                    <?php 
                    if (is_array($description)) {
                        echo wp_kses_post($description);
                    } else {
                        echo wpautop(esc_html($description));
                    }
                    ?>
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <a href="<?php echo esc_url($button_link); ?>" 
                       class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl group">
                        <span><?php echo esc_html($button_text); ?></span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Imagen -->
            <div class="<?php echo $reverse ? 'lg:order-1' : 'lg:order-2'; ?> relative">
                <!-- Imagen principal -->
                <div class="relative z-10">
                    <?php if ($image): ?>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img src="<?php echo esc_url($image['url']); ?>" 
                                 alt="<?php echo esc_attr($image['alt'] ?: $title); ?>" 
                                 class="w-full h-auto">
                            
                            <!-- Overlay decorativo -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-blue-900/20 to-transparent pointer-events-none"></div>
                        </div>
                    <?php else: ?>
                        <!-- Placeholder -->
                        <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl aspect-[4/3] flex items-center justify-center shadow-xl">
                            <div class="text-center p-8">
                                <svg class="w-24 h-24 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <p class="text-blue-400 font-medium">Agrega una imagen del producto o servicio</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Elementos decorativos -->
                <div class="absolute -top-8 -right-8 w-64 h-64 bg-blue-200 rounded-full opacity-20 blur-3xl -z-10"></div>
                <div class="absolute -bottom-8 -left-8 w-64 h-64 bg-purple-200 rounded-full opacity-20 blur-3xl -z-10"></div>
            </div>
        </div>
    </div>
</section>
