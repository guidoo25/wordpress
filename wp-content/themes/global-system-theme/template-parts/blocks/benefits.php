<?php
/**
 * Bloque: Beneficios Clave
 * Grid de 3 beneficios/características principales
 */

// Obtener campos
$title = get_field('benefits_title') ?: 'Beneficios Clave';
$items = get_field('benefits_items');

// Si no hay items, usar datos de ejemplo
if (!$items) {
    $items = array(
        array(
            'icon' => 'location-arrow',
            'title' => 'Rastreo preciso',
            'description' => 'Sistema de rastreo GPS de alta precisión con actualizaciones en tiempo real.'
        ),
        array(
            'icon' => 'shield-alt',
            'title' => 'Seguridad confiable',
            'description' => 'Protección avanzada de datos con encriptación de nivel empresarial.'
        ),
        array(
            'icon' => 'chart-line',
            'title' => 'Analíticas avanzadas',
            'description' => 'Reportes detallados y métricas para optimizar tu flota vehicular.'
        )
    );
}

// Mapeo de iconos a clases de Font Awesome
$icon_map = array(
    'check-circle' => 'fa-check-circle',
    'shield-alt' => 'fa-shield-alt',
    'clock' => 'fa-clock',
    'location-arrow' => 'fa-location-arrow',
    'chart-line' => 'fa-chart-line',
    'users' => 'fa-users',
);

$block_id = 'gs-benefits-' . $block['id'];
?>

<section id="<?php echo esc_attr($block_id); ?>" class="py-20 lg:py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-12">
        <!-- Título de la sección -->
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                <?php echo esc_html($title); ?>
            </h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <!-- Grid de beneficios -->
        <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
            <?php foreach ($items as $item): 
                $icon_class = isset($icon_map[$item['icon']]) ? $icon_map[$item['icon']] : 'fa-check-circle';
            ?>
            <div class="group">
                <!-- Card -->
                <div class="h-full bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300">
                    <!-- Icono -->
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas <?php echo esc_attr($icon_class); ?> text-2xl text-white"></i>
                        </div>
                    </div>

                    <!-- Título -->
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-4">
                        <?php echo esc_html($item['title']); ?>
                    </h3>

                    <!-- Descripción -->
                    <p class="text-gray-600 leading-relaxed">
                        <?php echo esc_html($item['description']); ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php 
// Asegurar que Font Awesome esté cargado
wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
?>
