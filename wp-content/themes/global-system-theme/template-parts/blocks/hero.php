<?php
/**
 * Bloque: Hero Section
 * Sección principal editable de la landing page
 */

// Obtener campos
$pretitle = get_field('hero_pretitle') ?: '¡GPS+ rastreó!';
$title = get_field('hero_title') ?: 'Plataforma nova con la mejor GPS';
$description = get_field('hero_description') ?: 'Administrador completo de tracking GPS con reportes avanzados y monitoreo en tiempo real.';
$button_text = get_field('hero_button_text') ?: 'Agendar demo';
$button_link = get_field('hero_button_link') ?: '#';
$image = get_field('hero_image');

// ID único para el bloque
$block_id = 'gs-hero-' . $block['id'];
?>

<section id="<?php echo esc_attr($block_id); ?>" class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 min-h-screen flex items-center overflow-hidden">
    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0 z-0">
        <!-- Onda superior decorativa -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-white" style="clip-path: polygon(0 30%, 100% 0, 100% 100%, 0 100%);"></div>
        
        <!-- Círculos decorativos -->
        <div class="absolute top-20 right-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-40 left-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Contenido -->
            <div class="text-white space-y-8">
                <!-- Pre-título -->
                <div class="inline-block">
                    <span class="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-medium border border-white/20">
                        <?php echo esc_html($pretitle); ?>
                    </span>
                </div>

                <!-- Título -->
                <h1 class="text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight">
                    <?php echo esc_html($title); ?>
                </h1>

                <!-- Descripción -->
                <p class="text-xl lg:text-2xl text-blue-100 leading-relaxed max-w-xl">
                    <?php echo esc_html($description); ?>
                </p>

                <!-- Botón CTA -->
                <div class="pt-4">
                    <a href="<?php echo esc_url($button_link); ?>" 
                       class="inline-flex items-center px-8 py-4 bg-white text-blue-900 font-semibold rounded-full hover:bg-blue-50 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 group">
                        <span><?php echo esc_html($button_text); ?></span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Imagen -->
            <div class="relative lg:ml-auto">
                <div class="relative bg-white/5 backdrop-blur-sm p-4 rounded-3xl border border-white/10 shadow-2xl">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             alt="<?php echo esc_attr($image['alt'] ?: $title); ?>" 
                             class="w-full h-auto rounded-2xl shadow-xl">
                    <?php else: ?>
                        <!-- Imagen placeholder -->
                        <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl aspect-[4/3] flex items-center justify-center">
                            <div class="text-center p-8">
                                <svg class="w-20 h-20 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-blue-400 font-medium">Agrega una imagen del dashboard GPS</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Elementos decorativos flotantes -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full opacity-20 blur-xl animate-pulse"></div>
                <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-purple-400 rounded-full opacity-20 blur-xl animate-pulse" style="animation-delay: 1s;"></div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -20px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(20px, 20px) scale(1.05); }
}
.animate-pulse {
    animation: blob 8s ease-in-out infinite;
}
</style>
