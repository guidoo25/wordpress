<?php
/**
 * Front Page Template - Global System GPS
 */
get_header();
$post_id = get_the_ID();
?>

<main id="primary" class="site-main overflow-hidden">
    <section id="inicio" class="relative bg-brand-light pt-20 pb-32 lg:pt-32 lg:pb-48">
        <div class="absolute inset-0 z-0 opacity-30">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-brand-indigo/20 blur-[120px] rounded-full animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-400/10 blur-[100px] rounded-full"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 text-center lg:text-left">
                    <?php 
                    $hero_title = get_post_meta($post_id, '_gs_hero_title', true) ?: 'Precision GPS Tracking,';
                    $hero_highlight = get_post_meta($post_id, '_gs_hero_highlight', true) ?: 'Simplified.';
                    ?>
                    <h1 class="text-5xl lg:text-7xl font-bold text-brand-dark leading-[1.1] mb-8 tracking-tight">
                        <?php echo esc_html($hero_title); ?> 
                        <span class="text-brand-indigo"><?php echo esc_html($hero_highlight); ?></span>
                    </h1>
                    <p class="text-xl text-brand-slate mb-10 max-w-2xl leading-relaxed">
                        <?php echo wp_kses_post(get_post_meta($post_id, '_gs_hero_description', true)); ?>
                    </p>
                    
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 font-semibold">
                        <a href="#" class="bg-brand-indigo text-white py-4 px-10 rounded-full shadow-stripe hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300">
                            Comenzar ahora
                        </a>
                        <a href="#" class="flex items-center justify-center text-brand-dark hover:text-brand-indigo py-4 px-10 transition-colors duration-300">
                            Ver demostración <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>

                <div class="flex-1 relative group">
                    <div class="relative z-10 bg-white p-4 rounded-2xl shadow-card-hover border border-gray-100 transition-transform duration-500 group-hover:scale-[1.02]">
                        <?php 
                        $hero_img_id = get_post_meta($post_id, '_gs_hero_image', true);
                        if ($hero_img_id): 
                            echo wp_get_attachment_image($hero_img_id, 'large', false, ['class' => 'rounded-xl w-full h-auto']);
                        else: ?>
                            <img src="https://via.placeholder.com/800x600/F6F9FC/635BFF?text=GPS+Dashboard" alt="Dashboard" class="rounded-xl shadow-inner">
                        <?php endif; ?>
                    </div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-brand-indigo rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="caracteristicas" class="bg-white py-24 border-t border-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-3xl lg:text-5xl font-bold text-brand-dark mb-6 tracking-tight">
                    <?php echo esc_html(get_post_meta($post_id, '_gs_features_title', true)); ?>
                </h2>
                <p class="text-brand-slate text-lg max-w-2xl mx-auto">
                    <?php echo esc_html(get_post_meta($post_id, '_gs_features_subtitle', true)); ?>
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <?php 
                $features = get_post_meta($post_id, '_gs_features_list', true);
                if ($features): foreach ($features as $f): ?>
                <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-stripe hover:shadow-card-hover transition-all duration-300 group">
                    <div class="w-14 h-14 bg-brand-light rounded-xl flex items-center justify-center text-brand-indigo mb-6 group-hover:bg-brand-indigo group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-4"><?php echo esc_html($f['title']); ?></h3>
                    <p class="text-brand-slate leading-relaxed"><?php echo wp_kses_post($f['description']); ?></p>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- Productos Section -->
    <section id="productos" class="bg-gradient-to-br from-gray-50 to-white py-24">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-3xl lg:text-5xl font-bold text-brand-dark mb-6 tracking-tight">
                    Nuestros Productos y Servicios
                </h2>
                <p class="text-brand-slate text-lg max-w-2xl mx-auto">
                    Soluciones completas de rastreo GPS para proteger y monitorear tu flota vehicular
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Localización GPS -->
                <div class="group bg-white p-8 rounded-2xl shadow-stripe hover:shadow-card-hover transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-brand-indigo to-blue-600 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-4">Localización GPS</h3>
                    <p class="text-brand-slate leading-relaxed mb-6">Equipos de alta calidad para rastreo GPS de vehículos con precisión en tiempo real.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-brand-indigo font-semibold hover:text-brand-indigo/80 transition-colors">
                        Más información <span class="text-sm">→</span>
                    </a>
                </div>

                <!-- Plataforma Web -->
                <div class="group bg-white p-8 rounded-2xl shadow-stripe hover:shadow-card-hover transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-400 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-4">Plataforma Web</h3>
                    <p class="text-brand-slate leading-relaxed mb-6">Monitorea tu vehículo en tiempo real desde cualquier navegador con nuestra plataforma intuitiva.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-brand-indigo font-semibold hover:text-brand-indigo/80 transition-colors">
                        Más información <span class="text-sm">→</span>
                    </a>
                </div>

                <!-- Aplicación Móvil -->
                <div class="group bg-white p-8 rounded-2xl shadow-stripe hover:shadow-card-hover transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-400 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-4">Aplicación Móvil</h3>
                    <p class="text-brand-slate leading-relaxed mb-6">La posición de tu vehículo al alcance de tu celular. Disponible en Google Play y App Store.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-brand-indigo font-semibold hover:text-brand-indigo/80 transition-colors">
                        Más información <span class="text-sm">→</span>
                    </a>
                </div>

                <!-- Soporte 24/7 -->
                <div class="group bg-white p-8 rounded-2xl shadow-stripe hover:shadow-card-hover transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-4">Soporte 24/7</h3>
                    <p class="text-brand-slate leading-relaxed mb-6">Servicio post venta técnico y atención al cliente las 24 horas, los 7 días de la semana.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-brand-indigo font-semibold hover:text-brand-indigo/80 transition-colors">
                        Más información <span class="text-sm">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

